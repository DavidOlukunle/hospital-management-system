<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('specialist_profiles', function (Blueprint $table) {
            $table->foreignId('user_id')
                ->unique()
                ->after('id')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->foreignId('specialty_id')
                ->after('user_id')
                ->constrained('specialties')
                ->restrictOnDelete();

            $table->string('doctor_number')
                ->unique()
                ->after('specialty_id');

            $table->string('room_number')
                ->nullable()
                ->after('doctor_number');

            $table->text('bio')
                ->nullable()
                ->after('room_number');

            $table->string('profile_image')
                ->nullable()
                ->after('bio');

            $table->string('approval_status')
                ->default('PENDING')
                ->after('profile_image');

            $table->timestamp('approved_at')
                ->nullable()
                ->after('approval_status');
        });
    }

    public function down(): void
    {
        Schema::table('specialist_profiles', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropForeign(['specialty_id']);

            $table->dropUnique(['user_id']);
            $table->dropUnique(['doctor_number']);

            $table->dropColumn([
                'user_id',
                'specialty_id',
                'doctor_number',
                'room_number',
                'bio',
                'profile_image',
                'approval_status',
                'approved_at',
            ]);
        });
    }
};