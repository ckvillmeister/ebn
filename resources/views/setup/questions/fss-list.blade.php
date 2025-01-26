<div class="row">
    <div class="col-sm-12">
        <div class="btn-group">
            <button type="button" class="btn btn-sm btn-primary waves-effect btn-new" onclick="newQuestion(event, this, 'fss')">
                <i class="fas fa-user-tie"></i>
                <span>New</span>
            </button>
            <button type="button" class="btn btn-sm btn-info waves-effect btn-active" onclick="activeQuestions(event, this, 'fss')">
                <i class="fas fa-check-square"></i>
                <span>Active</span>
            </button>
            <button type="button" class="btn btn-sm btn-secondary waves-effect btn-trash" onclick="inactiveQuestions(event, this, 'fss')">
                <i class="fas fa-trash-alt"></i>
                <span>Trash</span>
            </button>
        </div>
    </div>
</div>
<div class="table-responsive mt-5">
    <table class="display table table-striped table-hover dataTable" id="table-list-fss">
        <thead>
            <tr>
                <th class="text-center" style="width: 10%">No</th>
                <th class="text-center" style="width: 75%">Question</th>
                <th class="text-center" style="width: 15%">Action</th>
            </tr>
        </thead>
        <tbody>
            @php ($ctr = 1)
            @foreach ($questions as $question)
            <tr>
                <td class="text-center" style="width: 10%">{{ $ctr++ }}</td>
                <td style="width: 75%">{{ $question->description }}</td>
                <td class="text-center" style="width: 15%">
                    <button type="button" class="btn btn-sm btn-warning waves-effect btn-edit" onclick="editQuestion(event, this, 'fss')" title="Edit Question" value="{{ $question->id }}">
                        <i class="fas fa-edit"></i>
                    </button>
                    @if($question->status)
                    <button type="button" class="btn btn-sm btn-danger waves-effect btn-delete" onclick="deleteQuestion(event, this, 'fss')" title="Deactivate Question" value="{{ $question->id }}">
                        <i class="fas fa-trash-alt"></i>
                    </button>
                    @endif
                    @if(!$question->status)
                    <button type="button" class="btn btn-sm btn-success waves-effect btn-activate" onclick="reactivateQuestion(event, this, 'fss')" title="Re-activate Question" value="{{ $question->id }}">
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
    $('#table-list-fss').DataTable();
</script>