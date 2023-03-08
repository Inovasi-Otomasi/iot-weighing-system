<!--
=========================================================
* Corporate UI - v1.0.0
=========================================================

* Product Page: https://www.creative-tim.com/product/corporate-ui
* Copyright 2022 Creative Tim (https://www.creative-tim.com)
* Licensed under MIT (https://www.creative-tim.com/license)
* Coded by Creative Tim

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
-->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="/assets/img/iot/favicon.png">
    <link rel="icon" type="image/png" href="/assets/img/iot/favicon.png">
    <title>
        IOT Weighing System
    </title>
    {{-- <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700|Noto+Sans:300,400,500,600,700,800|PT+Mono:300,400,500,600,700"
        rel="stylesheet" /> --}}
    <link href="/assets/css/all.css" rel="stylesheet" />
    <link rel="stylesheet" href="/assets/css/iot.css">
    <style>
        #map {
            width: "100%";
            height: 600px;
        }
    </style>
    <link id="pagestyle" href="/assets/css/corporate-ui-dashboard.css?v=1.0.0" rel="stylesheet" />
    <link href="/assets/css/jquery.dataTables.min.css" rel="stylesheet" />
    <link href="/assets/css/daterangepicker.css" rel="stylesheet" />
    <link href="/assets/css/select2/select2.min.css" rel="stylesheet" />
    @livewireStyles()
</head>

<body class="g-sidenav-show  bg-gray-100">
    @include('layouts.sidebar')
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        @include('layouts.navbar')
        <!-- End Navbar -->
        <div class="container-fluid py-4 px-5">
            @if (session()->has('success'))
                {{-- <div class="alert alert-success" role="alert">
                    {{ session('success') }}
                </div> --}}
                <div class="alert alert-success alert-dismissible text-sm fade show" role="alert">
                    <span class="alert-text">{{ session('success') }}</span>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true" class="text-dark">&times;</span>
                    </button>
                </div>
            @elseif (session()->has('failed'))
                <div class="alert alert-danger alert-dismissible text-sm fade show" role="alert">
                    <span class="alert-text">{{ session('failed') }}</span>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true" class="text-dark">&times;</span>
                    </button>
                </div>
            @endif
            @yield('container')
            @include('layouts.footer')
        </div>
    </main>
    <!--   Core JS Files   -->
    <script src="/assets/js/jquery-3.5.1.js"></script>
    <script src="/assets/js/core/popper.min.js"></script>
    <script src="/assets/js/core/bootstrap.min.js"></script>
    <script src="/assets/js/plugins/perfect-scrollbar.min.js"></script>
    <script src="/assets/js/plugins/smooth-scrollbar.min.js"></script>
    <script src="/assets/js/plugins/chartjs.min.js"></script>
    <script src="/assets/js/plugins/swiper-bundle.min.js" type="text/javascript"></script>
    <script src="/assets/js/all.js"></script>
    <script src="/assets/js/jquery.dataTables.min.js"></script>
    <script src="/assets/js/dist/echarts.js"></script>
    <script src="/assets/js/moment.min.js"></script>
    <script src="/assets/js/daterangepicker.min.js"></script>
    <script src="/assets/js/select2/select2.min.js"></script>
    <script src="/assets/js/corporate-ui-dashboard.js?v=1.0.0"></script>



    <script>
        var win = navigator.platform.indexOf('Win') > -1;
        if (win && document.querySelector('#sidenav-scrollbar')) {
            var options = {
                damping: '0.5'
            }
            Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
        }
    </script>
    <script>
        $(document).ready(function() {
            $('.js-example-basic-single').select2();
        });
        $(document).ready(function() {
            // $('#sku-dropdown-1').select2();
            $('#sku-dropdown-1').on('change', function(e) {
                Livewire.emit('updateSku',
                    $('#sku-dropdown-1').select2("val"));
            });
        });
        $(document).ready(function() {
            $('#sku_list').DataTable({
                "lengthChange": false,
                "processing": false, //Feature control the processing indicator.
                "serverSide": true, //Feature control DataTables' server-side processing mode.
                "ajax": {
                    "url": "{{ url('sku_list') }}",
                    "type": "POST",
                    "data": {
                        _token: "{{ csrf_token() }}",
                    }
                },
            });
            $('#line_list').DataTable({
                "lengthChange": false,
                "processing": false, //Feature control the processing indicator.
                "serverSide": true, //Feature control DataTables' server-side processing mode.
                "ajax": {
                    "url": "{{ url('line_list') }}",
                    "type": "POST",
                    "data": {
                        _token: "{{ csrf_token() }}",
                    }
                },
            });
            $('#machine_list').DataTable({
                "lengthChange": false,
                "processing": false, //Feature control the processing indicator.
                "serverSide": true, //Feature control DataTables' server-side processing mode.
                "ajax": {
                    "url": "{{ url('machine_list') }}",
                    "type": "POST",
                    "data": {
                        _token: "{{ csrf_token() }}",
                    }
                },
            });
            $('#shift_list').DataTable({
                "lengthChange": false,
                "processing": false, //Feature control the processing indicator.
                "serverSide": true, //Feature control DataTables' server-side processing mode.
                "ajax": {
                    "url": "{{ url('shift_list') }}",
                    "type": "POST",
                    "data": {
                        _token: "{{ csrf_token() }}",
                    }
                },
            });
            $('#hmi_list').DataTable({
                "lengthChange": false,
                "processing": false, //Feature control the processing indicator.
                "serverSide": true, //Feature control DataTables' server-side processing mode.
                "ajax": {
                    "url": "{{ url('hmi_list') }}",
                    "type": "POST",
                    "data": {
                        _token: "{{ csrf_token() }}",
                    }
                },
            });
            $('#pic_list').DataTable({
                "lengthChange": false,
                "processing": false, //Feature control the processing indicator.
                "serverSide": true, //Feature control DataTables' server-side processing mode.
                "ajax": {
                    "url": "{{ url('pic_list') }}",
                    "type": "POST",
                    "data": {
                        _token: "{{ csrf_token() }}",
                    }
                },
            });
        });
        @if (Request::is('setup'))
            $(document).ready(function() {
                $('a[data-bs-toggle="tab"]').on('shown.bs.tab', function(e) {
                    localStorage.setItem('lastTab', $(this).attr('href'));
                });
                var lastTab = localStorage.getItem('lastTab');
                if (lastTab) {
                    $('a[href="' + lastTab + '"]').tab('show');
                }
            });
        @endif
        @if (Request::is('/'))
            function waitForElement(elementPath, callBack) {
                window.setTimeout(function() {
                    if ($(elementPath).length) {
                        callBack(elementPath, $(elementPath));
                    } else {
                        waitForElement(elementPath, callBack);
                    }
                }, 500)
            }
            $('#datetimerange').ready(function() {
                var url = new URL(("{{ $request->fullUrl() }}").replaceAll('&amp;', '&'));
                var start = url.searchParams.has('from') ? (moment.unix(url.searchParams.get('from')) != 0 ? moment
                        .unix(url.searchParams.get('from')) : moment()
                        .startOf(
                            'hour').subtract(1, "days")) : moment()
                    .startOf(
                        'hour').subtract(1, "days");
                var end = url.searchParams.has('to') ? (moment.unix(url.searchParams.get('to')) != 0 ? moment.unix(
                    url.searchParams.get('to')) : moment().startOf(
                    'hour')) : moment().startOf(
                    'hour');

                function cb_date(start, end) {

                    // var url2 = new URL((
                    //         "{{ $request->fullUrlWithQuery(['range' => null, 'from' => null, 'to' => null]) }}"
                    //     )
                    //     .replaceAll('&amp;', '&'));
                    // url2.searchParams.set('from', start.unix());
                    // url2.searchParams.set('to', end.unix());
                    // window.location.replace(url2);
                    // $('#from').val(start.format('YYYY-MM-DDThh:mm:ss'));
                    // $('#to').val(end.format('YYYY-MM-DDThh:mm:ss'));
                    $('#from').val(start.unix());
                    $('#to').val(end.unix());
                    $('#range').val(null);

                }
                $('#datetimerange').daterangepicker({
                    timePicker: true,
                    startDate: start,
                    endDate: end,
                    // startDate: moment().startOf('hour'),
                    // endDate: moment().startOf('hour').add(32, 'hour'),
                    locale: {
                        separator: " to ",
                        format: 'YYYY-MM-DD HH:mm:ss'
                    }
                    // cb_date(start, end);
                }, cb_date);
                $('#datetimerange span').html(start.format('YYYY-MM-DD HH:mm:ss') + ' To ' + end.format(
                    'YYYY-MM-DD HH:mm:ss'));

            });
            $(document).ready(function() {
                let created_at;
                let datapoll;
                let isLoaded = false;
                let getLiveDataOnce = function() {
                    $.ajax({
                        type: 'POST',
                        url: '{{ url('livedata_once') }}',
                        async: true,
                        dataType: 'json',
                        data: {
                            _token: "{{ csrf_token() }}",
                            range: {{ request('range') ?: 'null' }},
                            from: {{ request('from') ?: 'null' }},
                            to: {{ request('to') ?: 'null' }},
                            line: "{{ request('line') ?: null }}",
                            machine: "{{ request('machine') ?: null }}",
                            shift: "{{ request('shift') ?: null }}",
                            group: "{{ request('group') ?: null }}",
                            sku: "{{ request('sku') ?: null }}",
                            user: "{{ request('user') ?: null }}",
                            pic: "{{ request('pic') ?: null }}",
                            hmi: "{{ request('hmi') ?: null }}",
                            nik: "{{ request('nik') ?: null }}",
                            low: {{ request('low') ?: 'null' }},
                            high: {{ request('high') ?: 'null' }},
                            working_date: "{{ request('working_date') ?: null }}",
                        },
                        success: function(data) {
                            // if ('value' in data && !data.value) {
                            // window.{{ $charts['chart_gauge']->id }}
                            //     .setOption({
                            //         series: [{
                            //             data: [{
                            //                 value: data.value[
                            //                     'weight'
                            //                 ]
                            //             }]
                            //         }]
                            //     });
                            window.{{ $charts['chart_bar']->id }}
                                .setOption({
                                    series: [{
                                        data: [{
                                            value: data.status['UNDERWEIGHT'],
                                            label: {
                                                show: true,
                                                formatter: '{c}\n(' + ((100 / (
                                                            data
                                                            .status[
                                                                'UNDERWEIGHT'
                                                            ] +
                                                            data.status[
                                                                'OK'] +
                                                            data.status[
                                                                'OVERWEIGHT'
                                                            ])) *
                                                        data.status[
                                                            'UNDERWEIGHT'])
                                                    .toFixed(2) + ' %)'
                                            }
                                        }, {
                                            value: data.status['OK'],
                                            label: {
                                                show: true,
                                                formatter: '{c}\n(' + ((100 / (
                                                            data
                                                            .status[
                                                                'UNDERWEIGHT'
                                                            ] +
                                                            data.status[
                                                                'OK'] +
                                                            data.status[
                                                                'OVERWEIGHT'
                                                            ])) *
                                                        data.status[
                                                            'OK'])
                                                    .toFixed(2) + ' %)'
                                            }
                                        }, {
                                            value: data.status['OVERWEIGHT'],
                                            label: {
                                                show: true,
                                                formatter: '{c}\n(' + ((100 / (
                                                            data
                                                            .status[
                                                                'UNDERWEIGHT'
                                                            ] +
                                                            data.status[
                                                                'OK'] +
                                                            data.status[
                                                                'OVERWEIGHT'
                                                            ])) *
                                                        data.status[
                                                            'OVERWEIGHT'])
                                                    .toFixed(2) + ' %)'
                                            }
                                        }]
                                    }]
                                });
                            created_at = data.value['created_at'];
                            window.{{ $charts['chart_line']->id }}
                                .setOption({
                                    series: [{
                                        data: data.log.map(
                                            function(row) {
                                                return [row[
                                                    'created_at'
                                                ], row[
                                                    'weight'
                                                ]];
                                            })
                                    }]
                                });
                            datapoll = data.log;
                            isLoaded = true;
                            // }
                        }
                    });
                }

                // let getLiveData = function() {
                //     if (isLoaded) {
                //         $.ajax({
                //             type: 'POST',
                //             url: '{{ url('livedata') }}',
                //             async: true,
                //             dataType: 'json',
                //             data: {
                //                 _token: "{{ csrf_token() }}",
                //                 range: {{ request('range') ?: 'null' }},
                //                 from: {{ request('from') ?: 'null' }},
                //                 to: {{ request('to') ?: 'null' }},
                //                 line: "{{ request('line') ?: null }}",
                //                 machine: "{{ request('machine') ?: null }}",
                //                 shift: "{{ request('shift') ?: null }}",
                //                 group: "{{ request('group') ?: null }}",
                //                 user: "{{ request('user') ?: null }}",
                //                 sku: "{{ request('sku') ?: null }}",
                //                 hmi: "{{ request('hmi') ?: null }}",
                //             },
                //             success: function(data) {
                //                 // if ('value' in data && !data.value) {
                //                 // window.{{ $charts['chart_gauge']->id }}
                //                 //     .setOption({
                //                 //         series: [{
                //                 //             data: [{
                //                 //                 value: data.value[
                //                 //                     'weight'
                //                 //                 ]
                //                 //             }]
                //                 //         }]
                //                 //     });
                //                 window.{{ $charts['chart_bar']->id }}
                //                     .setOption({
                //                         series: [{
                //                             data: [{
                //                                 value: data.status[
                //                                     'UNDERWEIGHT']
                //                             }, {
                //                                 value: data.status[
                //                                     'OK']
                //                             }, {
                //                                 value: data.status['OVERWEIGHT']
                //                             }]
                //                         }]
                //                     });
                //                 if (created_at != data.value['created_at']) {
                //                     datapoll.push(data.value);
                //                     window.{{ $charts['chart_line']->id }}
                //                         .setOption({
                //                             series: [{
                //                                 data: datapoll.map(
                //                                     function(row) {
                //                                         return [row[
                //                                             'created_at'
                //                                         ], row[
                //                                             'weight'
                //                                         ]];
                //                                     })
                //                             }]
                //                         });
                //                     // window.{{ $charts['chart_line']->id }}
                //                     //     .appendData({
                //                     //         seriesIndex: 0,
                //                     //         data: [name[data.value[
                //                     //             'created_at'
                //                     //         ], data.value[
                //                     //             'weight'
                //                     //         ]]]
                //                     //     });

                //                     // console.log('hehe');
                //                     created_at = data.value['created_at'];
                //                 }
                //                 // }
                //             }
                //         });
                //     }
                // }
                waitForElement("#{{ $charts['chart_bar']->id }}", getLiveDataOnce);
                // getLiveDataOnce();
                // setInterval(getLiveData, 5000);
            });
            $(document).ready(function() {
                $('#historical_log').DataTable({
                    order: [
                        [0, 'desc']
                    ],
                    "lengthChange": false,
                    "processing": false, //Feature control the processing indicator.
                    "serverSide": true, //Feature control DataTables' server-side processing mode.
                    "ajax": {
                        "url": "{{ url('historical_log') }}",
                        "type": "POST",
                        "data": {
                            _token: "{{ csrf_token() }}",
                            range: {{ request('range') ?: 'null' }},
                            from: {{ request('from') ?: 'null' }},
                            to: {{ request('to') ?: 'null' }},
                            line: "{{ request('line') ?: null }}",
                            machine: "{{ request('machine') ?: null }}",
                            shift: "{{ request('shift') ?: null }}",
                            group: "{{ request('group') ?: null }}",
                            user: "{{ request('user') ?: null }}",
                            sku: "{{ request('sku') ?: null }}",
                            hmi: "{{ request('hmi') ?: null }}",
                            pic: "{{ request('pic') ?: null }}",
                            nik: "{{ request('nik') ?: null }}",
                            low: {{ request('low') ?: 'null' }},
                            high: {{ request('high') ?: 'null' }},
                            working_date: "{{ request('working_date') ?: null }}",
                            mode: 'dashboard'
                        }
                    },
                });
            });
        @endif
        @if (Request::is('hmi'))
            let machineWire, skuWire, lineWire, shiftWire, hmiWire, skuAJAXWire;
            let autoSend = 0;
            let tableUpdated = false;
            document.addEventListener("DOMContentLoaded", () => {
                Livewire.hook('message.sent', (message, component) => {
                    // console.log(message.updateQueue[0].payload.method);
                    if (message.updateQueue[0].payload.method === 'updateMachine') {
                        machineWire = message.updateQueue[0].payload.params[0];
                        tableUpdated = true;
                        // console.log(tableUpdated);
                    }
                    if (message.updateQueue[0].payload.method === 'updateSku' || message.updateQueue[0]
                        .payload.method === 'updateSkuSelection') {
                        skuWire = message.updateQueue[0].payload.params[0];
                        // console.log(message.updateQueue[0].payload)
                        // tableUpdated = true;
                    }
                    // console.log(message.updateQueue[0].payload);
                    if (message.updateQueue[0].payload.event === 'updateSkuAJAX') {
                        skuAJAXWire = message.updateQueue[0].payload.params[0];
                        console.log(skuAJAXWire);
                        // console.log(message.updateQueue[0].payload);
                        // tableUpdated = true;
                    }
                    if (message.updateQueue[0].payload.method === 'updateLine') {
                        lineWire = message.updateQueue[0].payload.params[0];
                        // tableUpdated = true;
                    }
                    if (message.updateQueue[0].payload.method === 'updateShift') {
                        shiftWire = message.updateQueue[0].payload.params[0];
                        // tableUpdated = true;
                    }
                    if (message.updateQueue[0].payload.method === 'updateHmi') {
                        hmiWire = message.updateQueue[0].payload.params[0];
                        tableUpdated = true;
                    }
                    if (message.updateQueue[0].payload.method === 'sendLog') {
                        tableUpdated = true;
                    }
                });
            });


            $(document).ready(function() {
                let getLiveHMIauto = function() {
                    $.ajax({
                        type: 'POST',
                        url: '{{ url('live_hmi') }}',
                        async: true,
                        dataType: 'json',
                        data: {
                            _token: "{{ csrf_token() }}",
                            machine: machineWire || {{ request('machine') ?: 'null' }},
                            hmi: hmiWire || {{ request('hmi') ?: 'null' }}

                        },
                        success: function(data) {

                            let auto_html =
                                `<span class="badge bg-gradient-secondary">Manual</span>`;
                            if (data.percentage_result.auto) {
                                auto_html =
                                    `<span class="badge bg-gradient-success">Auto</span>`;
                            }


                            let sending_html =
                                `<span class="badge bg-gradient-warning">Reading</span>`;
                            if (data.percentage_result.sending) {
                                sending_html =
                                    `<span class="badge bg-gradient-success">Sent</span>`;
                                if (autoSend != data.percentage_result.sending) {
                                    tableUpdated = true;
                                    autoSend = data.percentage_result.sending
                                }
                            } else {
                                if (autoSend != data.percentage_result.sending) {
                                    autoSend = data.percentage_result.sending
                                }
                            }

                            $('#auto-status').html(auto_html);
                            $('#sent-status').html(sending_html);
                        },
                        complete: function(data) {
                            setTimeout(getLiveHMIauto, 250);
                        }
                    });
                }
                $(document).ready(function() {
                    setTimeout(getLiveHMIauto, 250);
                });


                function connect() {
                    var ws = new WebSocket('ws://localhost:1880/livedata');
                    ws.onopen = function() {
                        // subscribe to some channels
                        // ws.send(JSON.stringify({
                        //     //.... some message the I must send when I connect ....
                        // }));
                    };

                    ws.onmessage = function(e) {
                        // console.log('Message:', data);
                        // $('#actual-weight').html(data.data);
                        let new_sku = skuAJAXWire || {!! App\Models\Hmi::with('sku')->where('sku_id', request('sku'))->first()
                            ? json_encode(
                                App\Models\Hmi::with('sku')->where('sku_id', request('sku'))->first(),
                            )
                            : 'null' !!};
                        // console.log(JSON.parse(e.data));
                        var raw = JSON.parse(e.data).weight;
                        var data = raw.split(' ');
                        var datas = data[0];
                        var weight = Number(datas.split(',')[1]).toFixed(3);
                        var stable = datas.split(',')[0] == 'ST' ? 1 : 0;
                        let target = new_sku.sku ? new_sku.sku['target'] : 0;
                        var th_H = new_sku.sku ? new_sku.sku['th_H'] : 0;
                        var th_L = new_sku.sku ? new_sku.sku['th_L'] : 0;
                        let percentage = (weight * 100 / target) - 100;
                        let arrow = percentage < 0 ? 'down' : 'up';
                        let color = weight <= th_L || weight >= th_H ? 'danger' : 'success';
                        let timeout = JSON.parse(e.data).timeout;
                        var weight_status = 'UNDER';
                        if (weight >= th_L && weight <= th_H) {
                            weight_status = 'PASS';
                        } else if (weight < th_L) {
                            weight_status = 'UNDER';
                        } else if (weight > th_H) {
                            weight_status = 'OVER';
                        }

                        let percentage_html = `
                            <span class="text-sm text-${color} font-weight-bolder">
                                <i class="fa fa-chevron-${arrow} text-xs me-1" aria-hidden="true"></i>
                                <span>${percentage.toFixed(3)}</span> %
                            </span>
                            <span class="text-sm ms-1">from ${target} gram (target).</span>`;

                        let weight_status_html = `
                                <span class="text-${color}">${weight_status}</span>
                            `;

                        let stable_html =
                            `<span class="badge bg-gradient-danger">Unstable</span>`;
                        if (stable) {
                            stable_html =
                                `<span class="badge bg-gradient-success">Stable</span>`;
                        }

                        let timeout_html =
                            `<span class="badge bg-gradient-success">Sync</span>`;
                        if (timeout) {
                            timeout_html =
                                `<span class="badge bg-gradient-danger">Timeout</span>`;
                        }

                        $('#actual-weight').html(weight);
                        $('#percentage-from-target').html(percentage_html);
                        $('#weight-status').html(weight_status_html);
                        $('#stable-status').html(stable_html);
                        $('#timeout-status').html(timeout_html);
                    };

                    ws.onclose = function(e) {
                        console.log('Socket is closed. Reconnect will be attempted in 1 second.', e.reason);
                        setTimeout(function() {
                            connect();
                        }, 1000);
                    };

                    ws.onerror = function(err) {
                        console.error('Socket encountered error: ', err.message, 'Closing socket');
                        ws.close();
                    };
                }

                connect();


                $(function() {
                    var url = new URL(("{{ $request->fullUrl() }}").replaceAll('&amp;', '&'));
                    // console.log((url.href).replace('&amp;', '&'));
                    var working_date = url.searchParams.has('workingdate') ? moment.unix(url.searchParams
                        .get(
                            'workingdate')) : moment().startOf(
                        'hour');

                    function cb_date(working_date) {
                        var url2 = new URL((
                            "{{ $request->fullUrlWithQuery(['workingdate' => null]) }}"
                        ).replaceAll('&amp;', '&'));
                        url2.searchParams.set('workingdate', working_date.unix());
                        // url2.replace('&amp;', '&');

                        window.location.replace(url2);

                        // fetch({{ url('/') }})
                    }
                    $('#datetimerange').daterangepicker({
                        singleDatePicker: true,
                    }, cb_date);
                    $('#datetimerange span').html(working_date.format('YYYY-MM-DD'));
                });
                // });
                // $(document).ready(function() {
                let tableLog = function() {
                    $('#historical_log').DataTable({
                        order: [
                            [0, 'desc']
                        ],
                        "lengthChange": false,
                        "processing": false, //Feature control the processing indicator.
                        "serverSide": true, //Feature control DataTables' server-side processing mode.
                        "ajax": {
                            "url": "{{ url('historical_log') }}",
                            "type": "POST",
                            "data": {
                                _token: "{{ csrf_token() }}",
                                machine: machineWire || {{ request('machine') ?: 'null' }},
                                hmi: hmiWire || {{ request('hmi') ?: 'null' }},
                                mode: "hmi"
                            }
                        },
                    });
                }
                tableLog();
                let updateTable = function() {
                    if (tableUpdated) {
                        console.log('slebew');
                        $('#historical_log').DataTable().clear().destroy();
                        tableLog();
                        tableUpdated = false;
                    }
                }
                setInterval(updateTable, 500)

                $(document).keydown(function(keyPressed) {
                    if (keyPressed.keyCode == 77 && keyPressed.ctrlKey) {
                        $("#machine_search").focus();
                        // keyPressed.preventDefault();
                    } else if (keyPressed.keyCode == 83 && keyPressed.ctrlKey && keyPressed.shiftKey) {
                        $('#dropdown-sku').click();
                        $('#sku-search').focus();
                    } else if (keyPressed.keyCode == 88 && keyPressed.ctrlKey && keyPressed.shiftKey) {
                        $('#dropdown-pic').click();
                        $('#pic-search').focus();
                    }
                });
                $('#dropdown-sku').click(function() {
                    $('#sku-search').focus();
                });
                $('#dropdown-pic').click(function() {
                    $('#pic-search').focus();
                });
            });
        @endif
        @if (Request::is('admin_view'))
            $(document).ready(function() {
                let getAdminView = function() {
                    $.ajax({
                        type: 'POST',
                        url: '{{ url('live_admin_view') }}',
                        async: true,
                        dataType: 'json',
                        data: {
                            _token: "{{ csrf_token() }}",
                        },
                        success: function(data) {

                            data.forEach(function(item) {

                                let percentage_html = `
                            <span class="text-sm text-${item.percentage_result.color} font-weight-bolder">
                                <i class="fa fa-chevron-${item.percentage_result.arrow} text-xs me-1" aria-hidden="true"></i>
                                <span>${item.percentage_result.percentage}</span> %
                            </span>
                            <span class="text-sm ms-1">from ${item.percentage_result.target} gram (target).</span>`;

                                let weight_status = `
                                <span class="text-${item.percentage_result.color}">${item.weight_status}</span>
                            `;

                                let pic_detail = `
                                ${item.pic} (${item.nik})
                                `;
                                $('#actual-weight-' + item.id).html(item.actual_weight);
                                $('#percentage-from-target-' + item.id).html(
                                    percentage_html);
                                $('#weight-status-' + item.id).html(weight_status);
                                $('#machine-' + item.id).html(item.machine);
                                $('#sku-' + item.id).html(item.sku);
                                $('#user-' + item.id).html(item.user);
                                $('#pic-' + item.id).html(pic_detail);

                            })


                        }
                    });
                }
                getAdminView();
                setInterval(getAdminView, 1000);
            });
        @endif
    </script>
    <!-- Github buttons -->
    <!-- Control Center for Corporate UI Dashboard: parallax effects, scripts for the example pages etc -->
    {{-- <script src="/assets/js/corporate-ui-dashboard.js?v=1.0.0"></script> --}}
    @livewireScripts()
</body>

</html>
