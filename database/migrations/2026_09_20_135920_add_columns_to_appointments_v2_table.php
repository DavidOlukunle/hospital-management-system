<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('appointments_v2', function (Blueprint $table) {
            $table->uuid('public_id')
                ->unique()
                ->after('id');

            $table->foreignId('patient_id')
                ->after('public_id')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->foreignId('specialist_id')
                ->after('patient_id')
                ->constrained('specialist_profiles')
                ->restrictOnDelete();

            $table->date('appointment_date')
                ->after('specialist_id');

            $table->time('appointment_time')
                ->after('appointment_date');

            $table->string('reason')
                ->after('appointment_time');

            $table->text('notes')
                ->nullable()
                ->after('reason');

            $table->string('status')
                ->default('PENDING')
                ->after('notes');

            $table->index(['patient_id', 'status']);
            $table->index(['specialist_id', 'status']);
            $table->index('appointment_date');
        });
    }

    public function down(): void
    {
        Schema::table('appointments_v2', function (Blueprint $table) {
            $table->dropForeign(['patient_id']);
            $table->dropForeign(['specialist_id']);

            $table->dropUnique(['public_id']);

            $table->dropColumn([
                'public_id',
                'patient_id',
                'specialist_id',
                'appointment_date',
                'appointment_time',
                'reason',
                'notes',
                'status',
            ]);
        });
    }
};