<form id="frm">
    <div class="position-relative row form-group">
        <input type="hidden" name="id" value="{{ ($user) ? $user->id : null }}">
        <label for="firstname" class="col-sm-2 col-form-label">First Name</label>
        <div class="col-sm-4">
            <input type="text" class="form-control form-control-sm input-border-bottom" id="firstname" name="firstname" value="{{ ($user) ? $user->firstname : '' }}" required>
        </div>
    </div>
    <div class="position-relative row form-group">
        <label for="middlename" class="col-sm-2 col-form-label">Middle Name</label>
        <div class="col-sm-4">
            <input type="text" class="form-control form-control-sm input-border-bottom" id="middlename" name="middlename" value="{{ ($user) ? $user->middlename : '' }}">
        </div>
    </div>
    <div class="position-relative row form-group">
        <label for="lastname" class="col-sm-2 col-form-label">Last Name</label>
        <div class="col-sm-4">
            <input type="text" class="form-control form-control-sm input-border-bottom" id="lastname" name="lastname" value="{{ ($user) ? $user->lastname : '' }}" required>
        </div>
    </div>
    <div class="position-relative row form-group">
        <label for="username" class="col-sm-2 col-form-label">Username</label>
        <div class="col-sm-4">
            <input type="text" class="form-control form-control-sm input-border-bottom" id="username" name="username" value="{{ ($user) ? $user->username : '' }}" required {{ ($user) ? 'disabled' : '' }}> 
        </div>
    </div>
        @if (!$user)
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
        @endif
        <div class="position-relative row form-group">
            <label for="" class="col-sm-2 col-form-label">User Role</label>
            <div class="col-sm-4">
                <select class="form-control form-control-sm show-tick" name="role" required>
                    <option value="">-- Please select a role --</option>
                    @foreach($roles as $role)
                        <option value="{{ $role->id }}" {{ ($user) ? (($role->id == $user->role) ? 'selected' : '') : '' }}>{{ $role->name }}</option>
                    @endforeach
                </select>
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
            url: 'userStore',
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
                            getUsers(1);
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