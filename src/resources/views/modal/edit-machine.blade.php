<button style="outline: none;box-shadow: none;" class="btn btn-sm btn-icon mb-0 me-2 border-0" data-bs-toggle="modal"
    data-bs-target="#editMachineModal-{{ $machine->id }}">
    <span class="btn-inner--icon">
        <i class="fa-solid fa-pen-to-square"></i>
    </span>
    {{-- <span class="btn-inner--text">Add Parameter</span> --}}
</button>
<button style="outline: none;box-shadow: none;" class="btn btn-sm btn-icon mb-0 me-2 border-0" data-bs-toggle="modal"
    data-bs-target="#deleteMachineModal-{{ $machine->id }}">
    <span class="btn-inner--icon">
        <i class="fa-solid fa-trash"></i>
    </span>
</button>

<!-- Modal -->
<div class="modal fade" id="editMachineModal-{{ $machine->id }}" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalMessageTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form method="post" action="/edit_machine">
                @method('put')
                @csrf
                <input type="text" class="form-control" id="machine-id" name="id" value="{{ $machine->id }}"
                    hidden required>
                <input type="text" class="form-control" id="machine-name" name="machine_name"
                    value="{{ $machine->machine_name }}" hidden required>
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit {{ $machine->machine_name }}
                    </h5>
                    <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
                    @csrf
                    <div class="form-group">
                        <label for="machine-name" class="col-form-label">Machine Name:</label>
                        <input type="text" step="any"
                            class="form-control @error('machine_name') is-invalid @enderror" id="machine-name"
                            name="machine_name" value="{{ old('machine_name', $machine->machine_name) }}">
                        @error('machine_name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="line-name" class="col-form-label">Line Name</label>
                        <select class="form-select" id="line-name" name="line_id">
                            <option value="" {{ $machine->line_id == null ? 'selected' : '' }}>
                                Not Assigned
                            </option>
                            @foreach ($lines as $line)
                                <option value="{{ $line->id }}"
                                    {{ $machine->line_id == $line->id ? 'selected' : '' }}>
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
                    <button type="button" class="btn btn-white" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-iot">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="deleteMachineModal-{{ $machine->id }}" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalMessageTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form method="post" action="/delete_machine">
                @method('delete')
                @csrf
                <input type="text" class="form-control" id="machine-id" name="id" value="{{ $machine->id }}"
                    hidden required>
                <input type="text" class="form-control" id="machine-name" name="machine_name"
                    value="{{ $machine->machine_name }}" hidden required>
                <div class="modal-header">
                    <h6 class="modal-title" id="modal-title-notification">Your attention is required</h6>
                    <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body mx-3">
                    <div class="py-3 text-center">
                        <i class="ni ni-bell-55 ni-3x"></i>
                        <h4 class="text-gradient text-danger mt-4">Delete {{ $machine->machine_name }} ?</h4>
                        <p>You will not be able to restore deleted Machine.
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
