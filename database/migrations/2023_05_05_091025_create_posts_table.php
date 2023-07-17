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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')
                ->constrained(table: 'categories')
                ->onUpdate('cascade');
            $table->foreignId('created_by')
                ->constrained(table: 'users')
                ->onUpdate('cascade');
            $table->foreignId('acc_by')
                ->nullable()
                ->constrained(table: 'users')
                ->onUpdate('cascade');
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->longText('post');
            $table->enum('status', ['draft', 'revision', 'published', 'archived']);
            $table->string('banner_url')->nullable();
            $table->text('revision_note')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
