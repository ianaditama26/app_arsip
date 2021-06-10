<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSptsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spts', function (Blueprint $table) {
            $table->id();
            $table->string('npwp');
            $table->string('namaNpwp');
            $table->string('jenis_pajak');
            $table->string('masa_pajak')->nullable()->default('-');
            $table->string('tahun_pajak')->nullable()->default('-');
            $table->string('pembetulan')->default('-');
            $table->string('no_lpad');
            $table->string('tgl_lpad');
            $table->string('noUrut');
            $table->string('noLemari');
            $table->string('noBox');
            $table->string('catt')->nullable();
            $table->boolean('status')->default(0)->nullable();
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
        Schema::dropIfExists('spts');
    }
}
