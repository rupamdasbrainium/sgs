<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnscontentToContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('contents', function (Blueprint $table) {
            $table->string('title_fr')->after('franchise_id')->nullable();
            $table->dropColumn('body');
            $table->renameColumn('title', 'title_en');
            $table->renameColumn('english', 'body_en');
            $table->renameColumn('french', 'body_fr');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('contents', function (Blueprint $table) {
            $table->dropColumn('title_fr');
        });
    }
}
