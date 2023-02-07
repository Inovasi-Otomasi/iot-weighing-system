<?php

namespace App\Http\Controllers;

use App\Models\Hmi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Line;
use App\Models\Machine;
use App\Models\Shift;
use App\Models\Sku;

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
            $actual_weight = round($hmi->weight, 3);
            if ($hmi->sku) {
                $sku = $hmi->sku;
                $percentage_result['target'] = $sku->target;
                $percentage_result['percentage'] = round(($hmi->weight * 100 / $percentage_result['target']) - 100, 3);
                $percentage_result['arrow'] = $percentage_result['percentage'] < 0 ? 'down' : 'up';
                $percentage_result['color'] = $hmi->weight <= $sku->th_L || $hmi->weight >= $sku->th_H ? 'danger' : 'success';
                if ($hmi->weight <= $sku->th_L) {
                    $weight_status = 'UNDER';
                } elseif ($hmi->weight >= $sku->th_H) {
                    $weight_status = 'OVER';
                } else {
                    $weight_status = 'PASS';
                }
            }
            $percentage_result['auto'] = $hmi->auto;
            $percentage_result['stable'] = $hmi->stable;
            $percentage_result['sending'] = $hmi->sending;
        }


        $data = [
            'actual_weight' => $actual_weight,
            'percentage_result' => $percentage_result,
            'weight_status' => $weight_status
        ];
        return json_encode($data);
    }
}
