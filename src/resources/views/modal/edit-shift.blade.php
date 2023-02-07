<button style="outline: none;box-shadow: none;" class="btn btn-sm btn-icon mb-0 me-2 border-0" data-bs-toggle="modal"
    data-bs-target="#editShiftModal-{{ $shift->id }}">
    <span class="btn-inner--icon">
        <i class="fa-solid fa-pen-to-square"></i>
    </span>
    {{-- <span class="btn-inner--text">Add Parameter</span> --}}
</button>

<button style="outline: none;box-shadow: none;" class="btn btn-sm btn-icon mb-0 me-2 border-0" data-bs-toggle="modal"
    data-bs-target="#deleteShiftModal-{{ $shift->id }}">
    <span class="btn-inner--icon">
        <i class="fa-solid fa-trash"></i>
    </span>
</button>

<!-- Modal -->
<div class="modal fade" id="editShiftModal-{{ $shift->id }}" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalMessageTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            {{-- <form method="post" action="/edit_shift">
                @method('put')
                @csrf
                <input type="text" class="form-control" id="shift-id" name="id" value="{{ $shift->id }}"
                    hidden required>
                <input type="text" class="form-control" id="shift-name" name="machine_name"
                    value="{{ $shift->shift_name }}" hidden required>
                <div class="modal-header">
                    <h6 class="modal-title" id="modal-title-notification">Your attention is required</h6>
                    <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body mx-3">
                    <div class="py-3 text-center">
                        <i class="ni ni-bell-55 ni-3x"></i>
                        <h4 class="text-gradient text-danger mt-4">Delete {{ $shift->shift_name }} ?</h4>
                        <p>You will not be able to restore deleted Shift.
                        </p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-white" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-dark">Delete</button>
                </div>
            </form> --}}
            <form method="post" action="/edit_shift">
                @method('put')
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Shift
                    </h5>
                    <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    @csrf
                    <input hidden type="text" name="id" value="{{ $shift->id }}">
                    <div class="form-group">
                        <label for="shift-name" class="col-form-label">Shift Name:</label>
                        <input type="text" class="form-control @error('shift_name') is-invalid @enderror"
                            id="shift-name" name="shift_name" value="{{ old('shift_name', $shift->shift_name) }}">
                        @error('shift_name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="shift-group" class="col-form-label">Shift Group:</label>
                        <input type="text" class="form-control @error('shift_group') is-invalid @enderror"
                            id="shift-group" name="shift_group" value="{{ old('shift_group', $shift->shift_group) }}">
                        @error('shift_group')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="shift-start" class="col-form-label">Shift Start:</label>
                        <input type="time" class="form-control @error('shift_start') is-invalid @enderror"
                            id="shift-start" name="shift_start" value="{{ old('shift_start', $shift->shift_start) }}">
                        @error('shift_start')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="shift-end" class="col-form-label">Shift End:</label>
                        <input type="time" class="form-control @error('shift_end') is-invalid @enderror"
                            id="shift-end" name="shift_end" value="{{ old('shift_end', $shift->shift_end) }}">
                        @error('shift_end')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-white" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-iot">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="deleteShiftModal-{{ $shift->id }}" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalMessageTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form method="post" action="/delete_shift">
                @method('delete')
                @csrf
                <input type="text" class="form-control" id="shift-id" name="id" value="{{ $shift->id }}"
                    hidden required>
                <input type="text" class="form-control" id="shift-name" name="shift_name"
                    value="{{ $shift->shift_name }}" hidden required>
                <div class="modal-header">
                    <h6 class="modal-title" id="modal-title-notification">Your attention is required</h6>
                    <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body mx-3">
                    <div class="py-3 text-center">
                        <i class="ni ni-bell-55 ni-3x"></i>
                        <h4 class="text-gradient text-danger mt-4">Delete {{ $shift->shift_name }} ?</h4>
                        <p>You will not be able to restore deleted Shift.
                        </p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-white" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-iot">Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>
