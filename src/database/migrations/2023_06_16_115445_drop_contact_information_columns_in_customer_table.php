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
        Schema::table('customers', function (Blueprint $table) {
            $table->dropColumn('contact_person');
            $table->dropColumn('post');
            $table->dropColumn('email');
            $table->dropColumn('phone');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('customers', function (Blueprint $table) {
            $table->string('contact_person')->nullable();
            $table->string('post')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
        });
    }
};
