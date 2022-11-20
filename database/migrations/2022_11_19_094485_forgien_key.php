<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        ################ Albums ###################
        Schema::table('albums', function (Blueprint $table) {
            $table->foreign("user_id")
            ->references('id')
            ->on("users")
            ->onDelete("cascade")
            ->onUpdate("cascade");
        });

        ################ Images ###################
        Schema::table('images', function (Blueprint $table) {
            $table->foreign("user_id")
            ->references('id')
            ->on("users")
            ->onDelete("cascade")
            ->onUpdate("cascade");
        });
        Schema::table('images', function (Blueprint $table) {
            $table->foreign("album_id")
            ->references('id')
            ->on("albums")
            ->onDelete("cascade")
            ->onUpdate("cascade");
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
