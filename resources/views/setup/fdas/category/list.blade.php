<div class="row">
    <div class="col-sm-12">
        <div class="btn-group">
            <button type="button" class="btn btn-sm btn-primary waves-effect btn-new">
                <i class="fas fa-user-tie"></i>
                <span>New</span>
            </button>
            <button type="button" class="btn btn-sm btn-info waves-effect btn-active">
                <i class="fas fa-check-square"></i>
                <span>Active</span>
            </button>
            <button type="button" class="btn btn-sm btn-secondary waves-effect btn-trash">
                <i class="fas fa-trash-alt"></i>
                <span>Trash</span>
            </button>
        </div>
    </div>
</div>
<div class="table-responsive mt-5">
    <table class="display table table-striped table-hover dataTable" id="table-list">
        <thead>
            <tr>
                <th class="text-center">No</th>
                <th class="text-center">Category Description</th>
                <th class="text-center">Action</th>
            </tr>
        </thead>
        <tbody>
            @php ($ctr = 1)
            @foreach ($categories as $category)
            <tr>
                <td class="text-center">{{ $ctr++ }}</td>
                <td>{{ $category->category }}</td>
                <td class="text-center">
                    @if($category->status)
                    <a type="button" class="btn btn-sm btn-success waves-effect btn-add-devices" title="Add Devices / Appliances" href="{{ route('manage-devices').'?status=1&id='.$category->id }}">
                        <i class="fas fa-tasks"> </i>
                    </a>
                    @endif
                    <button type="button" class="btn btn-sm btn-warning waves-effect btn-edit" title="Edit FDAS Category" value="{{ $category->id }}">
                        <i class="fas fa-edit"></i>
                    </button>
                    @if($category->status)
                    <button type="button" class="btn btn-sm btn-danger waves-effect btn-delete" title="Deactivate FDAS Category" value="{{ $category->id }}">
                        <i class="fas fa-trash-alt"></i>
                    </button>
                    @endif
                    @if(!$category->status)
                    <button type="button" class="btn btn-sm btn-success waves-effect btn-activate"  title="Re-activate FDAS Category" value="{{ $category->id }}">
                        <i class="fas fa-undo-alt"></i>
                    </button>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<script>
    $('#table-list').DataTable();
</script>