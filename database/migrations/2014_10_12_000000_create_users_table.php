<?php

// In a migration file, e.g., xxx_create_users_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->enum('role', ['patient', 'driver'])->default('patient');
            $table->string('photo')->nullable(); // nullable photo column
            $table->string('phone')->nullable();
            $table->timestamps();
        });
        
    }
    
    
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
