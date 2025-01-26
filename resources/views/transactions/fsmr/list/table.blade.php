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
                <th class="text-center">Name of Establishment</th>
                <th class="text-center">Client</th>
                <th class="text-center">Applied By</th>
                <th class="text-center">Controls</th>
            </tr>
        </thead>
        <tbody>
            @php ($ctr = 1)
            @foreach ($fsmrs as $fsmr)
            <tr>
                <td class="text-center">{{ $ctr++ }}</td>
                <td class="text-center">{{ $fsmr->establishment_name }}</td>
                <td class="text-center">{{ $fsmr->client()->first()->firstname.' '.$fsmr->client()->first()->lastname }}</td>
                <td class="text-center"><label class="badge badge-primary">{{ $fsmr->processor()->first()->firstname.' '.$fsmr->processor()->first()->lastname }}</label></td>
                <td class="text-center">
                    <a type="button" class="btn btn-sm btn-info waves-effect" title="View FSMR" href="{{ route('transaction-fsmr-view').'?id='.$fsmr->id }}">
                        <i class="fas fa-eye mr-2"></i>View
                    </a>
                    <a type="button" class="btn btn-sm btn-warning waves-effect btn-edit" title="Edit FSMR" href="{{ route('transaction-fsmr-application').'?id='.$fsmr->id }}">
                        <i class="fas fa-edit mr-2"></i>Edit
</a>
                    @if($fsmr->status)
                    <button type="button" class="btn btn-sm btn-danger waves-effect btn-delete" title="Deactivate FSMR" value="{{ $fsmr->id }}">
                        <i class="fas fa-trash-alt mr-2"></i>Delete
                    </button>
                    @else
                    <button type="button" class="btn btn-sm btn-success waves-effect btn-activate"  title="Re-activate FSMR" value="{{ $fsmr->id }}">
                        <i class="fas fa-undo-alt mr-2"></i>Re-activate
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