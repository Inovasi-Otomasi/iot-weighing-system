<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Hmi;
use App\Models\Line;
use App\Models\Machine;
use App\Models\Pic;
use App\Models\Shift;
use App\Models\Sku;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        User::Create([
            'name' => 'admin',
            'email' => 'admin@iotech.co.id',
            'role' => 'admin',
            'password' => Hash::make('adminiot')
        ]);
        User::Create([
            'name' => 'operator',
            'email' => 'operator@iotech.co.id',
            'role' => 'operator',
            'password' => Hash::make('operator')
        ]);
        User::Create([
            'name' => 'operator2',
            'email' => 'operator2@iotech.co.id',
            'role' => 'operator',
            'password' => Hash::make('')
        ]);
        Line::Create([
            'line_name' => '1',
        ]);
        Line::Create([
            'line_name' => '2',
        ]);
        Line::Create([
            'line_name' => '3',
        ]);
        Line::Create([
            'line_name' => '4',
        ]);
        Line::Create([
            'line_name' => '5',
        ]);
        Machine::Create([
            'machine_name' => '1',
        ]);
        Machine::Create([
            'machine_name' => '2',
        ]);
        Machine::Create([
            'machine_name' => '3',
        ]);
        Machine::Create([
            'machine_name' => '4',
        ]);
        Machine::Create([
            'machine_name' => '5',
        ]);
        Hmi::Create([
            'hmi_name' => '1',
            'line_id' => 1
        ]);
        Hmi::Create([
            'hmi_name' => '2',
            'line_id' => 2
        ]);
        Hmi::Create([
            'hmi_name' => '3',
            'line_id' => 3
        ]);
        Hmi::Create([
            'hmi_name' => '4',
            'line_id' => 4
        ]);
        Hmi::Create([
            'hmi_name' => '5',
            'line_id' => 5
        ]);
        Sku::Create([
            'line_id' => 1,
            'sku_name' => 'Torabika',
            'target' => 10,
            'th_H' => 11,
            'th_l' => 9
        ]);
        Sku::Create([
            'line_id' => 1,
            'sku_name' => 'Kopi Susu',
            'target' => 10,
            'th_H' => 11,
            'th_l' => 9
        ]);
        Sku::Create([
            'line_id' => 1,
            'sku_name' => 'Kopi Hitam',
            'target' => 10,
            'th_H' => 11,
            'th_l' => 9
        ]);
        Shift::Create([
            'shift_name' => 1,
            'shift_group' => 'A',
            'shift_start' => '07:00',
            'shift_end' => '15:00'
        ]);
        Shift::Create([
            'shift_name' => 2,
            'shift_group' => 'B',
            'shift_start' => '15:00',
            'shift_end' => '22:00'
        ]);
        Shift::Create([
            'shift_name' => 3,
            'shift_group' => 'C',
            'shift_start' => '22:00',
            'shift_end' => '07:00'
        ]);
        Pic::Create([
            'pic_name' => 'Mike',
            'nik' => '123123',
        ]);
    }
}
