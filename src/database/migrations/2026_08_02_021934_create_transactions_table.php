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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['income', 'expense', 'transfer'])->comment('取引種別');

            $table->foreignId('from_account_id')
            ->nullable()
            ->constrained('accounts')
            ->nullOnDelete();

            $table->foreignId('to_account_id')
            ->nullable()
            ->constrained('accounts')
            ->nullOnDelete();

            $table->foreignId('category_id')
            ->nullable()
            ->constrained('categories')
            ->nullOnDelete();

            $table->decimal('amount', 12, 2)->comment('金額');
            $table->date('date')->comment('日付');
            $table->string('description')->nullable()->comment('メモ');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
