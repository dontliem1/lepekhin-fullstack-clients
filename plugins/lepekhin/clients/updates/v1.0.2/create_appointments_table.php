<?php

use Lepekhin\Clients\Models\Client;
use Winter\Storm\Database\Schema\Blueprint;
use Winter\Storm\Database\Updates\Migration;
use Winter\Storm\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lepekhin_clients_appointments', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignIdFor(Client::class, 'client_id');
            $table->timestampTz('starts_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lepekhin_clients_appointments');
    }
};
