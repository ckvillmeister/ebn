<form id="frm">
    <input type="hidden" name="id" value="{{ ($user) ? $user->id : null }}">
    <div class="position-relative row form-group">
        <label for="password" class="col-sm-2 col-form-label">Password</label>
        <div class="col-sm-4">
            <input type="password" class="form-control form-control-sm input-border-bottom" id="password" name="password" required> 
        </div>
    </div>
    <div class="position-relative row form-group">
        <label for="cpassword" class="col-sm-2 col-form-label">Confirm Password</label>
        <div class="col-sm-4">
            <input type="password" class="form-control form-control-sm input-border-bottom" id="cpassword" name="cpassword" required> 
        </div>
    </div>
    <div class="position-relative row form-group">
        <div class="col-sm-12 float-right">
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
        getUsers(1);
    });

    $('#frm').on('submit', function(e){
        e.preventDefault();

        $.ajax({
            headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: 'userResetPass/resetPass',
            method: 'POST',
            data: $('#frm').serialize(),
            dataType: 'JSON',
            success: function(result) {
                swal({
                    title: result['title'],
                    type: result['icon'],
                    text: result['message'],
                    confirmButtonText: "Okay",
                },
                function(isConfirm){
                    if (isConfirm) {
                        getUsers(1);
                    }
                });
            },
            error: function(obj, err, ex){
                swal("Server Error", err + ": " + obj.toString() + " " + ex, "error");
            }
        })
    });
</script>