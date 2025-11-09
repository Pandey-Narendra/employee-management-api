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
        Schema::create('employee_addresses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')
                  ->constrained('employees')
                  ->onDelete('cascade');
            $table->string('address_line');
            $table->string('city', 50)->index();
            $table->string('state', 60)->index();

           // Keep as string to preserve leading zeros (e.g., "040001")
            $table->string('pincode', 10)->comment('Postal or ZIP code')->index();;
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('employee_addresses', function (Blueprint $table) {
            $table->dropForeign(['employee_id']);
            $table->dropIndex(['city']);
            $table->dropIndex(['state']);
            $table->dropIndex(['pincode']);
        });
        Schema::dropIfExists('employee_addresses');
    }
};
