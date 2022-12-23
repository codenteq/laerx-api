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
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('subdomain');
            $table->string('email');
            $table->char('tax_id', 11);
            $table->string('web_url')->nullable();
            $table->string('phone');
            $table->boolean('is_active')->default(true);
            $table->string('logo');
            $table->string('address', 600);
            $table->string('zip_code');
            $table->foreignId('country_id')->index();
            $table->foreignId('city_id')->index();
            $table->foreignId('state_id')->index();
            $table->foreignId('payment_plan_id')->index();
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
        Schema::dropIfExists('companies');
    }
};
