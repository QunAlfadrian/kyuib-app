<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('landing_page_settings', function (Blueprint $table) {
            $table->id();
            $table->string('display_name', 255);
            $table->string('job_title', 255);
            $table->text('hero_image_url', 2048);
            $table->string('about_me_title', 255);
            $table->string('about_me_body', 5048);
            $table->text('contact_url', 2048);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('landing_page_settings');
    }
};
