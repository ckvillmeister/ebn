@extends('index')

@section('content')

<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div class="page-title-icon">
                <i class="pe-7s-users icon-gradient bg-amy-crisp"></i>
            </div>
            <div>Man-Power Types
                <div class="page-title-subheading">
                    Manage types of man-power
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-12">
        <div class="card p-3">
            <div class="body">
                <div class="page-title-actions mb-3">

                    <button class="btn btn-primary" id="btnAdd">
                        <i class="fa fa-plus"></i> Add
                    </button>

                    <a href="{{ url('transaction/bids/man-power-types?status=1') }}"
                    class="btn btn-success {{ $status == 1 ? 'active' : '' }}">
                        Active
                    </a>

                    <a href="{{ url('transaction/bids/man-power-types?status=0') }}"
                    class="btn btn-secondary {{ $status == 0 ? 'active' : '' }}">
                        Trashed
                    </a>

                </div>
                <table class="table table-bordered table-striped" id="dataTable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Status</th>
                            <th width="150">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $key => $row)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $row->name }}</td>
                            <td>
                                @if($row->status == 1)
                                    <span class="badge badge-success">Active</span>
                                @else
                                    <span class="badge badge-secondary">Inactive</span>
                                @endif
                            </td>
                            <td>
                                <button class="btn btn-info btn-sm btnEdit"
                                    data-id="{{ $row->id }}"
                                    data-name="{{ $row->name }}">
                                    Edit
                                </button>

                                @if($status == 1)
                                    <button class="btn btn-warning btn-sm btnToggle"
                                        data-id="{{ $row->id }}"
                                        data-status="1">
                                        Deactivate
                                    </button>
                                @else
                                    <button class="btn btn-success btn-sm btnToggle"
                                        data-id="{{ $row->id }}"
                                        data-status="0">
                                        Activate
                                    </button>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>

@endsection
@push('modal')
<div class="modal micromodal-slide" id="modalForm">
    <div class="modal__overlay" tabindex="-1" data-micromodal-close>
        <div class="modal__container modal-md card">

            <header class="p-3 border-bottom d-flex justify-content-between">
                <h5>Man Power Type</h5>
                <button class="btn btn-danger btn-sm" data-micromodal-close>&times;</button>
            </header>

            <main class="p-3">
                <form id="formSubmit">
                    @csrf
                    <input type="hidden" id="id">

                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" id="name" name="name" class="form-control" required>
                    </div>
                </form>
            </main>

            <footer class="p-3 border-top text-right">
                <button class="btn btn-primary" id="btnSave">Save</button>
                <button class="btn btn-secondary" data-micromodal-close>Close</button>
            </footer>

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
        MicroModal.show('modalForm');
    });

    $('#btnSave').click(function () {
        $('#formSubmit').submit();
    });

    $('#formSubmit').submit(function (e) {
        e.preventDefault();

        let id = $('#id').val();
        let url = id
            ? "{{ url('transaction/bids/man-power-types/update') }}/" + id
            : "{{ route('manpower.store') }}";

        $.ajax({
            url: url,
            method: "POST",
            data: $(this).serialize(),
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
            text: status == 1 ? 'Deactivate this record?' : 'Activate this record?',
            icon: 'warning',
            showCancelButton: true
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "/transaction/bids/man-power-types/toggle/" + id;
            }
        });
    });

});
</script>
@endpush
