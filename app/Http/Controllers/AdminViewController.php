<?php

namespace App\Http\Controllers;

use App\Models\Hmi;
use Illuminate\Http\Request;

class AdminViewController extends Controller
{
    //
    public function index()
    {
        if (auth()->user()->role !== 'admin') {
            return redirect()->route('hmi');
        }
        $data = [
            'title' => 'Admin View',
            'breadcrumb' => 'Dashboard',
            'hmi_list' => Hmi::all()
        ];
        return view('admin-view.index', $data);
    }

    public function liveAdminView()
    {
        if (auth()->user()->role !== 'admin') {
            return redirect()->route('hmi');
        }
        $hmi_list = Hmi::all();
        // $hmi_data=[];
        $json_data = [];
        foreach ($hmi_list as $hmi) {
            $actual_weight = 'Choose HMI';
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
            $data = [
                'actual_weight' => $actual_weight,
                'percentage_result' => $percentage_result,
                'weight_status' => $weight_status,
                'id' => $hmi->id,
                'machine' => $hmi->machine ? $hmi->machine->machine_name : null,
                'sku' => $hmi->sku ? $hmi->sku->sku_name : null,
                'user' => $hmi->user,
                'pic' => $hmi->pic ? $hmi->pic->pic_name : null,
                'nik' => $hmi->pic ? $hmi->pic->nik : null
            ];
            array_push($json_data, $data);
        }

        echo json_encode($json_data);
    }
}
