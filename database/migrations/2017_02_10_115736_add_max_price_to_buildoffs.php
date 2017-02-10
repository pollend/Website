<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMaxPriceToBuildoffs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table("buildoffs", function (Blueprint $table) {
            $table->integer("max_price")->default(-1)->after("type_requirement");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table("buildoffs", function (Blueprint $table) {
            $table->dropColumn("max_price");
        });
    }
}
