<button style="outline: none;box-shadow: none;" class="btn btn-sm btn-icon mb-0 me-2 border-0" data-bs-toggle="modal"
    data-bs-target="#editHmiModal-{{ $hmi->id }}">
    <span class="btn-inner--icon">
        <i class="fa-solid fa-pen-to-square"></i>
    </span>
    {{-- <span class="btn-inner--text">Add Parameter</span> --}}
</button>


<!-- Modal -->
<div class="modal fade" id="editHmiModal-{{ $hmi->id }}" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalMessageTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form method="post" action="/edit_hmi">
                @method('put')
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit HMI
                    </h5>
                    <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    @csrf
                    <input hidden type="text" name="id" value="{{ $hmi->id }}">
                    <input hidden type="text" name="hmi_name" value="{{ $hmi->hmi_name }}">
                    {{-- <div class="form-group">
                        <label for="line-name" class="col-form-label">Line Name:</label>
                        <input type="text" class="form-control @error('line_name') is-invalid @enderror"
                            id="line-name" name="line_name" value="{{ old('line_name', $hmi->line_name) }}">
                        @error('line_name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div> --}}
                    <div class="form-group">
                        <label for="line-id" class="col-form-label">Line Name</label>
                        <select class="form-select" id="line-id" name="line_id">
                            <option value="">
                                Not Assigned
                            </option>
                            @foreach ($lines as $line)
                                <option value="{{ $line->id }}" {{ $hmi->line_id == $line->id ? 'selected' : '' }}>
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
                        <label for="line-name" class="col-form-label">HMI Threshold:</label>
                        <input type="number" step="any" class="form-control @error('hmi_th') is-invalid @enderror"
                            id="line-name" name="hmi_th" value="{{ old('hmi_th', $hmi->hmi_th) }}">
                        @error('hmi_th')
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
