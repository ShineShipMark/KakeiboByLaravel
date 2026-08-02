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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            // parent_idがnullなら大項目、それ以外は小項目
            $table->foreignId('parent_id')
            ->nullable()
            ->constrained('categories')
            ->cascadeOnDelete();

            $table->string('name')->comment('収支項目名');
            $table->enum('type', ['income','expense'])->comment('収支');
            $table->integer('sort_order')->default(0)->comment('並び順');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
