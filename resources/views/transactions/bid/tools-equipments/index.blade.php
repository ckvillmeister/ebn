@extends('index')

@section('content')

<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div class="page-title-icon">
                <i class="pe-7s-tools icon-gradient bg-amy-crisp"></i>
            </div>
            <div>Tools & Equipments
                <div class="page-title-subheading">
                    Manage tools and equipment list.
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card p-3">
    <div class="page-title-actions mb-3">
        <button class="btn btn-primary" id="btnAdd">Add</button>

        <a href="{{ url('transaction/bids/tools-equipments?status=1') }}"
        class="btn btn-success {{ $status == 1 ? 'active' : '' }}">
            Active
        </a>

        <a href="{{ url('transaction/bids/tools-equipments?status=0') }}"
        class="btn btn-secondary {{ $status == 0 ? 'active' : '' }}">
            Trashed
        </a>
    </div>
    <table class="table table-bordered" id="dataTable">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Type</th>
                <th>Description</th>
                <th>Status</th>
                <th width="150">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $key => $row)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $row->name }}</td>
                <td>{{ $row->type }}</td>
                <td>{{ $row->description }}</td>
                <td>
                    <span class="badge badge-{{ $row->status ? 'success' : 'secondary' }}">
                        {{ $row->status ? 'Active' : 'Inactive' }}
                    </span>
                </td>
                <td>
                    <button class="btn btn-info btn-sm btnEdit"
                        data-id="{{ $row->id }}"
                        data-name="{{ $row->name }}"
                        data-description="{{ $row->description }}"
                        data-type="{{ $row->type }}">
                        Edit
                    </button>

                    @if($status == 1)
                        <button class="btn btn-warning btn-sm btnToggle" data-id="{{ $row->id }}" data-status="1">
                            Deactivate
                        </button>
                    @else
                        <button class="btn btn-success btn-sm btnToggle" data-id="{{ $row->id }}" data-status="0">
                            Activate
                        </button>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection
@push('modal')
<div class="modal micromodal-slide" id="modalForm">
    <div class="modal__overlay" data-micromodal-close>
        <div class="modal__container modal-md card">

            <div class="p-3 border-bottom d-flex justify-content-between">
                <h5>Tool / Equipment</h5>
                <button class="btn btn-danger btn-sm" data-micromodal-close>&times;</button>
            </div>

            <div class="p-3">
                <form id="formSubmit">
                    @csrf
                    <input type="hidden" id="id">

                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" id="name" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>Type</label>
                        <select id="type" class="form-control">
                            <option value="Tool">Tool</option>
                            <option value="Equipment">Equipment</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Description</label>
                        <textarea id="description" class="form-control"></textarea>
                    </div>
                </form>
            </div>

            <div class="p-3 border-top text-right">
                <button class="btn btn-primary" id="btnSave">Save</button>
                <button class="btn btn-secondary" data-micromodal-close>Close</button>
            </div>

        </div>
    </div>
</div>
@endpush
@push('scripts')
<script>
$(document).ready(function () {

    MicroModal.init();
    $('#dataTable').DataTable();

    $('#btnAdd').click(function () {
        $('#formSubmit')[0].reset();
        $('#id').val('');
        MicroModal.show('modalForm');
    });

    $('.btnEdit').click(function () {
        $('#id').val($(this).data('id'));
        $('#name').val($(this).data('name'));
        $('#description').val($(this).data('description'));
        $('#type').val($(this).data('type'));
        MicroModal.show('modalForm');
    });

    $('#btnSave').click(function () {
        $('#formSubmit').submit();
    });

    $('#formSubmit').submit(function (e) {
        e.preventDefault();

        let id = $('#id').val();
        let url = id
            ? "{{ url('transaction/bids/tools-equipments/update') }}/" + id
            : "{{ route('equipment.store') }}";

        $.ajax({
            url: url,
            method: "POST",
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                name: $('#name').val(),
                description: $('#description').val(),
                type: $('#type').val()
            },
            success: function () {
                location.reload();
            }
        });
    });

    $('.btnToggle').click(function () {
        let id = $(this).data('id');
        let status = $(this).data('status');

        Swal.fire({
            title: 'Are you sure?',
            text: status == 1 ? 'Deactivate?' : 'Activate?',
            icon: 'warning',
            showCancelButton: true
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "/transaction/bids/tools-equipments/toggle/" + id;
            }
        });
    });

});
</script>
@endpush
