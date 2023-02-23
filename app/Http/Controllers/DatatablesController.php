<?php

namespace App\Http\Controllers;

use App\Models\Historical;
use App\Models\Hmi;
use App\Models\Line;
use App\Models\Machine;
use App\Models\Pic;
use App\Models\Shift;
use App\Models\Sku;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Throwable;
// use App\Models\Sku;
use Illuminate\Support\Facades\DB;

class DatatablesController extends Controller
{
    //
    public function skuList(Request $request)
    {
        $columns = array(
            // 0 => 'sku.created_at',
            0 => 'sku.sku_name',
            1 => 'line.line_name',
            2 => 'sku.target',
            3 => 'sku.th_H',
            4 => 'sku.th_L',

        );
        $collection = Sku::select('sku.*', 'line.line_name')
            ->leftJoin('line', 'line.id', '=', 'sku.line_id');
        // $collection = DB::table('sku');
        $totalData = $collection->count();

        $totalFiltered = $totalData;

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        if (empty($request->input('search.value'))) {
            $table = $collection->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();
        } else {
            $search = $request->input('search.value');
            $table = $collection->where(function ($query) use ($columns, $search) {
                foreach ($columns as $col) {
                    $query->orWhere($col, 'LIKE', "%{$search}%");
                }
                return $query;
            })
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();
            $totalFiltered = $collection->where(function ($query) use ($columns, $search) {
                foreach ($columns as $col) {
                    $query->orWhere($col, 'LIKE', "%{$search}%");
                }
                return $query;
            })->count();
        }

        $data = array();
        if (!empty($table)) {
            foreach ($table as $row) {
                $nestedData = [];
                // $nestedData[] = $row->created_at->format('Y-m-d H:i:s');
                $nestedData[] = $row->sku_name;
                $nestedData[] = $row->line ? $row->line->line_name : 'Not Assigned';
                $nestedData[] = $row->target;
                $nestedData[] = $row->th_H;
                $nestedData[] = $row->th_L;
                $nestedData[] = view('modal.edit-sku', ['sku' => $row, 'lines' => Line::all()])->render();
                // $nestedData[] = view('modal.edit-parameter', ['parameters' => Parameters::all(), 'parameter' => $row, 'device_uuid' => $request->device_uuid])->render();
                $data[] = $nestedData;
            }
        }

        $json_data = array(
            "draw"            => intval($request->input('draw')),
            "recordsTotal"    => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data"            => $data
        );
        echo json_encode($json_data);
    }

    public function addSKU(Request $request)
    {
        //
        if (auth()->user()->role !== 'admin') {
            return back()->with('failed', 'Need admin privillages.');
        }
        $rules = [
            'sku_name' => 'required|max:255',
            'line_id' => 'required',
            'target' => 'required',
            'th_H' => 'required',
            'th_L' => 'required',
        ];
        $validatedData = $request->validate($rules);
        try {
            $affected_row = Sku::create($validatedData);
            // dd($affected_row);
            if ($affected_row) {
                return redirect('/setup')->with('success', 'New SKU has been added!');
            }
            return redirect('/setup')->with('failed', 'Adding SKU failed!');
        } catch (Throwable $e) {
            return redirect('/setup')->with('failed', 'Adding SKU failed!');
        }
    }
    public function editSKU(Request $request)
    {
        //
        $rules = [
            // 'id' => 'required',
            'sku_name' => 'required|max:255',
            'line_id' => 'required',
            'target' => 'required',
            'th_H' => 'required',
            'th_L' => 'required',
        ];
        $validatedData = $request->validate($rules);
        try {
            $affected_row = Sku::where('id', $request->id)->update($validatedData);
            if ($affected_row) {
                return redirect('/setup')->with('success', 'SKU ' . $request->sku_name . ' has been edited!');
            }
            return redirect('/setup')->with('failed', 'Editing SKU failed!');
        } catch (Throwable $e) {
            return redirect('/setup')->with('failed', 'Editing SKU failed!');
        }
    }
    public function deleteSKU(Request $request)
    {
        if (auth()->user()->role !== 'admin') {
            return back()->with('failed', 'Need admin privillages.');
        }
        try {
            $affected_row = Sku::where('id', $request->id)->delete();
            if ($affected_row) {
                return redirect('/setup')->with('success', 'SKU ' . $request->sku_name . ' has been deleted!');
            }
            return redirect('/setup')->with('failed', 'Deleting SKU failed!');
        } catch (Throwable $e) {
            return redirect('/setup')->with('failed', 'Deleting SKU failed!');
        }
    }
    public function lineList(Request $request)
    {
        $columns = array(
            // 0 => 'created_at',
            0 => 'line_name',

        );
        $collection = DB::table('line');;
        $totalData = $collection->count();

        $totalFiltered = $totalData;

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        if (empty($request->input('search.value'))) {
            $table = $collection->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();
        } else {
            $search = $request->input('search.value');
            $table = $collection->where(function ($query) use ($columns, $search) {
                foreach ($columns as $col) {
                    $query->orWhere($col, 'LIKE', "%{$search}%");
                }
                return $query;
            })
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();
            $totalFiltered = $collection->where(function ($query) use ($columns, $search) {
                foreach ($columns as $col) {
                    $query->orWhere($col, 'LIKE', "%{$search}%");
                }
                return $query;
            })->count();
        }

        $data = array();
        if (!empty($table)) {
            foreach ($table as $row) {
                $nestedData = [];
                // $nestedData[] = $row->created_at;
                $nestedData[] = $row->line_name;
                // $nestedData[] = 'hehe';
                $nestedData[] = view('modal.edit-line', ['line' => $row])->render();
                // $nestedData[] = view('modal.edit-parameter', ['parameters' => Parameters::all(), 'parameter' => $row, 'device_uuid' => $request->device_uuid])->render();
                $data[] = $nestedData;
            }
        }

        $json_data = array(
            "draw"            => intval($request->input('draw')),
            "recordsTotal"    => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data"            => $data
        );
        echo json_encode($json_data);
    }
    public function addLine(Request $request)
    {
        //
        if (auth()->user()->role !== 'admin') {
            return back()->with('failed', 'Need admin privillages.');
        }
        $rules = [
            'line_name' => 'required|max:255',
        ];
        $validatedData = $request->validate($rules);
        $affected_row = Line::create($validatedData);
        // dd($affected_row);
        if ($affected_row) {
            return redirect('/setup')->with('success', 'New Line has been added!');
        }
        return redirect('/setup')->with('failed', 'Adding Line failed!');
    }
    public function deleteLine(Request $request)
    {
        if (auth()->user()->role !== 'admin') {
            return back()->with('failed', 'Need admin privillages.');
        }
        $affected_row = Line::where('id', $request->id)->delete();
        if ($affected_row) {
            return redirect('/setup')->with('success', 'Line ' . $request->line_name . ' has been deleted!');
        }
        return redirect('/setup')->with('failed', 'Deleting Line failed!');
    }
    public function machineList(Request $request)
    {
        $columns = array(
            // 0 => 'created_at',
            0 => 'machine_name',
            1 => 'line.line_name',

        );
        // $collection = DB::table('machine');
        $collection = Machine::select('machine.*', 'line.line_name')
            ->leftJoin('line', 'line.id', '=', 'machine.line_id');
        $totalData = $collection->count();

        $totalFiltered = $totalData;

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        if (empty($request->input('search.value'))) {
            $table = $collection->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();
        } else {
            $search = $request->input('search.value');
            $table = $collection->where(function ($query) use ($columns, $search) {
                foreach ($columns as $col) {
                    $query->orWhere($col, 'LIKE', "%{$search}%");
                }
                return $query;
            })
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();
            $totalFiltered = $collection->where(function ($query) use ($columns, $search) {
                foreach ($columns as $col) {
                    $query->orWhere($col, 'LIKE', "%{$search}%");
                }
                return $query;
            })->count();
        }

        $data = array();
        if (!empty($table)) {
            foreach ($table as $row) {
                $nestedData = [];
                // $nestedData[] = $row->created_at;
                $nestedData[] = $row->machine_name;
                $nestedData[] = $row->line ? $row->line->line_name : 'Not Assigned';
                // $nestedData[] = 'hehe';
                $nestedData[] = view('modal.edit-machine', ['machine' => $row, 'lines' => Line::all()])->render();
                // $nestedData[] = view('modal.edit-parameter', ['parameters' => Parameters::all(), 'parameter' => $row, 'device_uuid' => $request->device_uuid])->render();
                $data[] = $nestedData;
            }
        }

        $json_data = array(
            "draw"            => intval($request->input('draw')),
            "recordsTotal"    => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data"            => $data
        );
        echo json_encode($json_data);
    }
    public function addMachine(Request $request)
    {
        //
        if (auth()->user()->role !== 'admin') {
            return back()->with('failed', 'Need admin privillages.');
        }
        $rules = [
            'machine_name' => 'required|max:255',
            'line_id' => 'max:255'
        ];
        $validatedData = $request->validate($rules);
        $affected_row = Machine::create($validatedData);
        // dd($affected_row);
        if ($affected_row) {
            return redirect('/setup')->with('success', 'New Machine has been added!');
        }
        return redirect('/setup')->with('failed', 'Adding Machine failed!');
    }
    public function editMachine(Request $request)
    {
        //
        $rules = [
            // 'id' => 'required',
            'machine_name' => 'required|max:255',
            'line_id' => 'max:255',
        ];
        $validatedData = $request->validate($rules);
        try {
            $affected_row = Machine::where('id', $request->id)->update($validatedData);
            if ($affected_row) {
                return redirect('/setup')->with('success', 'Machine ' . $request->machine_name . ' has been edited!');
            }
            return redirect('/setup')->with('failed', 'Editing Machine failed!');
        } catch (Throwable $e) {
            return redirect('/setup')->with('failed', 'Editing Machine failed!');
        }
    }
    public function deleteMachine(Request $request)
    {
        if (auth()->user()->role !== 'admin') {
            return back()->with('failed', 'Need admin privillages.');
        }
        $affected_row = Machine::where('id', $request->id)->delete();
        if ($affected_row) {
            return redirect('/setup')->with('success', 'Machine ' . $request->machine_name . ' has been deleted!');
        }
        return redirect('/setup')->with('failed', 'Deleting Machine failed!');
    }
    public function shiftList(Request $request)
    {
        $columns = array(
            // 0 => 'created_at',
            0 => 'shift_name',
            1 => 'shift_group',
            2 => 'shift_start',
            3 => 'shift_end',

        );
        $collection = DB::table('shift');;
        $totalData = $collection->count();

        $totalFiltered = $totalData;

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        if (empty($request->input('search.value'))) {
            $table = $collection->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();
        } else {
            $search = $request->input('search.value');
            $table = $collection->where(function ($query) use ($columns, $search) {
                foreach ($columns as $col) {
                    $query->orWhere($col, 'LIKE', "%{$search}%");
                }
                return $query;
            })
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();
            $totalFiltered = $collection->where(function ($query) use ($columns, $search) {
                foreach ($columns as $col) {
                    $query->orWhere($col, 'LIKE', "%{$search}%");
                }
                return $query;
            })->count();
        }

        $data = array();
        if (!empty($table)) {
            foreach ($table as $row) {
                $nestedData = [];
                // $nestedData[] = $row->created_at;
                $nestedData[] = $row->shift_name;
                $nestedData[] = $row->shift_group;
                $nestedData[] = date('H:i', strtotime($row->shift_start));
                $nestedData[] = date('H:i', strtotime($row->shift_end));
                // $nestedData[] = 'hehe';
                $nestedData[] = view('modal.edit-shift', ['shift' => $row])->render();
                // $nestedData[] = view('modal.edit-parameter', ['parameters' => Parameters::all(), 'parameter' => $row, 'device_uuid' => $request->device_uuid])->render();
                $data[] = $nestedData;
            }
        }

        $json_data = array(
            "draw"            => intval($request->input('draw')),
            "recordsTotal"    => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data"            => $data
        );
        echo json_encode($json_data);
    }
    public function addShift(Request $request)
    {
        //
        if (auth()->user()->role !== 'admin') {
            return back()->with('failed', 'Need admin privillages.');
        }
        $rules = [
            'shift_name' => 'required|max:255',
            'shift_group' => 'required|max:255',
            'shift_start' => 'required',
            'shift_end' => 'required',
        ];
        $validatedData = $request->validate($rules);
        $affected_row = Shift::create($validatedData);
        // dd($affected_row);
        if ($affected_row) {
            return redirect('/setup')->with('success', 'New Shift has been added!');
        }
        return redirect('/setup')->with('failed', 'Adding Shift failed!');
    }
    public function editShift(Request $request)
    {
        //
        if (auth()->user()->role !== 'admin') {
            return back()->with('failed', 'Need admin privillages.');
        }
        $rules = [
            'shift_name' => 'required|max:255',
            'shift_group' => 'required|max:255',
            'shift_start' => 'required',
            'shift_end' => 'required',
        ];
        $validatedData = $request->validate($rules);
        // dd($affected_row);
        $affected_row = Shift::where('id', $request->id)->update($validatedData);
        if ($affected_row) {
            return redirect('/setup')->with('success', 'Shift has been edited!');
        }
        return redirect('/setup')->with('failed', 'Adding Shift failed!');
    }
    public function deleteShift(Request $request)
    {
        if (auth()->user()->role !== 'admin') {
            return back()->with('failed', 'Need admin privillages.');
        }
        $affected_row = Shift::where('id', $request->id)->delete();
        if ($affected_row) {
            return redirect('/setup')->with('success', 'Shift ' . $request->shift_name . ' has been deleted!');
        }
        return redirect('/setup')->with('failed', 'Deleting Shift failed!');
    }
    public function historicalLog(Request $request)
    {
        $range = (int)$request->input('range') ?: 1;
        $from = $request->input('from');
        $to = $request->input('to');
        $line = $request->input('line');
        $machine = $request->input('machine');
        $shift = $request->input('shift');
        $group = $request->input('group');
        $user = $request->input('user');
        $sku = $request->input('sku');
        $hmi = $request->input('hmi');
        $pic = $request->input('pic');
        $nik = $request->input('nik');
        $mode = $request->input('mode');
        $low = $request->input('low');
        $high = $request->input('high');
        $working_date = $request->input('working_date');
        $columns = array(
            0 => 'created_at',
            1 => 'working_date',
            2 => 'line_name',
            3 => 'hmi_name',
            4 => 'machine_name',
            5 => 'shift_name',
            6 => 'shift_group',
            // 6 => 'hmi_name',
            7 => 'sku_name',
            8 => 'weight',
            // 9 => 'target',
            // 10 => 'th_H',
            // 11 => 'th_L',
            9 => 'status',
            10 => 'user',
            11 => 'pic',
        );
        // $collection = DB::table('historical_log')->with(['sku', 'machine', 'line', 'shift']);

        $collection = new Historical;
        // $collection = Historical::select('historical_log.*', 'sku.sku_name', 'line.line_name', 'machine.machine_name', 'shift.shift_name', 'shift.shift_group', 'hmi.hmi_name')
        // ->leftJoin('machine', 'machine.id', '=', 'historical_log.machine_id')
        // ->leftJoin('sku', 'sku.id', '=', 'historical_log.sku_id')
        // ->leftJoin('line', 'line.id', '=', 'historical_log.line_id')
        // ->leftJoin('shift', 'shift.id', '=', 'historical_log.shift_id')
        // ->leftJoin('hmi', 'hmi.id', '=', 'historical_log.hmi_id');
        // dd($mode);
        if ($mode == 'hmi') {
            if ($machine) {
                $machine_name = Machine::where('id', $machine)->first()->machine_name;
                $collection = $collection->where('machine_name', $machine_name);
                // $collection = $collection->where('machine_name', $machine);
            }
            // if ($hmi) {
            //     $hmi_name = Hmi::where('id', $hmi)->first()->hmi_name;
            //     $collection = $collection->where('hmi_name', $hmi_name);
            //     // $collection = $collection->where('machine_name', $machine);
            // }
            $collection = $collection->where('created_at', '>=', Carbon::now()->subDays(30));
        } else {
            if ($line) {
                // $line_name = Line::where('id', $line)->first()->line_name;
                // $collection = $collection->where('line_name', $line_name);
                $collection = $collection->where('line_name', $line);
            }
            if ($machine) {
                // $machine_name = Machine::where('id', $machine)->first()->machine_name;
                // $collection = $collection->where('machine_name', $machine_name);
                $collection = $collection->where('machine_name', $machine);
            }
            if ($shift) {
                // $shift_name = Shift::where('id', $shift)->first()->shift_name;
                // $collection = $collection->where('shift_name', $shift_name);
                $collection = $collection->where('shift_name', $shift);
            }
            if ($group) {
                // $shift_name = Shift::where('id', $shift)->first()->shift_name;
                // $collection = $collection->where('shift_name', $shift_name);
                $collection = $collection->where('shift_group', $group);
            }
            if ($sku) {
                // $sku_name = Sku::where('id', $sku)->first()->sku_name;
                // $collection = $collection->where('sku_name', $sku_name);
                $collection = $collection->where('sku_name', $sku);
            }
            if ($hmi) {
                // $hmi_name = Hmi::where('id', $hmi)->first()->hmi;
                // $collection = $collection->where('hmi_name', $hmi_name);
                $collection = $collection->where('hmi_name', $hmi);
            }
            if ($user) {
                // $hmi_name = Hmi::where('id', $hmi)->first()->hmi;
                // $collection = $collection->where('hmi_name', $hmi_name);
                $collection = $collection->where('user', $user);
            }
            if ($pic) {
                // $hmi_name = Hmi::where('id', $hmi)->first()->hmi;
                // $collection = $collection->where('hmi_name', $hmi_name);
                $collection = $collection->where('pic', $pic);
            }
            if ($nik) {
                // $hmi_name = Hmi::where('id', $hmi)->first()->hmi;
                // $collection = $collection->where('hmi_name', $hmi_name);
                $collection = $collection->where('nik', $nik);
            }
            if ($low) {
                $collection = $collection->where('weight', '>=', $low);
            }
            if ($high) {
                $collection = $collection->where('weight', '<=', $high);
            }
            if ($working_date) {
                $collection = $collection->where('working_date', $working_date);
            }
            if ($from && $to) {
                $from = date("Y-m-d H:i:s", $from);
                $to = date("Y-m-d H:i:s", $to);
                $collection = $collection->where([
                    ['created_at', '>=', $from], ['created_at', '<=', $to]
                ]);
            } elseif ($range) {
                $collection = $collection->where('created_at', '>=', Carbon::now()->subDays($range));
            }
        }
        $totalData = $collection->count();

        $totalFiltered = $totalData;

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        if (empty($request->input('search.value'))) {
            $table = $collection->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();
        } else {
            $search = $request->input('search.value');
            $table = $collection->where(function ($query) use ($columns, $search) {
                foreach ($columns as $col) {
                    $query->orWhere($col, 'LIKE', "%{$search}%");
                }
                return $query;
            })
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();
            $totalFiltered = $collection->where(function ($query) use ($columns, $search) {
                foreach ($columns as $col) {
                    $query->orWhere($col, 'LIKE', "%{$search}%");
                }
                return $query;
            })->count();
        }

        $data = array();
        if (!empty($table)) {
            foreach ($table as $row) {
                $nestedData = [];
                $nestedData[] = $row->created_at;
                // $nestedData[] = $row->created_at->format('Y-m-d H:i:s');
                $nestedData[] = $row->working_date;
                $nestedData[] = $row->line_name;
                $nestedData[] = $row->hmi_name;
                $nestedData[] = $row->machine_name;
                $nestedData[] = $row->shift_name;
                $nestedData[] = $row->shift_group;
                // $nestedData[] = $row->hmi_name;
                $nestedData[] = $row->sku_name;
                $nestedData[] = $row->weight;
                // $nestedData[] = $row->target;
                // $nestedData[] = $row->th_H;
                // $nestedData[] = $row->th_L;
                $nestedData[] = $row->status == 'PASS' ? '<span class="text-success">' . $row->status . '</span>' : '<span class="text-danger">' . $row->status . '</span>';
                $nestedData[] = $row->user;
                $nestedData[] = $row->pic;
                // $nestedData[] = 'hehe';
                // $nestedData[] = view('modal.edit-shift', ['shift' => $row])->render();
                // $nestedData[] = view('modal.edit-parameter', ['parameters' => Parameters::all(), 'parameter' => $row, 'device_uuid' => $request->device_uuid])->render();
                $data[] = $nestedData;
            }
        }

        $json_data = array(
            "draw"            => intval($request->input('draw')),
            "recordsTotal"    => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data"            => $data
        );
        echo json_encode($json_data);
    }
    public function hmiList(Request $request)
    {
        $columns = array(
            // 0 => 'created_at',
            0 => 'hmi_name',
            1 => 'line.line_name',
            2 => 'hmi_th'
        );
        // $collection = DB::table('shift');;
        // $collection = new Hmi();
        $collection = Hmi::select('hmi.*', 'line.line_name',)
            ->leftJoin('line', 'line.id', '=', 'hmi.line_id');
        $totalData = $collection->count();

        $totalFiltered = $totalData;

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        if (empty($request->input('search.value'))) {
            $table = $collection->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();
        } else {
            $search = $request->input('search.value');
            $table = $collection->where(function ($query) use ($columns, $search) {
                foreach ($columns as $col) {
                    $query->orWhere($col, 'LIKE', "%{$search}%");
                }
                return $query;
            })
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();
            $totalFiltered = $collection->where(function ($query) use ($columns, $search) {
                foreach ($columns as $col) {
                    $query->orWhere($col, 'LIKE', "%{$search}%");
                }
                return $query;
            })->count();
        }

        $data = array();
        if (!empty($table)) {
            foreach ($table as $row) {
                $nestedData = [];
                // $nestedData[] = $row->created_at;
                $nestedData[] = $row->hmi_name;
                $nestedData[] = $row->line ? $row->line->line_name : 'Not Assigned';
                $nestedData[] = $row->hmi_th;
                // $nestedData[] = 'hehe';
                $nestedData[] = view('modal.edit-hmi', ['hmi' => $row, 'lines' => Line::all()])->render();
                // $nestedData[] = view('modal.edit-parameter', ['parameters' => Parameters::all(), 'parameter' => $row, 'device_uuid' => $request->device_uuid])->render();
                $data[] = $nestedData;
            }
        }

        $json_data = array(
            "draw"            => intval($request->input('draw')),
            "recordsTotal"    => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data"            => $data
        );
        echo json_encode($json_data);
    }
    public function editHmi(Request $request)
    {
        //
        if (auth()->user()->role !== 'admin') {
            return back()->with('failed', 'Need admin privillages.');
        }
        $rules = [
            'line_id' => 'max:255',
            'hmi_th' => 'required'
        ];
        $validatedData = $request->validate($rules);
        $affected_row = Hmi::where('id', $request->id)->update($validatedData);
        if ($affected_row) {
            return redirect('/setup')->with('success', 'HMI ' . $request->hmi_name . ' has been edited!');
        }
        return redirect('/setup')->with('failed', 'Editing HMI failed!');
    }

    public function picList(Request $request)
    {
        $columns = array(
            // 0 => 'created_at',
            0 => 'pic_name',
            1 => 'nik'

        );
        $collection = DB::table('pic');;
        $totalData = $collection->count();

        $totalFiltered = $totalData;

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        if (empty($request->input('search.value'))) {
            $table = $collection->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();
        } else {
            $search = $request->input('search.value');
            $table = $collection->where(function ($query) use ($columns, $search) {
                foreach ($columns as $col) {
                    $query->orWhere($col, 'LIKE', "%{$search}%");
                }
                return $query;
            })
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();
            $totalFiltered = $collection->where(function ($query) use ($columns, $search) {
                foreach ($columns as $col) {
                    $query->orWhere($col, 'LIKE', "%{$search}%");
                }
                return $query;
            })->count();
        }

        $data = array();
        if (!empty($table)) {
            foreach ($table as $row) {
                $nestedData = [];
                // $nestedData[] = $row->created_at;
                $nestedData[] = $row->pic_name;
                $nestedData[] = $row->nik;
                // $nestedData[] = 'hehe';
                $nestedData[] = view('modal.edit-pic', ['pic' => $row])->render();
                // $nestedData[] = view('modal.edit-parameter', ['parameters' => Parameters::all(), 'parameter' => $row, 'device_uuid' => $request->device_uuid])->render();
                $data[] = $nestedData;
            }
        }

        $json_data = array(
            "draw"            => intval($request->input('draw')),
            "recordsTotal"    => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data"            => $data
        );
        echo json_encode($json_data);
    }
    public function addPic(Request $request)
    {
        //
        if (auth()->user()->role !== 'admin') {
            return back()->with('failed', 'Need admin privillages.');
        }
        $rules = [
            'pic_name' => 'required|max:255',
            'nik' => 'required|max:255',
        ];
        $validatedData = $request->validate($rules);
        $affected_row = Pic::create($validatedData);
        if ($affected_row) {
            return redirect('/setup')->with('success', 'New PIC has been added!');
        }
        return redirect('/setup')->with('failed', 'Adding PIC failed!');
    }
    public function editPic(Request $request)
    {
        //
        if (auth()->user()->role !== 'admin') {
            return back()->with('failed', 'Need admin privillages.');
        }
        $rules = [
            'pic_name' => 'required|max:255',
            'nik' => 'required|max:255',
        ];
        $validatedData = $request->validate($rules);
        // dd($affected_row);
        $affected_row = Pic::where('id', $request->id)->update($validatedData);
        if ($affected_row) {
            return redirect('/setup')->with('success', 'PIC has been edited!');
        }
        return redirect('/setup')->with('failed', 'Adding PIC failed!');
    }
    public function deletePic(Request $request)
    {
        if (auth()->user()->role !== 'admin') {
            return back()->with('failed', 'Need admin privillages.');
        }
        $affected_row = Pic::where('id', $request->id)->delete();
        if ($affected_row) {
            return redirect('/setup')->with('success', 'PIC ' . $request->pic_name . ' has been deleted!');
        }
        return redirect('/setup')->with('failed', 'Deleting PIC failed!');
    }
}
