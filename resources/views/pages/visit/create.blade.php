@extends('layouts/master')
@section('title', 'Visit Client')
@section('content')
<div class="col-12">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Create Visit Client</h5>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('visit.store') }}">
                @csrf
                <div class="row g-2">
                    <div class="col-md-4">
                        <label for="client_id" class="form-label">Nama Perusahaan</label>

                        <select name="client_id" id="client_id" class="form-select select2" required>
                            <option value="">Open this select</option>
                            @foreach ($cus as $item)
                            <option value="{{ $item->id_klien }}">{{ $item->nama_klien }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="lokasi" class="form-label">Lokasi</label>
                        <textarea name="lokasi" class="form-control" id="" cols="0" rows="0"
                            placeholder="Enter"></textarea>
                    </div>
                    <div class="col-md-4">
                        <label for="date" class="form-label">Tanggal Vsit</label>
                        <input type="date" class="form-control" name="date" placeholder="Enter" required>
                    </div>
                    <div class="col-md-4">
                        <label for="agenda" class="form-label">Agenda Visit</label>
                        <input type="text" class="form-control" name="agenda" placeholder="Enter" required>
                    </div>
                    <div class="col-md-4">
                        <label for="jam" class="form-label">Jam Visit</label>
                        <input type="time" class="form-control" name="jam" placeholder="Enter" required>
                    </div>
                    <div class="col-md-4">
                        <label for="jam_selesai" class="form-label">Jam Selesai</label>
                        <input type="time" class="form-control" name="jam_selesai" placeholder="Enter" required>
                    </div>
                    <div class="col-md-4">
                        <label for="nama_visitor" class="form-label">Nama Visitor</label>
                        {{-- <input type="text" class="form-control" name="nama_visitor" placeholder="Enter" required>
                        --}}
                        <select id="multicol-language" class="select2 form-select select2-primary" name="nama_visitor[]"
                            multiple required>
                            @foreach ($karyawan as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        {{-- <label for="attendance_client" class="form-label">Attendace Client</label>
                        <input type="text" class="form-control" name="attendance_client" placeholder="Enter" required>
                        --}}

                        <label>
                            Attendace Client
                            <a href="javascript:void(0)" class="text-success font-18" title="Add"
                                onclick="addDateInput()"><i class="fa fa-plus"></i></a>
                        </label>
                        <div id="dateInputs">
                            <!-- Initial date input -->
                            <div class="input-group mb-3">
                                <input type="text" name="attendance_client[]" class="form-control" placeholder="Enter"
                                    required>
                                <button type="button"
                                    class="btn-icon btn-outline-danger waves-effect btn-sm button-hide"
                                    onclick="removeDateInput(this)" style="border: none">
                                    <span class="ti ti-trash"></span>
                                </button>
                            </div>
                        </div>
                    </div>


                    <div class="col-md-4">
                        <label for="result" class="form-label">Hasil</label>
                        <input type="text" class="form-control" name="result" placeholder="Enter" required>
                    </div>
                    <div class="col-md-4">
                        <label for="fo_1" class="form-label">Follow Up 1</label>
                        <input type="text" class="form-control" name="fo_1" placeholder="Enter" required>
                    </div>
                    <div class="col-md-4">
                        <label for="fo_2" class="form-label">Follow Up 2</label>
                        <input type="text" class="form-control" name="fo_2" placeholder="Enter">
                    </div>
                    <div class="col-md-4">
                        <label for="fo_3" class="form-label">Follow Up 3</label>
                        <input type="text" class="form-control" name="fo_3" placeholder="Enter">
                    </div>
                </div>
                <div class="mb-3 mt-3">
                    <button type="submit" class="btn btn-primary float-end ms-2">Submit</button>
                    <a href="{{ route('visit.index') }}" class="btn btn-secondary float-end ">Back</a>
            </form>
        </div>
    </div>
</div>

<script>
    function addDateInput() {
    var dateInputs = document.getElementById('dateInputs');

    // Create new date input group
    var newInput = document.createElement('div');
    newInput.classList.add('input-group', 'mb-3');

    // Date input field
    var inputField = document.createElement('input');
    inputField.type = 'text';
    inputField.name = 'attendance_client[]';
    inputField.classList.add('form-control');
    inputField.placeholder = 'Enter';
    inputField.required = true;

    // Delete button
    var deleteButton = document.createElement('button');
    deleteButton.type = 'button';
    deleteButton.classList.add('btn-icon', 'btn-outline-danger', 'waves-effect', 'btn-sm', 'button-hide');
    deleteButton.setAttribute('style', 'border: none');
    deleteButton.setAttribute('onclick', 'removeDateInput(this)');

    var deleteIcon = document.createElement('span');
    deleteIcon.classList.add('ti', 'ti-trash');
    deleteButton.appendChild(deleteIcon);

    // Append input field and delete button to new input group
    newInput.appendChild(inputField);
    newInput.appendChild(deleteButton);

    // Append new input group to container
    dateInputs.appendChild(newInput);
    }

    // JavaScript Function to Remove Date Input
    function removeDateInput(button) {
    button.parentElement.remove();
    }
</script>

@endsection