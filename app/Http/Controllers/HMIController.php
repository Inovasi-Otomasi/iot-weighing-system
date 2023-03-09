<?php

namespace App\Http\Controllers;

use App\Models\Historical;
use App\Models\Hmi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Line;
use App\Models\Machine;
use App\Models\Shift;
use App\Models\Sku;
use Throwable;

class HMIController extends Controller
{
    //
    // public function __construct()
    // {
    //     $role = auth();
    //     dd($role);
    //     // if ($role !== 'operator') {
    //     //     abort(403);
    //     // }
    // }

    public function index(Request $request)
    {
        // $role = auth()->user()->role;
        // dd($role);
        if (auth()->user()->role == 'admin') {
            return redirect()->route('admin_view');
        }
        // if (auth()->user()->role !== 'admin') {
        // if (!$request->input('hmi')) {
        $hmi_list = Hmi::all();
        foreach ($hmi_list as $hmi) {
            if (auth()->user()->role == 'hmi' . $hmi->id) {
                if ($request->input('hmi') != $hmi->id)
                    return redirect()->route('hmi', ['hmi' => $hmi->id]);
            }
        }
        // }

        //     return redirect()->route('hmi');
        // }

        $data = [
            'title' => 'HMI ' . $request->input('hmi'),
            'breadcrumb' => 'Dashboard',
            'lines' => Line::all(),
            'machines' => Machine::all(),
            'sku_list' => Sku::all(),
            'shifts' => Shift::all(),
            'hmi' => Hmi::all(),
            'request' => $request
        ];
        return view('hmi.index', $data);
    }

    public function liveHMI(Request $request)
    {
        // $hmi = $request->hmi;
        $actual_weight = 'Choose HMI';
        // $percentage = 0;
        $percentage_result = [
            'percentage' => '0',
            'target' => '0',
            'arrow' => 'down',
            'color' => 'danger',
            'auto' => 0,
            'stable' => 0,
            'sending' => 0
        ];
        $weight_status = 'UNDER';
        // if ($machine) {
        //     $actual_weight = Machine::where('id', $machine)->first()->weight;
        // }
        if ($request->hmi) {

            $hmi = Hmi::where('id', $request->hmi)->first();
            // $actual_weight = round($hmi->weight, 3);
            // if ($hmi->sku) {
            //     $sku = $hmi->sku;
            //     $percentage_result['target'] = $sku->target;
            //     $percentage_result['percentage'] = round(($hmi->weight * 100 / $percentage_result['target']) - 100, 3);
            //     $percentage_result['arrow'] = $percentage_result['percentage'] < 0 ? 'down' : 'up';
            //     $percentage_result['color'] = $hmi->weight <= $sku->th_L || $hmi->weight >= $sku->th_H ? 'danger' : 'success';
            //     if ($hmi->weight <= $sku->th_L) {
            //         $weight_status = 'UNDER';
            //     } elseif ($hmi->weight >= $sku->th_H) {
            //         $weight_status = 'OVER';
            //     } else {
            //         $weight_status = 'PASS';
            //     }
            // }
            $percentage_result['auto'] = $hmi->auto;
            // $percentage_result['stable'] = $hmi->stable;
            $percentage_result['sending'] = $hmi->sending;
            // $percentage_result['timeout'] = $hmi->timeout;
        }


        $data = [
            // 'actual_weight' => $actual_weight,
            'percentage_result' => $percentage_result,
            // 'weight_status' => $weight_status
        ];
        return json_encode($data);
    }

    public function submitLog(Request $request)
    {
        $rules = [
            'stable' => 'required',
            'weight' => 'required',
            'hmi' => 'required',
            // 'sku' => 'required',
            // 'pic' => 'required',
            // 'user' => 'required',
            // 'machine' => 'required'
        ];
        $validatedData = $request->validate($rules);

        try {
            $hmi = Hmi::where('id', $validatedData['hmi'])->first();
            if ($hmi->sku_id && $hmi->machine_id && $hmi->user && $hmi->pic_id) {
                if ($validatedData['weight'] <= $hmi->hmi_th) {
                    return json_encode(['status' => 'failed']);
                }
                $sku = $hmi->sku;
                $line = $hmi->line;
                $shift = $hmi->shift;
                $machine = $hmi->machine;
                $pic = $hmi->pic;
                $user = $hmi->user;
                if ($validatedData['weight'] <= $sku->th_L) {
                    $status = 'UNDER';
                } elseif ($validatedData['weight'] >= $sku->th_H) {
                    $status = 'OVER';
                } else {
                    $status = 'PASS';
                }
                $data = [
                    'line_name' => $line->line_name,
                    'sku_name' => $sku->sku_name,
                    'machine_name' => $machine->machine_name,
                    'shift_name' => $shift ? $shift->shift_name : NULL,
                    'shift_group' => $shift ? $shift->shift_group : NULL,
                    'shift_start' => $shift ? $shift->shift_start : NULL,
                    'shift_end' => $shift ? $shift->shift_end : NULL,
                    'hmi_name' => $hmi->hmi_name,
                    'user' => $user,
                    'pic' => $pic->pic_name,
                    'nik' => $pic->nik,
                    'weight' => round($validatedData['weight'], 3),
                    'target' => $sku->target,
                    'th_H' => $sku->th_H,
                    'th_L' => $sku->th_L,
                    'status' => $status,
                    'working_date' => now()->subHours(7)
                ];


                $affected_row =  Historical::Create($data);
                if ($affected_row) {
                    return json_encode(['status' => 'success']);
                } else {
                    return json_encode(['status' => 'failed']);
                }
            }
        } catch (Throwable $e) {
            return json_encode(['status' => 'failed']);
        }
    }
}
