<button style="outline: none;box-shadow: none;" class="btn btn-sm btn-icon mb-0 me-2 border-0" data-bs-toggle="modal"
    data-bs-target="#editPICModal-{{ $pic->id }}">
    <span class="btn-inner--icon">
        <i class="fa-solid fa-pen-to-square"></i>
    </span>
    {{-- <span class="btn-inner--text">Add Parameter</span> --}}
</button>

<button style="outline: none;box-shadow: none;" class="btn btn-sm btn-icon mb-0 me-2 border-0" data-bs-toggle="modal"
    data-bs-target="#deletePICModal-{{ $pic->id }}">
    <span class="btn-inner--icon">
        <i class="fa-solid fa-trash"></i>
    </span>
</button>

<!-- Modal -->
<div class="modal fade" id="editPICModal-{{ $pic->id }}" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalMessageTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form method="post" action="/edit_pic">
                @method('put')
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit PIC
                    </h5>
                    <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    @csrf
                    <input hidden type="text" name="id" value="{{ $pic->id }}">
                    <div class="form-group">
                        <label for="pic-name" class="col-form-label">PIC Name:</label>
                        <input type="text" class="form-control @error('pic_name') is-invalid @enderror"
                            id="pic-name" name="pic_name" value="{{ old('pic_name', $pic->pic_name) }}">
                        @error('pic_name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="nik" class="col-form-label">NIK:</label>
                        <input type="number" class="form-control @error('nik') is-invalid @enderror" id="nik"
                            name="nik" value="{{ old('nik', $pic->nik) }}">
                        @error('nik')
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
<div class="modal fade" id="deletePICModal-{{ $pic->id }}" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalMessageTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form method="post" action="/delete_pic">
                @method('delete')
                @csrf
                <input type="text" class="form-control" id="pic-id" name="id" value="{{ $pic->id }}"
                    hidden required>
                <input type="text" class="form-control" id="pic-name" name="pic_name" value="{{ $pic->pic_name }}"
                    hidden required>
                <div class="modal-header">
                    <h6 class="modal-title" id="modal-title-notification">Your attention is required</h6>
                    <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body mx-3">
                    <div class="py-3 text-center">
                        <i class="ni ni-bell-55 ni-3x"></i>
                        <h4 class="text-gradient text-danger mt-4">Delete {{ $pic->pic_name }} ?</h4>
                        <p>You will not be able to restore deleted PIC.
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
