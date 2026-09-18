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
        Schema::create('saving_goals', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('target_amount');
            $table->integer('current_amount')->default(0);
            $table->date('target_date')->nullable();

            $table->foreignId('account_id')->nullable()->constrained()->nullOnDelete();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('saving_goals');
    }
};
