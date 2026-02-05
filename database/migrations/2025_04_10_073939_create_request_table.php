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
        Schema::create('request_certs', function (Blueprint $table) {

            $table->bigIncrements('id');
            $table->string('first_name',15)->nullable();
            $table->string('middle_name',15)->nullable();
            $table->string('last_name',15)->nullable();
            $table->string('suffix',15)->nullable();
            $table->string('email',25)->nullable();
            $table->string('contact_number',11)->nullable();
            $table->integer('request_type')->nullable();
            $table->string('request_purpose',50)->nullable();
            $table->integer('civilstatus')->default(0)->nullable();
            $table->integer('status')->default(0)->nullable();
            $table->integer('attachment')->default(0)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('request_certs');
    }
};
