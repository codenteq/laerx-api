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
        Schema::create('user_infos', function (Blueprint $table) {
            $table->id();
            $table->string('phone', 300)->nullable();
            $table->string('address', 600)->nullable();
            $table->boolean('is_active')->default(true);
            $table->foreignId('period_id')->nullable()->index();
            $table->foreignId('month_id')->default(1)->index();
            $table->foreignId('group_id')->nullable()->index();
            $table->foreignId('language_id')->nullable()->index();
            $table->foreignId('company_id')->nullable()->index();
            $table->foreignId('user_id')->nullable()->index();
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
        Schema::dropIfExists('user_infos');
    }
};
