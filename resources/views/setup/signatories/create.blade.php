<form id="frm">
    <div class="position-relative row form-group">
        <input type="hidden" name="id" value="{{ $signatory->id ?? '' }}">
        <label for="name" class="col-sm-2 col-form-label">Complete Name</label>
        <div class="col-sm-6">
            <input type="text" class="form-control form-control-sm input-border-bottom" id="name" name="name" value="{{ $signatory->name ?? '' }}" required>
        </div>
    </div>
    <div class="position-relative row form-group">
        <label for="name" class="col-sm-2 col-form-label">Position</label>
        <div class="col-sm-6">
            <input type="text" class="form-control form-control-sm input-border-bottom" id="position" name="position" value="{{ $signatory->position ?? '' }}" required>
        </div>
    </div>
    <div class="position-relative row form-group">
        <label for="name" class="col-sm-2 col-form-label">Approving Officer?</label>
        <div class="col-sm-6">
            <div class="col-sm-2">
                <input name="is_approving_officer" type="radio" id="yes" value="1" {{ ($signatory) ? (($signatory->is_approving_officer==1) ? 'checked' : '') : '' }}> 
                <label for="yes" class="ml-2" style="margin-top: -2px; vertical-align: middle;">Yes</label>
                <label class="error" for="yes">{{ $errors->first('is_approving_officer') }}</label>
            </div>
            <div class="col-sm-2">
                <input name="is_approving_officer" type="radio" id="no" value="F" {{ ($signatory) ? (($signatory->is_approving_officer==0) ? 'checked' : '') : '' }}> <label for="no" class="ml-2" style="margin-top: -4px; vertical-align: middle;">No</label>
                <label class="error" for="no">{{ $errors->first('is_approving_officer') }}</label>
            </div>
        </div>
    </div>
    <div class="position-relative row form-group">
        <div class="col-sm-12 float-right mt-1">
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
        getSignatories(1);
    });

    $('#frm').on('submit', function(e){
        e.preventDefault();

        $.ajax({
            headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '/signatory-store',
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
                            getSignatories(1);
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