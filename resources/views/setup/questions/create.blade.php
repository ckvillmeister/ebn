<form id="frm">
    <div class="position-relative row form-group">
        <input type="hidden" name="question-id" value="{{ $question->id ?? '' }}">
        <input type="hidden" name="type" value="{{ $type ?? '' }}">
        <label for="name" class="col-sm-1 col-form-label">Question:</label>
        <div class="col-sm-11">
            <input type="text" class="form-control form-control-sm input-border-bottom" id="description" name="description" value="{{ $question->description ?? '' }}" required>
        </div>
        <div class="col-sm-12 float-right mt-3">
            <div class="btn-group">
                <button type="submit" class="btn btn-sm btn-primary waves-effect btn-save">
                    <i class="fas fa-save mr-2"></i>
                    <span>Save</span>
                </button>
                <button type="button" class="btn btn-sm btn-secondary waves-effect btn-back">
                    <i class="fas fa-undo mr-2"></i>
                    <span>Back</span>
                </button>
            </div>
        </div>
    </div>
</form>

<script>
    $('.btn-back').on('click', function(){
        getQuestions(1, "{{ $type ?? '' }}");
    });

    $('#frm').on('submit', function(e){
        e.preventDefault();

        $.ajax({
            headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '/questions-store',
            method: 'POST',
            data: $('#frm').serialize(),
            dataType: 'JSON',
            success: function(result) {
                swal.fire({
                    title: result['title'],
                    type: result['icon'],
                    text: result['message'],
                    confirmButtonText: "Okay",
                }).then((res) => {
                    if (res.isConfirmed) {
                        if (result['icon'] == 'success'){
                            getQuestions(1, "{{ $type ?? '' }}");
                        }
                    }
                });
            },
            error: function(obj, err, ex){
                Swal.fire({
                    title: 'Server Error',
                    text: err + ": " + obj.toString() + " " + ex,
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            }
        })
    });
</script>