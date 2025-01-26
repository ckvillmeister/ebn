<div class="row">
    <div class="col-sm-6">
        <div class="btn-group">
            <button type="button" class="btn btn-sm btn-primary waves-effect btn-new">
                <i class="fas fa-user-tie"></i>
                <span>New</span>
            </button>
        </div>
    </div>
    <div class="col-sm-6 d-flex justify-content-end">
        <a type="submit" href="{{ route('content') }}" class="btn btn-sm btn-secondary text-white"><i class="fas fa-undo mr-2"></i>Back</a>
    </div>
</div>
<div class="table-responsive mt-5">
    <table class="display table table-striped table-hover dataTable" id="table-list">
        <thead>
            <tr>
                <th class="text-center">No</th>
                <th class="text-center">Sub Content Description</th>
                <th class="text-center">Action</th>
            </tr>
        </thead>
        <tbody>
            @php ($ctr = 1)
            @if (count($content->subcontents()->get()) >= 1)
                @foreach ($content->subcontents as $cont)
                
                <tr>
                    <td class="text-center">{{ $ctr++ }}</td>
                    <td>{{ $cont->attachment_type()->first()->description }}</td>
                    <td class="text-center">
                        <button type="button" class="btn btn-sm btn-danger waves-effect btn-delete" title="Deactivate FSMR Sub Content" value="{{ $cont->attachment_type_id }}">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </td>
                </tr>
                @endforeach
            @endif
        </tbody>
    </table>
</div>

<script>
    $('#table-list').DataTable();
</script>