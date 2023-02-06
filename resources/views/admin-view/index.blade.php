@extends('layouts.main')
@section('container')
    <div class="row">
        @foreach ($hmi_list as $hmi)
            <div class="col-lg-4">
                <div class="card border shadow-xs mb-4">
                    <div class="card-header border-bottom pb-0">
                        <div class="d-sm-flex align-items-center">
                            <div>
                                <h6 class="font-weight-semibold text-lg mb-0">HMI {{ $hmi->hmi_name }}</h6>
                            </div>
                        </div>
                    </div>
                    <div class="card-body row">
                        <div class="col">
                            <div class="row">
                                <div class="col-12">
                                    <div class="w-100">
                                        <p class="text-sm text-secondary mb-1">Weight</p>
                                        <h4 class="font-weight-bold display-3 mb-0"><span
                                                id="actual-weight-{{ $hmi->id }}"></span></h4>
                                        <h4 class="mb-2 font-weight-bold">gram</h4>
                                        <div class="d-flex align-items-center">
                                            <span id="percentage-from-target-{{ $hmi->id }}"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="">
                                        <h1 class=" font-weight-bold">
                                            <span id="weight-status-{{ $hmi->id }}"></span>
                                        </h1>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <p class="text-sm text-secondary mb-1">Machine : <span id="machine-{{ $hmi->id }}"></span>
                            </p>
                            <p class="text-sm text-secondary mb-1">SKU : <span id="sku-{{ $hmi->id }}"></p>
                            <p class="text-sm text-secondary mb-1">User : <span id="user-{{ $hmi->id }}"></p>
                            <p class="text-sm text-secondary mb-1">PIC : <span id="pic-{{ $hmi->id }}"></p>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

    </div>
@endsection
