<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * request_contact already tracks the RECEIVER's specific profile via
     * `profile_str` (e.g. the exact business/startup being contacted), but the
     * SENDER side only records a profile TYPE code, not which of the sender's
     * own profiles (when they have more than one of that type) sent it. This
     * adds that missing counterpart so My Interactions can be scoped to the
     * currently-active profile instance on the sender side too.
     */
    public function up(): void
    {
        Schema::table('request_contact', function (Blueprint $table) {
            $table->string('sender_profile_str', 60)->nullable()->after('sender_profile_type');
        });
    }

    public function down(): void
    {
        Schema::table('request_contact', function (Blueprint $table) {
            $table->dropColumn('sender_profile_str');
        });
    }
};
