<?php

namespace App\Http\Controllers;

use App\Models\Hmi;
use App\Models\Line;
use Illuminate\Http\Request;

class SetupController extends Controller
{
    //
    public function index()
    {
        if (auth()->user()->role !== 'admin') {
            $hmi_list = Hmi::all();
            foreach ($hmi_list as $hmi) {
                if (auth()->user()->role == 'hmi' . $hmi->id) {
                    return redirect()->route('hmi', ['hmi' => $hmi->id]);
                }
            }
            // return redirect()->route('hmi');
        }
        $data = [
            'title' => 'Setup',
            'breadcrumb' => 'List',
            'lines' => Line::all()
        ];
        return view('setup.index', $data);
    }
    public function sku()
    {
        if (auth()->user()->role !== 'admin') {
            return redirect()->route('hmi');
        }
        $data = [
            'title' => 'SKU',
            'breadcrumb' => 'List',
            'lines' => Line::all()
        ];
        return view('setup.sku', $data);
    }
}
