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
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->string('username', 50)->unique();
            $table->string('photo')->nullable(true);
            $table->text('description')->nullable(true);
            $table->string('instagram')->nullable(true);
            $table->string('facebook')->nullable(true);
            $table->string('twitter')->nullable(true);
            $table->string('youtube')->nullable(true);
            $table->foreignId('user_id');
            $table->timestamps();

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('profiles');
    }
};
