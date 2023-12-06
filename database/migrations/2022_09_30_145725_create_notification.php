<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotification extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notification', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('link');
            $table->string('message');
            $table->string('appraiser');
			$table->string('status_delete')->nullable();
			$table->mediumText('data_baru')->nullable();
			$table->mediumText('data_lama')->nullable();
			$table->date('approved_at')->nullable();
			$table->string('approved_by')->nullable();
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
			$table->date('declined_at')->nullable();
			$table->string('declined_by')->nullable();
			$table->string('status_approve')->nullable();
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
        Schema::dropIfExists('notification');
    }
}
