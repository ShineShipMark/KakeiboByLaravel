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
        Schema::create('allocation_rules', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('ルール名');
            
            $table->foreignId('target_account_id')
            ->constrained('accounts')
            ->cascadeOnDelete();

            $table->boolean('is_active')->default(true)->comment('有効無効フラグ');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('allocation_rules');
    }
};
