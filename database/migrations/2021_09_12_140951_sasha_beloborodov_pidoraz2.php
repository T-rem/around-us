<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SashaBeloborodovPidoraz2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('planners', function (Blueprint $table) {
            $table->dropColumn('start_at');
            $table->dropColumn('end_at');
        });

        Schema::table('planners', function (Blueprint $table) {
            $table->timestamp('start_at');
            $table->timestamp('end_at');
        });

        Schema::table('quiz_questions', function (Blueprint $table) {
            $table->dropColumn('text');
        });
        Schema::table('quiz_questions', function (Blueprint $table) {
            $table->string('text');
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
}
