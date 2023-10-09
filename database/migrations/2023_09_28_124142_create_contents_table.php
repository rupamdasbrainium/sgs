<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contents', function (Blueprint $table) {
            $table->id();
            $table->integer('franchise_id')->default(3);
            $table->string('title');
            $table->longText('body');
            $table->string('slug');
            $table->boolean('status')->comment('0:Inactive, 1:Active');
            $table->string('english')->nullable();
            $table->string('french')->nullable();
            $table->boolean('deleted')->default(0);
            $table->integer('admin_user_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contents');
    }
}
