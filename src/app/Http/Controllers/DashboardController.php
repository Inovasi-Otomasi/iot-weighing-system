<?php

namespace App\Http\Controllers;

use App\Charts\GeneralChart;
use App\Exports\HistoricalLogExport;
use App\Models\Historical;
use App\Models\Line;
use App\Models\Machine;
use App\Models\Shift;
use App\Models\Sku;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class DashboardController extends Controller
{
    //
    public function index(Request $request)
    {
        if (auth()->user()->role !== 'admin') {
            return redirect()->route('hmi');
        }
        $data = [
            'title' => 'Home',
            'breadcrumb' => 'Dashboard',
            'lines' => Line::all(),
            'machines' => Machine::all(),
            'sku_list' => DB::table('historical_log')->select('sku_name')->distinct()->get(),
            'shifts' => Shift::all(),
            'request' => $request
        ];
        $data['charts'] = $this->renderChart($request);
        $data['summary'] = $this->summary($request);
        return view('dashboard.index', $data);
    }
    public function renderChart($request)
    {
        $sku = $request->input('sku');
        $bar_options = [
            'toolbox' => [
                'show' => true,
                // 'orient' => 'vertical',
                // 'left' => 'right',
                // 'top' => 'center',
                'feature' => [
                    'mark' => ['show' => true],
                    // 'dataView' => ['show' => true, 'readOnly' => false],
                    // 'magicType' => ['show' => true, 'type' => ['line', 'bar', 'stack']],
                    // 'restore' => ['show' => true],
                    'saveAsImage' => ['show' => true]
                ]
            ],
            'tooltip' => [
                // 'trigger' => 'axis',
                // 'show' => false
                'axisPointer' => [
                    'type' => 'shadow'
                ],
                'formatter' => '<b>{b}</b>: {c}'

            ],
            'legend' => [],
            'grid' => [
                'left' => '3%',
                'right' => '4%',
                'bottom' => '3%',
                'containLabel' => true
            ],
            'yAxis' => [
                'type' => 'value',
                'boundaryGap' => [0, 0.01]
            ],
            'xAxis' => [
                'type' => 'category',
                'show' => true,
                'data' => ['UNDER', 'PASS', 'OVER'],
                // 'axisLine' => [
                //     'lineStyle' => [
                //         'color' => '#54B435'
                //     ]
                // ]
            ],
        ];
        $gauge_options =
            [
                'radius' => '50%',
                'type' => 'gauge',
                'center' => ['50%', '50%'],
                'startAngle' => 200,
                'endAngle' => -20,
                'splitNumber' => 10,
                'itemStyle' => [
                    'color' => '#13678A'
                ],
                'progress' => [
                    'show' => true,
                    'width' => 30
                ],
                'pointer' => [
                    'show' => false
                ],
                'axisLine' => [
                    'lineStyle' => [
                        'width' => 30
                    ]
                ],
                'axisTick' => [
                    'distance' => -45,
                    'splitNumber' => 5,
                    'lineStyle' => [
                        'width' => 2,
                        'color' => '#000'
                    ]
                ],
                'splitLine' => [
                    'distance' => -52,
                    'length' => 14,
                    'lineStyle' => [
                        'width' => 3,
                        'color' => '#000'
                    ]
                ],
                'axisLabel' => [
                    'distance' => -15,
                    'color' => '#000',
                    'fontSize' => 18
                ],
                'anchor' => [
                    'show' => false
                ],
                'title' => [
                    'show' => false
                ],
                'detail' => [
                    'valueAnimation' => true,
                    'width' => '60%',
                    'lineHeight' => 40,
                    'borderRadius' => 8,
                    'offsetCenter' => [0, '-15%'],
                    'fontWeight' => 'bolder',
                    'color' => 'auto',
                    'fontSize' => 20,
                ]
            ];

        $gauge_options2 = [
            'radius' => '50%',
            'type' => 'gauge',
            'center' => ['50%', '50%'],
            'startAngle' => 200,
            'endAngle' => -20,
            // 'itemStyle' => [
            //     'color' => '#FD7347'
            // ],
            'progress' => [
                'show' => false,
                'width' => 8
            ],
            'pointer' => [
                'show' => false
            ],
            'axisLine' => [
                'show' => true,
                'lineStyle' => [
                    'width' => -5,
                    // 'color' => [
                    //     [0.7, '#F49D1A'],
                    //     [0.8, '#54B435'],
                    //     [1, '#DC3535']
                    // ]
                ]
            ],
            'axisTick' => [
                'show' => false
            ],
            'splitLine' => [
                'show' => false
            ],
            'axisLabel' => [
                'show' => false
            ],
            'anchor' => [
                'show' => false
            ],
            'title' => [
                'show' => false
            ],
            'detail' => [
                'show' => false
            ],
            'data' => [
                'value' => 55
            ]
        ];

        $line_options = [
            'animation' => true,
            'tooltip' => [
                'trigger' => 'axis',
                'show' => true
            ],
            'color' => '#13678A',
            'toolbox' => [
                'feature' => [
                    // 'dataZoom' => [
                    //     'yAxisIndex' > false
                    // ],
                    // 'restore' => [],
                    'saveAsImage' => []
                ],
            ],

            'xAxis' => [
                'type' => 'time',
                'boundaryGap' => false,
                // 'inverse' => true
            ],
            'yAxis' => [
                'type' => 'value',
                'boundaryGap' => [0, '100%']
            ],
            'dataZoom' => [
                [
                    'type' => 'slider',
                ],
            ],
        ];

        // $first_log = $parameters_log_ranged->first() ?: 0;
        $chart_bar = new GeneralChart;
        $chart_bar->options($bar_options);
        $chart_bar->dataset('', 'bar', [NULL, NULL, NULL])->options(
            [
                'itemStyle' => [
                    'color' => '#13678A'
                ],
                'label' => [
                    'show' => true,
                    // 'formatter' => '{c} {b}'
                ]
            ]
        );
        // $chart_bar->dataset('Underweight', 'bar', [2])->options(
        //     [
        //         'itemStyle' => [
        //             'color' => '#F49D1A'
        //         ],
        //         'label' => [
        //             'show' => true,
        //             'formatter' => '{a} {c}'
        //         ]
        //     ]
        // );
        // $chart_bar->dataset('Overweight', 'bar', [3])->options(
        //     [
        //         'itemStyle' => [
        //             'color' => '#DC3535'
        //         ],
        //         'label' => [
        //             'show' => true,
        //             'formatter' => '{a} {c}'
        //         ]
        //     ]
        // );

        $chart_gauge = new GeneralChart;
        $chart_gauge->dataset('', 'gauge', [NULL])
            ->options([
                'detail' => [
                    'formatter' => '{value} Kg',
                ],
                'min' => 0,
                'max' => 10,
            ])
            ->options($gauge_options);
        $chart_line = new GeneralChart;
        // if ($sku) {
        if (0) {
            $sku_obj = Sku::where('id', $sku)->first();
            // dd($sku_obj->th_H / 10);
            $chart_line->dataset('', 'line', [NULL, NULL])->options([
                'smooth' => true,
                'areaStyle' => [
                    'opacity' => 0.2
                ],
                'markLine' => [
                    'silent' => false,
                    'lineStyle' => [
                        'color' => '#333'
                    ],
                    'data' => [
                        [
                            'yAxis' => $sku_obj->th_L,
                            'label' => [
                                'show' => true,
                                'formatter' => '{c} Low'
                            ],
                        ],
                        [
                            'yAxis' => $sku_obj->th_H,
                            'label' => [
                                'show' => true,
                                'formatter' => '{c} High'
                            ],
                        ],
                    ]
                ]
            ]);
            $chart_gauge->dataset('', 'gauge', [0])
                ->options([
                    'min' => 0,
                    'max' => 10,
                    'axisLine' => [
                        'lineStyle' => [
                            'color' => [
                                [($sku_obj->th_L / 10), '#F49D1A'],
                                [($sku_obj->th_H / 10), '#54B435'],
                                [1, '#DC3535']
                            ]
                        ]
                    ],
                ])
                ->options($gauge_options2);;
        } else {
            $chart_line->dataset('', 'line', [NULL, NULL])->options([
                'smooth' => true,
                'areaStyle' => [
                    'opacity' => 0.2
                ]
            ]);
        }

        $chart_line->options($line_options);

        $data = [
            'chart_gauge' => $chart_gauge,
            'chart_line' => $chart_line,
            'chart_bar' => $chart_bar
        ];
        return $data;
    }
    public function liveDataOnce(Request $request)
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
        $low = $request->input('low');
        $high = $request->input('high');
        $working_date = $request->input('working_date');
        $parameters_log_ranged = [];
        // $parameters_log = App::make(DynamicModel::class, ['table_name' => 'device_' . $request->device_id . '_log']);
        // $parameters_log = DB::table('historical_log');
        $parameters_log = new Historical();
        if ($line) {
            // $line_name = Line::where('id', $line)->first()->line_name;
            // $parameters_log = $parameters_log->where('line_name', $line_name);
            $parameters_log = $parameters_log->where('line_name', $line);
        }
        if ($machine) {
            // $machine_name = Machine::where('id', $machine)->first()->machine_name;
            // $parameters_log = $parameters_log->where('machine_name', $machine_name);
            $parameters_log = $parameters_log->where('machine_name', $machine);
        }
        if ($shift) {
            // $shift_name = Shift::where('id', $shift)->first()->shift_name;
            // $parameters_log = $parameters_log->where('shift_name', $shift_name);
            $parameters_log = $parameters_log->where('shift_name', $shift);
        }
        if ($group) {
            // $sku_name = Sku::where('id', $sku)->first()->sku_name;
            // $parameters_log = $parameters_log->where('sku_name', $sku_name);
            $parameters_log = $parameters_log->where('shift_group', $group);
        }
        if ($sku) {
            // $sku_name = Sku::where('id', $sku)->first()->sku_name;
            // $parameters_log = $parameters_log->where('sku_name', $sku_name);
            $parameters_log = $parameters_log->where('sku_name', $sku);
        }
        if ($hmi) {
            // $sku_name = Sku::where('id', $sku)->first()->sku_name;
            // $parameters_log = $parameters_log->where('sku_name', $sku_name);
            $parameters_log = $parameters_log->where('hmi_name', $hmi);
        }
        if ($user) {
            // $sku_name = Sku::where('id', $sku)->first()->sku_name;
            // $parameters_log = $parameters_log->where('sku_name', $sku_name);
            $parameters_log = $parameters_log->where('user', $user);
        }
        if ($pic) {
            // $sku_name = Sku::where('id', $sku)->first()->sku_name;
            // $parameters_log = $parameters_log->where('sku_name', $sku_name);
            $parameters_log = $parameters_log->where('pic', $pic);
        }
        if ($nik) {
            // $sku_name = Sku::where('id', $sku)->first()->sku_name;
            // $parameters_log = $parameters_log->where('sku_name', $sku_name);
            $parameters_log = $parameters_log->where('nik', $nik);
        }
        if ($low) {
            $parameters_log = $parameters_log->where('weight', '>=', $low);
        }
        if ($high) {
            $parameters_log = $parameters_log->where('weight', '<=', $high);
        }
        if ($working_date) {
            $parameters_log = $parameters_log->where('working_date', $working_date);
        }
        if ($from && $to) {
            $from = date("Y-m-d H:i:s", $from);
            $to = date("Y-m-d H:i:s", $to);
            $parameters_log_ranged = $parameters_log->where([
                ['created_at', '>=', $from], ['created_at', '<=', $to]
            ])->get();
        } elseif ($range) {
            $parameters_log_ranged = $parameters_log->where('created_at', '>=', Carbon::now()->subDays($range))->get();
        }

        $value = $parameters_log_ranged->last() ?: 0;

        $status = [
            'OK' => $parameters_log_ranged->where('status', 'PASS')->count() ?: 0,
            'UNDERWEIGHT' => $parameters_log_ranged->where('status', 'UNDER')->count() ?: 0,
            'OVERWEIGHT' => $parameters_log_ranged->where('status', 'OVER')->count() ?: 0,
        ];

        return json_encode(['value' => $value, 'status' => $status, 'log' => $parameters_log_ranged]);
    }
    public function liveData(Request $request)
    {
        $range = (int)$request->input('range') ?: 1;
        $from = $request->input('from');
        $to = $request->input('to');
        $line = $request->input('line');
        $machine = $request->input('machine');
        $shift = $request->input('shift');
        $sku = $request->input('sku');
        $parameters_log_ranged = [];
        // $parameters_log = App::make(DynamicModel::class, ['table_name' => 'device_' . $request->device_id . '_log']);
        $parameters_log = new Historical();
        if ($line) {
            // $line_name = Line::where('id', $line)->first()->line_name;
            // $parameters_log = $parameters_log->where('line_name', $line_name);
            $parameters_log = $parameters_log->where('line_id', $line);
        }
        if ($machine) {
            // $machine_name = Machine::where('id', $machine)->first()->machine_name;
            // $parameters_log = $parameters_log->where('machine_name', $machine_name);
            $parameters_log = $parameters_log->where('machine_id', $machine);
        }
        if ($shift) {
            // $shift_name = Shift::where('id', $shift)->first()->shift_name;
            // $parameters_log = $parameters_log->where('shift_name', $shift_name);
            $parameters_log = $parameters_log->where('shift_id', $shift);
        }
        if ($sku) {
            // $sku_name = Sku::where('id', $sku)->first()->sku_name;
            // $parameters_log = $parameters_log->where('sku_name', $sku_name);
            $parameters_log = $parameters_log->where('sku_id', $sku);
        }
        if ($from && $to) {
            $from = date("Y-m-d H:i:s", $from);
            $to = date("Y-m-d H:i:s", $to);
            $parameters_log_ranged = $parameters_log->where([
                ['created_at', '>=', $from], ['created_at', '<=', $to]
            ])->latest()->get();
        } else {
            $parameters_log_ranged = $parameters_log->where('created_at', '>=', Carbon::now()->subDays($range))->latest()->get();
        }

        $value = $parameters_log_ranged->first() ?: 0;
        $status = [
            'OK' => $parameters_log_ranged->where('status', '=', 'PASS')->count() ?: 0,
            'UNDERWEIGHT' => $parameters_log_ranged->where('status', '=',  'UNDER')->count() ?: 0,
            'OVERWEIGHT' => $parameters_log_ranged->where('status', '=',  'OVER')->count() ?: 0,
        ];

        return json_encode(['value' => $value, 'status' => $status]);
    }

    public function export(Request $request)
    {
        return new HistoricalLogExport($request);
        // return Excel::download(new HistoricalLogExport($request), ($request->working_date ?: 'All') . '_' . ($request->shift ?: 'All') . '_' . ($request->group ?: 'All') . '_' . ($request->sku ?: 'All') . '.xlsx');
    }
    public function summary(Request $request)
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
        $parameters_log_ranged = [];
        $parameters_log = new Historical();
        if ($line) {
            $parameters_log = $parameters_log->where('line_name', $line);
        }
        if ($machine) {
            $parameters_log = $parameters_log->where('machine_name', $machine);
        }
        if ($shift) {
            $parameters_log = $parameters_log->where('shift_name', $shift);
        }
        if ($group) {
            $parameters_log = $parameters_log->where('shift_group', $group);
        }
        if ($sku) {
            $parameters_log = $parameters_log->where('sku_name', $sku);
        }
        if ($hmi) {
            $parameters_log = $parameters_log->where('hmi_name', $hmi);
        }
        if ($user) {
            $parameters_log = $parameters_log->where('user', $user);
        }
        if ($pic) {
            $parameters_log = $parameters_log->where('pic', $pic);
        }
        if ($nik) {
            $parameters_log = $parameters_log->where('nik', $nik);
        }
        if ($from && $to) {
            $from = date("Y-m-d H:i:s", $from);
            $to = date("Y-m-d H:i:s", $to);
            $parameters_log_ranged = $parameters_log->where([
                ['created_at', '>=', $from], ['created_at', '<=', $to]
            ])->get();
        } elseif ($range) {
            $parameters_log_ranged = $parameters_log->where('created_at', '>=', Carbon::now()->subDays($range))->get();
        }

        $average = round($parameters_log_ranged->avg('weight'), 3) ?: 0;
        $min = $parameters_log_ranged->min('weight') ?: 0;
        $max = $parameters_log_ranged->max('weight') ?: 0;

        return [
            'average' => $average,
            'min' => $min,
            'max' => $max
        ];
    }
}
