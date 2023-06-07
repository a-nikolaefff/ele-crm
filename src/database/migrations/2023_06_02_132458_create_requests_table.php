<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('requests', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('number');
            $table->string('object');
            $table->string('equipment');
            $table->string('comment')->nullable();
            $table->unsignedSmallInteger('prospect');
            $table->date('received_at');
            $table->date('answered_at')->nullable();
            $table->date('expected_order_date')->nullable();
            $table->unsignedBigInteger('status_id');
            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('project_organization_id')->nullable();
            $table->unsignedBigInteger('created_by_user_id')->nullable();
            $table->unsignedBigInteger('updated_by_user_id')->nullable();
            $table->timestamps();

            $table->foreign('status_id')->references('id')
                ->on('request_statuses')->cascadeOnDelete();
            $table->foreign('customer_id')->references('id')
                ->on('customers')->cascadeOnDelete();
            $table->foreign('project_organization_id')->references('id')
                ->on('customers')->nullOnDelete();
            $table->foreign('created_by_user_id')->references('id')
                ->on('users')->nullOnDelete();
            $table->foreign('updated_by_user_id')->references('id')
                ->on('users')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('requests');
    }
};
