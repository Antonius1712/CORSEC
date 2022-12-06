<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDocument extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('document', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('document_type_id')->nullable();
            $table->integer('status')->nullable();
            $table->string('document_name')->nullable();
            $table->string('document_filename')->nullable();
            $table->string('document_full_path')->nullable();
            $table->string('document_file_directory')->nullable();
            $table->string('document_description')->nullable();
            $table->string('document_number_of_download')->nullable();
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('document');
    }
}
