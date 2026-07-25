<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('user_account', function (Blueprint $table) {
            $table->increments('user_id');
            $table->string('user_rand_id', 20)->unique()->nullable();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password', 60);
            $table->string('mobile', 20)->nullable();
            $table->string('location');
            $table->string('timezone', 100)->nullable();
            $table->string('company_name');
            $table->string('designation');
            $table->tinyInteger('is_active')->nullable();
            $table->tinyInteger('reg_source')->nullable();
            $table->string('reg_profile', 100)->nullable();
            $table->string('linkedin_id', 30)->nullable();
            $table->string('google_id', 100)->nullable();
            $table->string('facebook_id', 30)->nullable();
            $table->string('profile_pic')->nullable();
            $table->string('remember_token', 100)->nullable();
            $table->string('verify_token', 200)->nullable();
            $table->integer('contact_response')->nullable();
            $table->integer('contact_status')->nullable();
            $table->timestamps();
            $table->timestamp('last_notify_at')->useCurrent();
            $table->timestamp('last_login_at')->default(DB::raw('CURRENT_TIMESTAMP'));
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user_account');
    }
};