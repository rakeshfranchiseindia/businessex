<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('user_profiles', function (Blueprint $table) {
            $table->increments('user_prof_id');
            $table->unsignedInteger('user_id');
            $table->integer('profile_id');
            $table->tinyInteger('profile_type');
            $table->string('profile_str', 20);
            $table->tinyInteger('profile_status');
            $table->timestamps();

            // Foreign key relationship
            $table->foreign('user_id')->references('user_id')->on('user_account')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user_profiles');
    }
};