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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('t_id');
            $table->string('t_name');
            $table->string('c_code');
            $table->string('c_title');
            $table->string('c_semester');
            $table->string('c_section');
            $table->string('c_out')->default('null'); /* pdf, docx, ppt, pptx files*/           
            $table->string('c_mat')->default('null'); /* pdf, docx, ppt, pptx, zip, ra files*/
            $table->mediumText('c_student')->default('null');
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
        Schema::dropIfExists('courses');
    }
};
