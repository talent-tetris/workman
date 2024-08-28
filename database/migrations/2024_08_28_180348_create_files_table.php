<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  /**
   * Run the migrations.
   */
  public function up(): void {
    Schema::create('files', function (Blueprint $table) {
      $table->uuid('id')->primary();
      $table->foreignId('post_id')->references('id')->on('posts')->cascadeOnDelete();

      $table->string('collection');

      $table->integer('height')->default(0);
      $table->integer('width')->default(0);

      $table->string('file_path');
      $table->string('content_type');
      $table->string('file_name');
      $table->string('original_name');
      $table->string('description')->nullable();

      $table->unsignedBigInteger('file_size')->default(0);

      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void {
    Schema::dropIfExists('files');
  }
};
