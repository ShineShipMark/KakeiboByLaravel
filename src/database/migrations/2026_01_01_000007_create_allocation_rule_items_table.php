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
        Schema::create('allocation_rule_items', function (Blueprint $table) {
            $table->id();

            // 親ルールへの外部キー
            $table->foreignId('allocation_rule_id')
                ->constrained('allocation_rules') 
                ->cascadeOnDelete();

            $table->foreignId('to_account_id')
                ->constrained('accounts')
                ->restrictOnDelete();
        
            // カテゴリへの外部キー（明示的に指定）
            $table->foreignId('category_id')
                ->constrained('categories')
                ->cascadeOnDelete();
                
            $table->string('type');
                
            $table->decimal('amount', 12, 2)->default(0);
            $table->decimal('percentage', 5, 2)->default(0); 
            $table->integer('priority'); 
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('allocation_rule_items');
    }
};