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
            $table->foreignId('category_id')
            ->constrained('categories')
            ->cascadeOnDelete();

            $table->string('year_month', 7)->comment('対象年月');
            $table->decimal('amount', 12, 2)->comment('月刊予算額');
            $table->timestamps();

            $table->unique(['category_id','year_month']);
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
