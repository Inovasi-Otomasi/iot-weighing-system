<?php

use App\Models\Hmi;
use App\Models\Line;
use App\Models\Machine;
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
        Schema::create('historical_log', function (Blueprint $table) {
            $table->id();
            $table->string('line_name');
            $table->string('machine_name');
            $table->string('shift_name')->nullable();
            $table->string('shift_group')->nullable();
            $table->string('shift_start')->nullable();
            $table->string('shift_end')->nullable();
            $table->string('sku_name');
            $table->string('hmi_name');
            // $table->foreignIdFor(Line::class);
            // $table->foreignIdFor(Machine::class);
            // $table->foreignIdFor(Shift::class);
            // $table->foreignIdFor(Sku::class);
            // $table->foreignIdFor(Hmi::class);
            $table->double('weight');
            $table->double('target');
            $table->double('th_H');
            $table->double('th_L');
            $table->string('status');
            // $table->timestamps();
            $table->date('working_date');
            $table->string('user');
            $table->string('pic');
            $table->string('nik');
            $table->timestamp('created_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('historical_log');
    }
};
