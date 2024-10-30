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
        Schema::create('permits', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->date('date-permit');
            $table->enum('type-permit', ['sakit', 'urusan-pribadi', 'lainnya']);
            $table->string('reason');
            $table->string('permit-file');
            $table->decimal('latitude', 10, 7)->nullable();  
            $table->decimal('longitude', 10, 7)->nullable(); 
            $table->string('information');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permits');
    }
};
