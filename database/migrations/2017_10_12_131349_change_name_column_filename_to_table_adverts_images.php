<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeNameColumnFilenameToTableAdvertsImages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('adverts_images', function (Blueprint $table) {
            $table->renameColumn('filename','path');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('adverts_images', function (Blueprint $table) {
            $table->renameColumn('path','filename');
        });
    }
}