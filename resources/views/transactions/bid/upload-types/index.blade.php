@extends('index')
@section('content')

<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div class="page-title-icon">
                <i class="pe-7s-safe icon-gradient bg-amy-crisp"></i>
            </div>
            <div>Default Upload Types
                <div class="page-title-subheading">
                    Manage required default documents for bidding.
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-12">
        <div class="card p-3">
            <div class="body" id="content">
                <div class="page-title-actions mb-3">
                    <button class="btn btn-primary" id="btnAdd">
                        <i class="fa fa-plus"></i> Add
                    </button>

                    <a href="{{ url('transaction/bids/default-upload-types?status=1') }}"
                    class="btn btn-success {{ $status == 1 ? 'active' : '' }}">
                        Active
                    </a>

                    <a href="{{ url('transaction/bids/default-upload-types?status=0') }}"
                    class="btn btn-secondary {{ $status == 0 ? 'active' : '' }}">
                        Trashed
                    </a>
                </div>
                <table class="table table-bordered table-striped" id="dataTable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
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
                            <td>{{ $row->description }}</td>
                            <td>
                                @if($row->status == 1)
                                    <span class="badge badge-success">Active</span>
                                @else
                                    <span class="badge badge-secondary">Inactive</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ url('transaction/bids/default-upload-types/'.$row->id.'/uploads') }}"
                                class="btn btn-primary btn-sm mb-1">
                                Upload
                                </a>
                                <button class="btn btn-info btn-sm btnEdit  mb-1"
                                    data-id="{{ $row->id }}"
                                    data-name="{{ $row->name }}"
                                    data-description="{{ $row->description }}">
                                    Edit
                                </button>

                                <button class="btn btn-warning btn-sm btnToggle mb-1"
                                    data-id="{{ $row->id }}"
                                    data-status="{{ $row->status }}">
                                    {{ $row->status == 1 ? 'Deactivate' : 'Activate' }}
                                </button>
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
<!-- Modal -->
<div class="modal micromodal-slide modal__container modal-lg card" id="modalForm" aria-hidden="true">
    <div class="modal__overlay" tabindex="-1" data-micromodal-close>
        <div class="modal__container card" role="dialog">

            <header class="modal__header p-3 border-bottom">
                <h5 class="modal__title">Default Upload Type</h5>
                <button class="btn btn-danger btn-sm" data-micromodal-close>&times;</button>
            </header>

            <main class="modal__content p-3">
                <form id="formSubmit">
                    @csrf
                    <input type="hidden" id="id" name="id">

                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" name="name" id="name" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>Description</label>
                        <textarea name="description" id="description" class="form-control"></textarea>
                    </div>
                </form>
            </main>

            <footer class="modal__footer p-3 border-top text-right">
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

    // ADD
    $('#btnAdd').click(function () {
        $('#formSubmit')[0].reset();
        $('#id').val('');
        MicroModal.show('modalForm');
    });

    // EDIT
    $('.btnEdit').click(function () {
        $('#id').val($(this).data('id'));
        $('#name').val($(this).data('name'));
        $('#description').val($(this).data('description'));
        MicroModal.show('modalForm');
    });

    // SAVE BUTTON
    $('#btnSave').click(function () {
        $('#formSubmit').submit();
    });

    // SUBMIT
    $('#formSubmit').submit(function (e) {
        e.preventDefault();

        let id = $('#id').val();
        let url = id
            ? "{{ url('/transaction/bids/default-upload-types/update') }}/" + id
            : "{{ route('default-upload-types.store') }}";

        $.ajax({
            url: url,
            method: "POST",
            data: $(this).serialize(),
            success: function () {
                MicroModal.close('modalForm');
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
                window.location.href = "{{ url('/transaction/bids/default-upload-types/toggle') }}/" + id;
            }
        });
    });

});
</script>
@endpush
