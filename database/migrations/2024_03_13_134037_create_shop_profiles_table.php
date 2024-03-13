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
        Schema::create('shop_profiles', function (Blueprint $table) {
            $table->id();
            $table->text("banner");
            $table->string("name");
            $table->string("phone");
            $table->string("email");
            $table->text("address");
            $table->text("description");
            $table->text("fb_link")->nullable();
            $table->text("tw_link")->nullable();
            $table->text("insta_link")->nullable();
            $table->integer('user_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shop_profiles');
    }
};
