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
                <th class="text-center">FSMR Content</th>
                <th class="text-center">Action</th>
            </tr>
        </thead>
        <tbody>
            @php ($ctr = 1)
            @foreach ($contents as $content)
            <tr>
                <td class="text-center">{{ $ctr++ }}</td>
                <td>{{ $content->description }}</td>
                <td class="text-center">
                    @if($content->status)
                    <a type="button" class="btn btn-sm btn-success waves-effect" title="Add Sub Contents" href="{{ route('manage-sub-contents').'?id='.$content->id }}">
                        <i class="fas fa-tasks"> </i>
                    </a>
                    <button type="button" class="btn btn-sm btn-warning waves-effect btn-edit" title="Edit FSMR Content" value="{{ $content->id }}">
                        <i class="fas fa-edit"></i>
                    </button>
                    <button type="button" class="btn btn-sm btn-danger waves-effect btn-delete" title="Deactivate FSMR Content" value="{{ $content->id }}">
                        <i class="fas fa-trash-alt"></i>
                    </button>
                    @endif
                    @if(!$content->status)
                    <button type="button" class="btn btn-sm btn-success waves-effect btn-activate"  title="Re-activate FSMR Content" value="{{ $content->id }}">
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