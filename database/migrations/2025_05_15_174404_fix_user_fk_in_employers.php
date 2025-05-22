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
        Schema::table('employers', function (Blueprint $table) {
            Schema::table('employers', function (Blueprint $table) {
                $table->dropForeign(['user_id']);

                $table->foreign('user_id')
                    ->references('id')
                    ->on('users')
                    ->onDelete('cascade'); // 👈 THIS is the fix
            });
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('employers', function (Blueprint $table) {
            $table->dropForeign(['user_id']);

            $table->foreign('user_id')
                ->references('id')
                ->on('users');
        });
    }
};
