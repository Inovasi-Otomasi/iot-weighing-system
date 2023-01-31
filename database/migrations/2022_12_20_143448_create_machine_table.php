<?php

use App\Models\Line;
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
        Schema::create('machine', function (Blueprint $table) {
            $table->id();
            $table->string('machine_name');
            $table->foreignIdFor(Line::class)->nullable();
            // $table->double('weight')->default(0);
            // $table->integer('count')->default(0);
            // $table->integer('log')->default(0);
            // $table->integer('auto')->default(0);
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
        Schema::dropIfExists('machine');
    }
};
