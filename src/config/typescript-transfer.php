<?php

return [
    /*
     * DTOやDataクラスを探すディレクトリパス
     */
    'searching_paths' => [
        app_path('Data'),
        app_path('Enums'),
    ],

    /*
     * 使用するトランスフォーマーの設定
     */
    'transformers' => [
        Spatie\TypeScriptTransformer\Transformers\EnumTransformer::class,
    ],

    /*
     * 生成される TypeScript 型定義ファイルの出力先
     */
    'output_file' => resource_path('js/types/generated.d.ts'),
];