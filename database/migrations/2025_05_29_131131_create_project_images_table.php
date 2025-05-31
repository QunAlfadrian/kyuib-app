<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('project_images', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255);
            $table->string('slug');
            $table->string('alternative_text', 255);
            $table->text('filename');
            $table->text('url');
            $table->foreignId('project_id')->constrained('projects')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('project_images');
    }
};
