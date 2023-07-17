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
        Schema::create('writers', function (Blueprint $table) {
            $table->id();

            $table->timestamps();

            $table->foreignId('user_id')
                ->constrained(table: 'users')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            
            $table->foreignId('post_id')
                ->constrained(table: 'posts')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('writers');
    }
};
