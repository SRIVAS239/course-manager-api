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
        Schema::table('courses', function (Blueprint $table) {
            $table->foreignId('teacher_id')->after('id')->constrained('users')->onDelete('cascade');
            $table->string('course_name')->after('teacher_id');
            $table->text('course_desc')->nullable()->after('course_name');
            $table->boolean('is_active')->default(true)->after('course_desc');
        });
    }
    
    
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('courses', function (Blueprint $table) {
            $table->dropForeign(['teacher_id']);
            $table->dropColumn(['teacher_id', 'course_name', 'course_desc', 'is_active']);
        });
    }

};
