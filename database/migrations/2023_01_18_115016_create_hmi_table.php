<?php

use App\Models\Line;
use App\Models\Machine;
use App\Models\Pic;
use App\Models\Shift;
use App\Models\Sku;
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
        Schema::create('hmi', function (Blueprint $table) {
            $table->id();
            $table->string('hmi_name')->unique();
            $table->double('weight')->default(0);
            $table->integer('count')->default(0);
            $table->integer('log')->default(0);
            $table->integer('auto')->default(0);
            $table->integer('stable')->default(0);
            $table->integer('sending')->default(0);
            $table->double('hmi_th')->default(0);
            $table->string('status')->default('UNDER');
            // $table->string('line_name')->nullable();
            $table->foreignIdFor(Line::class)->nullable();
            $table->foreignIdFor(Machine::class)->nullable();
            $table->foreignIdFor(Shift::class)->nullable();
            $table->foreignIdFor(Sku::class)->nullable();
            $table->foreignIdFor(Pic::class)->nullable();
            $table->string('user')->nullable();
            $table->string('ip_address')->nullable();
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
        Schema::dropIfExists('hmi');
    }
};
