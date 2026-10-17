# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## 概要

家計簿アプリ。Laravel 12 + Inertia.js v2 + Vue 3 (TypeScript) + Pinia + Tailwind v4 (shadcn-vue / reka-ui)。
**Laravel プロジェクト本体は `src/` 配下**（リポジトリ直下は Docker 設定のみ）。コマンドはすべて `src/` で実行する。

## 目指しているもの

個人利用（認証なし・単一ユーザー）の**「先取り配分型（封筒式）」家計簿**。単なる収支記録ではなく、次の流れを中心に据える。

1. 給料などの**収入を登録**すると、**配分ルール**（固定額 / 割合）に従って各カテゴリ・口座へ自動で振り分ける（親取引 → 子取引 transfer）。
2. カテゴリごとに**月次予算**を持ち、月末に余りを **繰越 / 貯金へ移動 / 破棄** から選んで締める（`RolloverActionType`, `budgets.is_closed`）。
3. 口座残高を「実残高」「貯金目標に割当済み」「**自由に使える未割当額（自由枠）**」に分けてホームに表示する。
4. 履歴一覧・編集、グラフでの可視化。

## 開発の進め方

- **主目的は学習**（実際に使う家計簿でもある）。**コードはユーザー自身が書く**。Claude は明示的に頼まれない限りソースを編集せず、方針提案・設計理由の解説・ヒント・レビューを担当する。
- ユーザー（ShineShipMark）の個人開発。1 機能ずつ「サーバー側実装 → フロント改修」の順で進め、コミットメッセージは日本語の短い要約（例: `分配ルールについてのサーバー側の処理実装`）。
- 新機能の典型的な手順: マイグレーション/Model → `app/Data` に Data クラス（`#[TypeScript]`）→ Service / Action → Controller + `routes/web.php` → `php artisan typescript:transform` → `pages/*.vue`。
- テストはほぼ未整備（Example のみ）。ロジックを足すときは Pest の Feature テストを添えるのが望ましい。
- 既存コメントは学習メモ的に丁寧なので、追加するコードも日本語で意図を残す。

## 開発環境（Docker）

`docker-compose.yml`: `nginx`(:80) → `app`(PHP 8.4-fpm + Node 20, :8000 / Vite :5173) → `mysql`(MariaDB 11.7, DB `laravel` / `laravel` / `secret`)。`src/` が `/var/www/html` にマウントされる。

```bash
docker compose up -d
docker compose exec app bash   # 以降のコマンドはコンテナ内で
```

## コマンド（`src/` で実行）

```bash
composer dev                      # artisan serve + queue + pail + vite を同時起動
npm run dev                       # Vite のみ
npm run build                     # 本番ビルド
php artisan migrate

# テスト
composer test                     # = php artisan test（Pest, SQLite :memory:）
php artisan test --filter=名前     # 単一テスト
php artisan test tests/Feature/ExampleTest.php
npx vitest run                    # フロント（resources/js/tests/**/*.test.js のみ対象, jsdom）
npx vitest run resources/js/tests/SelectPurpose.test.js

# Lint / Format
npm run lint                      # ESLint --fix
npm run format                    # Prettier (resources/)
vendor/bin/pint                   # PHP

# PHP Data/Enum → TypeScript 型の再生成
php artisan typescript:transform  # → resources/js/generated/generated.d.ts
```

## アーキテクチャ

### ドメインモデル（新設計）

すべての入出金は単一の `transactions` テーブルで表現する（`App\Models\Transaction`）。

- `type`: `TransactionType`（income / expense / transfer）。`from_account_id` / `to_account_id` の必須条件は `Transaction::validateInvariants()` に集約されており、保存前に必ず呼ぶ。
- `parent_transaction_id` による自己参照: 収入登録（親）から生まれる配分（子, transfer）などを `allocations()` で紐づける。
- 主要テーブル: `categories`（`parent_id` による階層）, `accounts`, `transactions`, `allocations`, `budgets`, `allocation_rules` / `allocation_rule_items`（配分ルール：収入を各カテゴリ・口座へ割り振る）, `saving_goals`。
- 口座残高のサマリー計算は `AccountBalanceService`。

### バックエンドのレイヤー

- **Controller** → **Service**（`app/Services`）/ **Action**（`app/UseCases/*Action.php`, `__invoke`）→ Model。
- 入出力は **spatie/laravel-data** の `app/Data/**` クラス。コントローラ引数に Data クラスを型指定してリクエストのバインド/バリデーションを行い、`#[TypeScript]` 属性付きのものは TS 型として出力される。
- `HandleInertiaRequests` が全ページに `categories`（親カテゴリ＋children）と `flash.message` を共有している。

### 新旧コードの混在（移行中）

旧設計の `Expense` / `Income` 系（`app/Models/Expense*`・`Income*`, `app/DTO`, `app/UseCases/{Register,Find,Update,Delete,Get}*`, `app/Http/Resources`, `InputController`, `HistoryController`, `MasterController`）が残っているが、対応するマイグレーションは存在しない。新規実装は `Transaction` + `app/Data` + `app/Services` の新設計で行うこと。

### フロントエンド

- Inertia ページは `resources/js/pages/*.vue`。`app.ts` で全ページに `components/layouts/defaultLayout.vue` が強制適用される。
- 状態管理は Pinia（`resources/js/stores`）。UI 部品は `components/ui`（shadcn-vue 生成物）。パスエイリアス `@/*` → `resources/js/*`。
- PHP 側の型は **グローバル名前空間 `App.*`** として参照する（例: `type TransactionData = App.Data.Transaction.TransactionData;`）。import は不要。Data クラスや Enum を変更したら `php artisan typescript:transform` で `generated.d.ts` を再生成する。設定は `TypeScriptTransformerServiceProvider`（`config/typescript-transfer.php` は使われていない旧設定）。
  - typescript-transformer は **v3**。laravel-data 付属の `DataTypeScriptTransformer` は v2 向けで使えないため、汎用の `AttributedClassTransformer` で PHP の型をそのまま写している。
  - そのため **`#[DataCollectionOf]` は TS 生成に効かない**。配列の要素型は docblock（`/** @var X[] */` や `@param array<X>`）で指定する。
  - `PaginatedDataCollection` などライブラリのクラスは変換できない（`undefined` になる）。`#[TypeScriptType]` / `#[LiteralTypeScriptType]` で TS 型を明示する。ページネーションは `resources/js/types/paginated.d.ts` のグローバル型 `Paginated<T>` を使う（laravel-data の出力 `{ data, links, meta }`、`meta` のキーは snake_case）。
  - **`defineProps<App.Data.X>()` のようにグローバル型を丸ごと渡すと Vue コンパイラが解決できずエラー**。props のキーは `defineProps<{ foo: App.Data.X['foo']; ... }>()` のように列挙する。
- ルートヘルパーは Laravel Wayfinder（Vite プラグインが `resources/js/actions`・`resources/js/routes` を自動生成）。

## 既知の注意点

- `app/Enum/AccountId.php` の namespace が `App\Enums` でディレクトリ（`Enum`）と不一致。
- `bootstrap/providers.php` が存在しない `App\Providers\KakeiboProvider` を登録している。
- `TransactionController@index` は `render('history')`（小文字。ファイルは `History.vue`）で、`TransactionIndexData` への移行も未完了。`create` が描画する `Transaction/Create` は存在しない。
- **取引の保存は `TransactionService::createTransaction` / `deleteTransaction` に一本化**（残高更新を含む）。配分の子取引も `AllocationService` がこれらを経由して作成・削除する。
- **スキーマとモデルの不一致**:
  - `transactions.amount` は integer 列だが、モデルは `decimal:2` キャスト。
  - 配分の表現が `allocations` テーブルと `transactions.parent_transaction_id`（子 transfer）の 2 系統ある。新しいのは後者。
- **ルーティング未接続**: `HomeController`・`AllocationController@store/getCategories` にルートがない。`allocationrule.input` / `transaction.index` というルート名は存在しない。サイドバーの `/home`・`/graph` も未定義。
- `AllocationRuleItem::calculateAmount()` の割合計算は四捨五入（`(int) round()`）。
- `AllocationService::getPreview` は旧方式の `allocations` テーブルを参照している。
- `TransactionSeeder` の収入データが `from_account_id` に口座を入れ `to_account_id` が null（不変条件違反）。
- `TransactionService::getPaginatedTransactions` の口座フィルタが `$filters['account_id']`（Data のプロパティは `accountId`）。
- コメント・メッセージは日本語。
