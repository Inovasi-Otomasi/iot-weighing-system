@extends('layouts.main')
@section('container')
    <div class="row">
        <div class="col-xl-12 col-sm-12">
            <ul class="nav nav-tabs" id="myTab">
                {{-- <li class="nav-item">
                    <a href="#overview" class="nav-link active" data-bs-toggle="tab">Overview</a>
                </li> --}}
                <li class="nav-item">
                    <a href="#section_hmi" class="nav-link active" data-bs-toggle="tab">HMI</a>
                </li>
                <li class="nav-item">
                    <a href="#section_line" class="nav-link" data-bs-toggle="tab">LINE</a>
                </li>
                <li class="nav-item">
                    <a href="#section_machine" class="nav-link" data-bs-toggle="tab">MACHINE</a>
                </li>
                <li class="nav-item">
                    <a href="#section_shift" class="nav-link" data-bs-toggle="tab">SHIFT</a>
                </li>
                <li class="nav-item">
                    <a href="#section_sku" class="nav-link" data-bs-toggle="tab">SKU</a>
                </li>
                <li class="nav-item">
                    <a href="#section_pic" class="nav-link" data-bs-toggle="tab">PIC</a>
                </li>

            </ul>
            <div class="tab-content">
                <div id="section_line" class="tab-pane fade card border shadow-xs mb-4">
                    <div class="card-header border-bottom pb-0">
                        <div class="d-sm-flex align-items-center">
                            <div>
                                <h6 class="font-weight-semibold text-lg mb-0">Line list</h6>
                                <p class="text-sm">See information about all line.</p>
                            </div>
                            <div class="ms-auto d-flex">
                                <button type="button" class="btn btn-sm btn-iot btn-icon d-flex align-items-center me-2"
                                    data-bs-toggle="modal" data-bs-target="#addLineModal">
                                    <span class="btn-inner--icon me-2">
                                        <i class="fa-solid fa-plus"></i>
                                    </span>
                                    <span class="btn-inner--text">Add Line</span>
                                </button>

                                <div class="modal fade" id="addLineModal" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalMessageTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <form method="post" action="/add_line">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Add new Line
                                                    </h5>
                                                    <button type="button" class="btn-close text-dark"
                                                        data-bs-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    @csrf
                                                    <div class="form-group">
                                                        <label for="line-name" class="col-form-label">Line Name:</label>
                                                        <input type="text"
                                                            class="form-control @error('line_name') is-invalid @enderror"
                                                            id="line-name" name="line_name" value="{{ old('line_name') }}">
                                                        @error('line_name')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-white"
                                                        data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-iot">Save</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body table-responsive">
                        <table id="line_list" class="display text-center" style="width:100%">
                            <thead>
                                <tr>
                                    {{-- <th>Created At</th> --}}
                                    <th>Line Name</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div id="section_machine" class="tab-pane fade card border shadow-xs mb-4">
                    <div class="card-header border-bottom pb-0">
                        <div class="d-sm-flex align-items-center">
                            <div>
                                <h6 class="font-weight-semibold text-lg mb-0">Machine list</h6>
                                <p class="text-sm">See information about all machine.</p>
                            </div>
                            <div class="ms-auto d-flex">
                                {{-- <button type="button" class="btn btn-sm btn-white me-2">
                                View all
                            </button> --}}
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-sm btn-iot btn-icon d-flex align-items-center me-2"
                                    data-bs-toggle="modal" data-bs-target="#addMachineModal">
                                    <span class="btn-inner--icon me-2">
                                        <i class="fa-solid fa-plus"></i>
                                    </span>
                                    <span class="btn-inner--text">Add Machine</span>
                                </button>

                                <!-- Modal -->
                                <div class="modal fade" id="addMachineModal" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalMessageTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <form method="post" action="/add_machine">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Add new Machine
                                                    </h5>
                                                    <button type="button" class="btn-close text-dark"
                                                        data-bs-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    @csrf
                                                    <div class="form-group">
                                                        <label for="machine-name" class="col-form-label">Machine
                                                            Name:</label>
                                                        <input type="text"
                                                            class="form-control @error('machine_name') is-invalid @enderror"
                                                            id="machine-name" name="machine_name"
                                                            value="{{ old('machine_name') }}">
                                                        @error('machine_name')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="line-id" class="col-form-label">Line Name</label>
                                                        <select class="form-select" id="line-id" name="line_id">
                                                            <option value="">
                                                                Not Assigned
                                                            </option>
                                                            @foreach ($lines as $line)
                                                                <option value="{{ $line->id }}">
                                                                    {{ $line->line_name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        @error('line_id')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-white"
                                                        data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-iot">Save</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body table-responsive">
                        <table id="machine_list" class="display text-center" style="width:100%">
                            <thead>
                                <tr>
                                    {{-- <th>Created At</th> --}}
                                    <th>Machine Name</th>
                                    <th>Line Name</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div id="section_shift" class="tab-pane fade card border shadow-xs mb-4">
                    <div class="card-header border-bottom pb-0">
                        <div class="d-sm-flex align-items-center">
                            <div>
                                <h6 class="font-weight-semibold text-lg mb-0">Shift list</h6>
                                <p class="text-sm">See information about all shift.</p>
                            </div>
                            <div class="ms-auto d-flex">
                                {{-- <button type="button" class="btn btn-sm btn-white me-2">
                                View all
                            </button> --}}
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-sm btn-iot btn-icon d-flex align-items-center me-2"
                                    data-bs-toggle="modal" data-bs-target="#addShiftModal">
                                    <span class="btn-inner--icon me-2">
                                        <i class="fa-solid fa-plus"></i>
                                    </span>
                                    <span class="btn-inner--text">Add Shift</span>
                                </button>

                                <!-- Modal -->
                                <div class="modal fade" id="addShiftModal" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalMessageTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <form method="post" action="/add_shift">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Add new Shift
                                                    </h5>
                                                    <button type="button" class="btn-close text-dark"
                                                        data-bs-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    @csrf
                                                    <div class="form-group">
                                                        <label for="shift-name" class="col-form-label">Shift Name:</label>
                                                        <input type="text"
                                                            class="form-control @error('shift_name') is-invalid @enderror"
                                                            id="shift-name" name="shift_name"
                                                            value="{{ old('shift_name') }}">
                                                        @error('shift_name')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="shift-group" class="col-form-label">Shift
                                                            Group:</label>
                                                        <input type="text"
                                                            class="form-control @error('shift_group') is-invalid @enderror"
                                                            id="shift-group" name="shift_group"
                                                            value="{{ old('shift_group') }}">
                                                        @error('shift_group')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="shift-start" class="col-form-label">Shift
                                                            Start:</label>
                                                        <input type="time"
                                                            class="form-control @error('shift_start') is-invalid @enderror"
                                                            id="shift-start" name="shift_start"
                                                            value="{{ old('shift_start') }}">
                                                        @error('shift_start')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="shift-end" class="col-form-label">Shift End:</label>
                                                        <input type="time"
                                                            class="form-control @error('shift_end') is-invalid @enderror"
                                                            id="shift-end" name="shift_end"
                                                            value="{{ old('shift_end') }}">
                                                        @error('shift_end')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-white"
                                                        data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-iot">Save</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body table-responsive">
                        <table id="shift_list" class="display text-center" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Shift</th>
                                    <th>Group</th>
                                    <th>Start</th>
                                    <th>End</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div id="section_hmi" class="tab-pane fade show active card border shadow-xs mb-4">
                    <div class="card-header border-bottom pb-0">
                        <div class="d-sm-flex align-items-center">
                            <div>
                                <h6 class="font-weight-semibold text-lg mb-0">HMI list</h6>
                                <p class="text-sm">See information about all HMI.</p>
                            </div>
                        </div>
                    </div>
                    <div class="card-body table-responsive">
                        <table id="hmi_list" class="display text-center" style="width:100%">
                            <thead>
                                <tr>
                                    <th>HMI Name</th>
                                    <th>Line Name</th>
                                    <th>HMI Threshold</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div id="section_pic" class="tab-pane fade card border shadow-xs mb-4">
                    <div class="card-header border-bottom pb-0">
                        <div class="d-sm-flex align-items-center">
                            <div>
                                <h6 class="font-weight-semibold text-lg mb-0">PIC list</h6>
                                <p class="text-sm">See information about all PIC.</p>
                            </div>
                            <div class="ms-auto d-flex">
                                {{-- <button type="button" class="btn btn-sm btn-white me-2">
                                View all
                            </button> --}}
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-sm btn-iot btn-icon d-flex align-items-center me-2"
                                    data-bs-toggle="modal" data-bs-target="#addPICModal">
                                    <span class="btn-inner--icon me-2">
                                        <i class="fa-solid fa-plus"></i>
                                    </span>
                                    <span class="btn-inner--text">Add PIC</span>
                                </button>

                                <!-- Modal -->
                                <div class="modal fade" id="addPICModal" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalMessageTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <form method="post" action="/add_pic">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Add new PIC
                                                    </h5>
                                                    <button type="button" class="btn-close text-dark"
                                                        data-bs-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    @csrf
                                                    <div class="form-group">
                                                        <label for="pic-name" class="col-form-label">PIC
                                                            Name:</label>
                                                        <input type="text"
                                                            class="form-control @error('pic_name') is-invalid @enderror"
                                                            id="pic-name" name="pic_name"
                                                            value="{{ old('pic_name') }}">
                                                        @error('pic_name')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                        <label for="nik" class="col-form-label">NIK:</label>
                                                        <input type="number"
                                                            class="form-control @error('nik') is-invalid @enderror"
                                                            id="nik" name="nik" value="{{ old('nik') }}">
                                                        @error('nik')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-white"
                                                        data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-iot">Save</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body table-responsive">
                        <table id="pic_list" class="display text-center" style="width:100%">
                            <thead>
                                <tr>
                                    {{-- <th>Created At</th> --}}
                                    <th>PIC Name</th>
                                    <th>NIK</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div id="section_sku" class="tab-pane fade card border shadow-xs mb-4">
                    <div class="card-header border-bottom pb-0">
                        <div class="d-sm-flex align-items-center">
                            <div>
                                <h6 class="font-weight-semibold text-lg mb-0">SKU list</h6>
                                <p class="text-sm">See information about all SKU.</p>
                            </div>
                            <div class="ms-auto d-flex">
                                {{-- <button type="button" class="btn btn-sm btn-white me-2">
                                    View all
                                </button> --}}
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-sm btn-iot btn-icon d-flex align-items-center me-2"
                                    data-bs-toggle="modal" data-bs-target="#addSKUModal">
                                    <span class="btn-inner--icon me-2">
                                        <i class="fa-solid fa-plus"></i>
                                    </span>
                                    <span class="btn-inner--text">Add SKU</span>
                                </button>

                                <!-- Modal -->
                                <div class="modal fade" id="addSKUModal" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalMessageTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <form method="post" action="/add_sku">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Add new SKU
                                                    </h5>
                                                    <button type="button" class="btn-close text-dark"
                                                        data-bs-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    @csrf
                                                    <div class="form-group">
                                                        <label for="sku-name" class="col-form-label">SKU Name:</label>
                                                        <input type="text"
                                                            class="form-control @error('sku_name') is-invalid @enderror"
                                                            id="sku-name" name="sku_name"
                                                            value="{{ old('sku_name') }}">
                                                        @error('sku_name')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="line-name" class="col-form-label">Line Name</label>
                                                        <select class="form-select" id="line-name" name="line_id">
                                                            @foreach ($lines as $line)
                                                                <option value="{{ $line->id }}">
                                                                    {{ $line->line_name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        @error('line_id')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="sku-target" class="col-form-label">Target:</label>
                                                        <input type="number" step="any"
                                                            class="form-control @error('target') is-invalid @enderror"
                                                            id="sku-target" name="target" value="{{ old('target') }}">
                                                        @error('target')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="sku-th-H" class="col-form-label">Threshold
                                                            High:</label>
                                                        <input type="number" step="any"
                                                            class="form-control @error('th_H') is-invalid @enderror"
                                                            id="sku-th-H" name="th_H" value="{{ old('th_H') }}">
                                                        @error('th_H')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="sku-th-L" class="col-form-label">Threshold
                                                            Low:</label>
                                                        <input type="number" step="any"
                                                            class="form-control @error('th_L') is-invalid @enderror"
                                                            id="sku-th-L" name="th_L" value="{{ old('th_L') }}">
                                                        @error('th_L')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-white"
                                                        data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-iot">Save</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body table-responsive">
                        <table id="sku_list" class="display text-center" style="width:100%">
                            <thead>
                                <tr>
                                    {{-- <th>Created At</th> --}}
                                    <th>SKU Name</th>
                                    <th>Line Name</th>
                                    <th>Target</th>
                                    <th>Threshold High</th>
                                    <th>Threshold Low</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>

    </div>
    {{-- <div class="row">
        <div class="col-12">
            <div class="card border shadow-xs mb-4">
                <div class="card-header border-bottom pb-0">
                    <div class="d-sm-flex align-items-center">
                        <div>
                            <h6 class="font-weight-semibold text-lg mb-0">SKU list</h6>
                            <p class="text-sm">See information about all SKU.</p>
                        </div>
                        <div class="ms-auto d-flex">
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-sm btn-dark btn-icon d-flex align-items-center me-2"
                                data-bs-toggle="modal" data-bs-target="#addSKUModal">
                                <span class="btn-inner--icon me-2">
                                    <i class="fa-solid fa-plus"></i>
                                </span>
                                <span class="btn-inner--text">Add SKU</span>
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="addSKUModal" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalMessageTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <form method="post" action="/add_sku">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Add new SKU
                                                </h5>
                                                <button type="button" class="btn-close text-dark"
                                                    data-bs-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                @csrf
                                                <div class="form-group">
                                                    <label for="sku-name" class="col-form-label">SKU Name:</label>
                                                    <input type="text"
                                                        class="form-control @error('sku_name') is-invalid @enderror"
                                                        id="sku-name" name="sku_name" value="{{ old('sku_name') }}">
                                                    @error('sku_name')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="sku-target" class="col-form-label">Target:</label>
                                                    <input type="number" step="any"
                                                        class="form-control @error('target') is-invalid @enderror"
                                                        id="sku-target" name="target" value="{{ old('target') }}">
                                                    @error('target')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="sku-th-H" class="col-form-label">Threshold High:</label>
                                                    <input type="number" step="any"
                                                        class="form-control @error('th_H') is-invalid @enderror"
                                                        id="sku-th-H" name="th_H" value="{{ old('th_H') }}">
                                                    @error('th_H')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="sku-th-L" class="col-form-label">Threshold Low:</label>
                                                    <input type="number" step="any"
                                                        class="form-control @error('th_L') is-invalid @enderror"
                                                        id="sku-th-L" name="th_L" value="{{ old('th_L') }}">
                                                    @error('th_L')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>

                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-white"
                                                    data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-dark">Save</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body table-responsive">
                    <table id="sku_list" class="display text-center" style="width:100%">
                        <thead>
                            <tr>
                                <th>SKU Name</th>
                                <th>Target</th>
                                <th>Threshold High</th>
                                <th>Threshold Low</th>
                                <th>Created At</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div> --}}
@endsection
