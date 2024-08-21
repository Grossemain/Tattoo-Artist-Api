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
        Schema::create('users', function (Blueprint $table) {
            $table->boolean('is_admin');
            $table->string('email_account')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('pseudo_user', 50);
            $table->string('email', 50);
            $table->string('tel', 15);
            $table->text('description');
            $table->string('slug', 50);
            $table->string('style', 255);
            $table->string('instagram', 50);
            $table->string('img_profil', 50);
            $table->string('status_profil', 50);
            $table->string('city', 50);
            $table->string('departement', 50);
            $table->text('coordonnes');
            $table->string('tattooshop', 50);
            $table->string('title', 50);
            $table->string('meta_description', 50);
            $table->string('tattooshop_id', 50);
            $table->rememberToken();
            $table->foreign('tattooshop_id')->references('tattooshop_id')->on('tattooshops')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};