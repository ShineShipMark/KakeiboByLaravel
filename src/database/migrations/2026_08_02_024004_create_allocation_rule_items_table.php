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
            $table->foreignId('allocation_rule_id')
            ->constrained('allocation_rules')
            ->cascadeOnDelete();

            $table->foreignId('destination_account_id')
            ->nullable()
            ->constrained('accounts')
            ->nullOnDelete();

            $table->foreignId('category_id')
            ->nullable()
            ->constrained('categories')
            ->nullOnDelete();

            $table->enum('calc_type', ['fixed', 'percentage'])->comment('計算方式');
            $table->decimal('value',12, 2)->comment('金額または％');
            $table->integer('sort_order')->default(0)->comment('適用順序');

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
