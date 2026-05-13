@extends('index')

@section('content')

<div class="app-page-title">
    <div class="page-title-heading">
        <div class="page-title-icon">
            <i class="pe-7s-folder icon-gradient bg-amy-crisp"></i>
        </div>
        <div>
            Projects
            <div class="page-title-subheading">
                Manage government and private projects
            </div>
        </div>
    </div>
</div>

<div class="card p-3">
    <div class="page-title-actions mb-3">
        <a href="{{ route('projects.create') }}" class="btn btn-primary">
            Add Project
        </a>
        <button class="btn btn-success btn-sm" id="btnActive">Active</button>
        <button class="btn btn-danger btn-sm" id="btnTrash">Trash</button>
    </div>
    <table class="table table-bordered" id="projectsTable">
        <thead>
            <tr>
                <th>Project Name</th>
                <th>Reference No</th>
                <th>Agency</th>
                <th>Cost</th>
                <th>Status</th> <!-- ADD -->
                <th width="150">Actions</th> <!-- ADD -->
            </tr>
        </thead>
    </table>
</div>

@endsection

@push('scripts')
<script>
$(document).ready(function () {

    let statusFilter = 'active';

    let table = $('#projectsTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: "{{ route('projects.index') }}",
            data: function (d) {
                d.status = statusFilter;
            }
        },
        columns: [
            { data: 'project_name' },
            { data: 'project_reference_no' },
            { data: 'agency_name' },
            { data: 'project_cost' },
            { data: 'status' },
            { data: 'action' }
        ]
    });

    $('#btnActive').click(function () {
        statusFilter = 'active';
        table.ajax.reload();
    });

    $('#btnTrash').click(function () {
        statusFilter = 'trash';
        table.ajax.reload();
    });

    // TRASH
$(document).on('click', '.trashBtn', function () {
    let id = $(this).data('id');

    Swal.fire({
        title: 'Move to Trash?',
        icon: 'warning',
        showCancelButton: true
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: `/transaction/bids/projects/trash/${id}`,
                type: 'DELETE',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                success: function () {
                    table.ajax.reload();
                }
            });
        }
    });
});

// RESTORE
$(document).on('click', '.restoreBtn', function () {
    let id = $(this).data('id');

    Swal.fire({
        title: 'Restore Project?',
        icon: 'question',
        showCancelButton: true
    }).then((result) => {
        if (result.isConfirmed) {
            $.post(`/transaction/bids/projects/restore/${id}`, {
                _token: $('meta[name="csrf-token"]').attr('content')
            }, function () {
                table.ajax.reload();
            });
        }
    });
});

});
</script>
@endpush
