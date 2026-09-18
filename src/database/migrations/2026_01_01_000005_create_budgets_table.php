<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('budgets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained('categories')->cascadeOnDelete();
            $table->string('year_month'); // 例: '2026-09'
            $table->decimal('amount', 10, 2); // 基本設定予算額
            
            // 💡 追加: 前月からの繰越額（初期値 0）
            $table->decimal('carryover_amount', 10, 2)->default(0.00); 

            // 💡 追加: 月次締め処理完了フラグ（モーダルの重複表示防止）
            $table->boolean('is_closed')->default(false); 
            
            $table->timestamps();

            // 同じカテゴリ・年月の組み合わせが重複しない制約
            $table->unique(['category_id', 'year_month']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('budgets');
    }
};