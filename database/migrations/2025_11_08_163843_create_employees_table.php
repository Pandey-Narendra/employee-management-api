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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();

            $table->string('first_name', 100)->index();
            $table->string('last_name', 100)->index();
            $table->string('email', 150)->unique()->index();
            
            // department In which this employee belongs
            $table->foreignId('department_id')
                ->references('id')->on('departments')
                ->onDelete('cascade')
                ->onUpdate('cascade')
            ;

            // user/manager/admin who have created this employess or comes under 
            $table->foreignId('user_id')
                ->references('id')->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade')
            ;

            // $table->string('added_by', 150);
            // $table->string('updated_by', 150);

            $table->softDeletes();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('employees', function (Blueprint $table) {
            $table->dropForeign(['department_id']);
            $table->dropForeign(['user_id']);
            $table->dropIndex(['first_name']);
            $table->dropIndex(['last_name']);
            $table->dropUnique(['email']);
        });
        
        Schema::dropIfExists('employees');
    }
};
