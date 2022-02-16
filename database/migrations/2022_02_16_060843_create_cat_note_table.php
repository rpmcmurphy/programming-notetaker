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
        Schema::create('cat_note', function (Blueprint $table) {
            $table->bigInteger('cat_id')->unsigned()->index();
            $table->bigInteger('note_id')->unsigned()->index();

            $table->foreign('cat_id')->references('id')->on('cats')->onDelete('cascade');
            $table->foreign('note_id')->references('id')->on('notes')->onDelete('cascade');
            $table->primary(['cat_id', 'note_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cat_note', function (Blueprint $table) {
            //
        });
    }
};
