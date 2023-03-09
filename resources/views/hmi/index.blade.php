@extends('layouts.main')
@section('container')
    <hr class="my-0">
    {{-- <div class="btn-group flex-wrap mt-3">
        <div class="dropdown me-3 mb-2">
            <button class="btn btn-outline-iot mb-0 dropdown-toggle" type="button" id="dropdown-line" data-bs-toggle="dropdown"
                aria-expanded="false">
                Line : {{ request('line') ? $lines->where('id', request('line'))->first()->line_name : 'Not Selected' }}
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdown-line">
                @foreach ($lines as $line)
                    <li><a class="dropdown-item"
                            href="{{ $request->fullUrlWithQuery(['line' => $line->id]) }}">{{ $line->line_name }}</a>
                    </li>
                @endforeach
            </ul>
        </div>
        <div class="dropdown me-3 mb-2">
            <button class="btn btn-outline-iot mb-0 dropdown-toggle" type="button" id="dropdown-machine"
                data-bs-toggle="dropdown" aria-expanded="false">
                Machine :
                {{ request('machine') ? $machines->where('id', request('machine'))->first()->machine_name : 'Not Selected' }}
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdown-machine">
                @foreach ($machines as $machine)
                    <li><a class="dropdown-item"
                            href="{{ $request->fullUrlWithQuery(['machine' => $machine->id]) }}">{{ $machine->machine_name }}</a>
                    </li>
                @endforeach
            </ul>
        </div>
        <div class="dropdown me-3 mb-2">
            <button class="btn btn-outline-iot mb-0 dropdown-toggle" type="button" id="dropdown-shift"
                data-bs-toggle="dropdown" aria-expanded="false">
                Shift :
                {{ request('shift') ? $shifts->where('id', request('shift'))->first()->shift_name : 'Not Selected' }}
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdown-shift">
                @foreach ($shifts as $shift)
                    <li><a class="dropdown-item"
                            href="{{ $request->fullUrlWithQuery(['shift' => $shift->id]) }}">{{ $shift->shift_name }}</a>
                    </li>
                @endforeach
            </ul>
        </div>
        <div class="dropdown me-3 mb-2">
            <button class="btn btn-outline-iot mb-0 dropdown-toggle" type="button" id="dropdown-sku"
                data-bs-toggle="dropdown" aria-expanded="false">
                SKU : {{ request('sku') ? $sku_list->where('id', request('sku'))->first()->sku_name : 'Not Selected' }}
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdown-sku">
                @foreach ($sku_list as $sku)
                    <li><a class="dropdown-item"
                            href="{{ $request->fullUrlWithQuery(['sku' => $sku->id]) }}">{{ $sku->sku_name }}</a>
                    </li>
                @endforeach
            </ul>
        </div>
        <div class="dropdown me-3 mb-2">
            <button class="btn btn-outline-iot mb-0 dropdown-toggle" type="button" id="dropdown-time"
                data-bs-toggle="dropdown" aria-expanded="false">
                Working Date :
                {{ request('workingdate') ? date('Y-m-d', request('workingdate')) : 'Not Selected' }}
            </button>
            <div class="dropdown-menu" style=" " aria-labelledby="dropdown-time">
                <div class="row">
                    <div class="col">
                        <div class="mx-4 my-2">
                            <div id="datetimerange"
                                style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%">
                                <i class="fa fa-calendar"></i>&nbsp;
                                <span></span> <i class="fa fa-caret-down"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="dropdown me-3 mb-2">
            <button class="btn btn-outline-iot mb-0 dropdown-toggle" type="button" id="dropdown-user"
                data-bs-toggle="dropdown" aria-expanded="false">
                User : {{ request('user') == 'QC' || request('user') == 'Operator' ? request('user') : 'Not Selected' }}
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdown-user">
                <li><a class="dropdown-item" href="{{ $request->fullUrlWithQuery(['user' => 'Operator']) }}">Operator</a>
                </li>
                <li><a class="dropdown-item" href="{{ $request->fullUrlWithQuery(['user' => 'QC']) }}">QC</a></li>
            </ul>
        </div>
    </div> --}}
    {{-- <div class="mt-3 ">
        <form class="row g-2" action="{{ url('/hmi') }}">
            <div class="col-md">
                <div class="form-floating">
                    <select class="form-select" id="line-dropdown" name="line" required>
                        <option selected="true" disabled="disabled" value="">Not selected</option>
                        @foreach ($lines as $line)
                            <option value="{{ $line->id }}"
                                {{ old('line', request('line')) == $line->id ? 'selected' : '' }}>
                                {{ $line->line_name }}</option>
                        @endforeach
                    </select>
                    <label for="line-dropdown">Line</label>
                </div>
            </div>
            <div class="col-md">
                <div class="form-floating">
                    <select class="form-select" id="machine-dropdown" name="machine" required>
                        <option selected="true" disabled="disabled" value="">Not selected</option>
                        @foreach ($machines as $machine)
                            <option value="{{ $machine->id }}"
                                {{ old('machine', request('machine')) == $machine->id ? 'selected' : '' }}>
                                {{ $machine->machine_name }}</option>
                        @endforeach
                    </select>
                    <label for="machine-dropdown">Machine</label>
                </div>
            </div>
            <div class="col-md">
                <div class="form-floating">
                    <select class="form-select" id="shift-dropdown" name="shift" required>
                        <option selected="true" disabled="disabled" value="">Not selected</option>
                        @foreach ($shifts as $shift)
                            <option value="{{ $shift->id }}"
                                {{ old('shift', request('shift')) == $shift->id ? 'selected' : '' }}>
                                {{ $shift->shift_name }}</option>
                        @endforeach
                    </select>
                    <label for="shift-dropdown">Shift</label>
                </div>
            </div>
            <div class="col-md">
                <div class="form-floating">
                    <select class="form-select" id="sku-dropdown" name="sku" required>
                        <option selected="true" disabled="disabled" value="">Not selected</option>
                        @foreach ($sku_list as $sku)
                            <option value="{{ $sku->id }}"
                                {{ old('sku', request('sku')) == $sku->id ? 'selected' : '' }}>
                                {{ $sku->sku_name }}</option>
                        @endforeach
                    </select>
                    <label for="sku-dropdown">SKU</label>
                </div>
            </div>
            <div class="col-md">
                <div class="form-floating">
                    <select class="form-select" id="user-dropdown" name="user" required>
                        <option selected="true" disabled="disabled" value="">Not selected</option>
                        <option value="Operator" {{ old('user', request('user')) == 'Operator' ? 'selected' : '' }}>
                            Operator</option>
                        <option value="QC" {{ old('user', request('user')) == 'QC' ? 'selected' : '' }}>QC</option>
                    </select>
                    <label for="user-dropdown">User</label>
                </div>
            </div>
            <div class="col-md">
                <div class="form-floating">
                    <input type="date" class="form-control" id="working-date" name="working_date"
                        value="{{ old('working_date', request('working_date')) }}" required>
                    <label for="working-date">Working Date</label>
                </div>
            </div>
            <div class="col-md">
                <button class="btn btn-outline-iot mb-0 h-100 w-100" type="submit">
                    Apply
                </button>
            </div>
        </form>
    </div> --}}
    {{-- @livewire('dropdown-selection') --}}
    <div class="row mt-4">
        <div class="col-xl-3 col-sm-12 mb-xl-0">
            @livewire('dropdown-selection')
            {{-- <div class="card  border shadow-xs mb-4">
                <div class="card-body">
                    <h5 class="card-title text-center">USER</h5>
                    <a class="btn btn-outline-iot w-100 {{ request('user') == 'Operator' ? 'active' : '' }}"
                        href="{{ $request->fullUrlWithQuery(['user' => 'Operator']) }}">Operator</a>
                    <a class="btn btn-outline-iot w-100 {{ request('user') == 'QC' ? 'active' : '' }}"
                        href="{{ $request->fullUrlWithQuery(['user' => 'QC']) }}">QC</a>
                </div>
            </div> --}}
            <div class="card  border shadow-xs mb-4">
                @livewire('user-selection')
                {{-- <div class="card-body">
                    <h5 class="card-title text-center">USER</h5>
                    <a class="btn btn-outline-iot w-100 {{ request('user') == 'Operator' ? 'active' : '' }}"
                        href="{{ $request->fullUrlWithQuery(['user' => 'Operator']) }}">Operator</a>
                    <a class="btn btn-outline-iot w-100 {{ request('user') == 'QC' ? 'active' : '' }}"
                        href="{{ $request->fullUrlWithQuery(['user' => 'QC']) }}">QC</a>
                </div> --}}
            </div>
            {{-- <div class="card  border shadow-xs mb-4">
                @livewire('pic-selection')
            </div> --}}
        </div>
        <div class="col-xl-6 col-sm-12 mb-xl-0">
            <div class="card border shadow-xs mb-4">
                <div class="card-body text-start p-3 w-100 row">

                    {{-- <div
                        class="icon icon-shape icon-sm bg-success text-white text-center rounded-circle d-flex align-items-center justify-content-center mb-3">
                        <i class="fa-solid fa-stop"></i>
                    </div> --}}


                    {{-- <div class="d-flex justify-content-center">
                        <button class="btn btn-iot mt-2 mb-0 btn-lg"
                            style="border-radius:70%!important;padding:2rem!important;">
                            <i class="fa-solid fa-play icon-lg"></i>
                        </button>
                    </div> --}}
                    <div class="col">
                        <div class="row">
                            <div class="col-12">
                                <div class="w-100">
                                    <p class="text-sm text-secondary mb-1">Weight</p>
                                    <h4 class="font-weight-bold display-3 mb-0"><span id="actual-weight"></span></h4>
                                    {{-- @livewire('actual-weight', ['request' => request()->all()]) --}}
                                    <h4 class="mb-2 font-weight-bold">gram</h4>
                                    <div class="d-flex align-items-center">
                                        <span id="percentage-from-target"></span>
                                    </div>
                                    {{-- @livewire('percentage-weight', ['request' => request()->all()]) --}}
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="">
                                    {{-- @livewire('passing', ['request' => request()->all()]) --}}
                                    <h1 class=" font-weight-bold">
                                        <span id="weight-status"></span>
                                    </h1>
                                    {{-- <h3 class="text-center text-success">UNDER</h3> --}}
                                </div>
                            </div>
                        </div>
                        {{-- <div class="form-check form-switch mt-3">
                            <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault">
                            <label class="form-check-label" for="flexSwitchCheckDefault">AUTO</label>
                        </div> --}}
                        {{-- @livewire('auto-selection') --}}
                        <div class="form-check form-switch mt-3">
                            <input class="form-check-input" type="checkbox" role="switch" id="auto-selection">
                            <label class="form-check-label" for="flexSwitchCheckDefault">AUTO</label>
                        </div>
                    </div>
                    <div class="col">
                        <div class="mb-3 row">
                            <div class="col text-center">
                                <p><span id="auto-status"></span></p>
                            </div>
                            <div class="col text-center">
                                <p><span id="stable-status"></span></p>
                            </div>
                            <div class="col text-center">
                                <p><span id="sent-status"></span></p>
                            </div>
                            <div class="col text-center">
                                <p><span id="timeout-status"></span></p>
                            </div>
                            {{-- <span class="badge bg-gradient-success mx-1 ms-auto">Stable</span> --}}
                            {{-- <span class="badge bg-gradient-warning mx-1">Stand by</span> --}}
                            {{-- <span class="badge bg-gradient-secondary mx-1">Manual</span> --}}
                        </div>

                        {{-- <div class="ms-auto d-flex">
                                <button type="button" class="btn btn-sm btn-white mb-0">
                                    <i class="fa-solid fa-cog"></i>
                                </button>
                            </div> --}}
                        {{-- @livewire('submit-log', ['request' => request()->all()]) --}}
                        <div>
                            <div class="d-flex justify-content-center">
                                <button class="btn btn-iot mt-2 mb-0 btn-lg" id="submit-log"
                                    style="border-radius:70%!important;padding:2rem!important;">
                                    <i class="fa-solid fa-play icon-lg"></i>
                                </button>

                            </div>
                            <div id="flash-message"></div>
                            {{-- @if (session()->has('successMsg'))
                                <div class="alert alert-success alert-dismissible text-center mt-5">
                                    {{ session('successMsg') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true" class="text-dark">&times;</span>
                                    </button>
                                </div>
                            @elseif(session()->has('failedMsg'))
                                <div class="alert alert-danger alert-dismissible text-center mt-5">
                                    {{ session('failedMsg') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true" class="text-dark">&times;</span>
                                    </button>
                                </div>
                            @endif --}}
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-12 mb-xl-0">
            <div class="card border shadow-xs mb-4">
                @livewire('machine-selection')
                {{-- <div class="card-body">
                    <h5 class="card-title text-center">MACHINE</h5>
                    <div class="row overflow-auto" style="max-height:220px;">
                        @foreach ($machines as $machine)
                            <div class="col-6">
                                <a class="btn btn-outline-iot w-100 {{ request('machine') == $machine->id ? 'active' : '' }}"
                                    href="{{ $request->fullUrlWithQuery(['machine' => $machine->id]) }}">{{ $machine->machine_name }}</a>
                            </div>
                        @endforeach
                    </div>
                </div> --}}
            </div>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-xl-12 col-sm-12 mb-xl-0">
            <div class="card border shadow-xs mb-4">
                {{-- <div class="card-header border-bottom pb-0">
                    <div class="d-sm-flex align-items-center">
                        <div>
                            <h6 class="font-weight-semibold text-lg mb-0">Historical Log</h6>
                            <p class="text-sm">See information about all events on your site.</p>
                        </div>
                    </div>
                </div> --}}
                <div class="card-body table-responsive">
                    <table id="historical_log" class="display text-center" style="width:100%">
                        <thead>
                            <tr>
                                <th>Created At</th>
                                <th>Working Date</th>
                                <th>Line Name</th>
                                <th>HMI</th>
                                <th>Machine Name</th>
                                <th>Shift</th>
                                <th>Group</th>
                                {{-- <th>HMI</th> --}}
                                <th>SKU Name</th>
                                <th>Weight</th>
                                {{-- <th>Target</th>
                                <th>Threshold High</th>
                                <th>Threshold Low</th> --}}
                                <th>Status</th>
                                <th>User</th>
                                <th>PIC</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
