<form id="frm">
    <div class="position-relative row form-group">
        <input type="hidden" name="id" value="{{ ($role) ? $role->id : null }}">
        <label for="name" class="col-sm-2 col-form-label">Role Name</label>
        <div class="col-sm-10">
            <input type="text" class="form-control form-control-sm input-border-bottom" id="name" name="name" value="{{ ($role) ? $role->name : '' }}" required>
        </div>
        <div class="col-sm-12 mt-5">
            <div class="text-center">
                <h5>Permissions</h5>
            </div><br>
            <div class="demo-checkbox">
                <div class="row clearfix permissions">
                @foreach ($permissions as $permission)
                    @php ($checked = '')
                    @foreach ($role_permissions as $rp)
                        @if ($rp->permission_id == $permission->id)
                            @php ($checked = 'checked')
                            @break
                        @endif
                    @endforeach
                    <div class="col-sm-3">
                        <input type="checkbox" id="{{ $permission->name }}" value="{{ $permission->id }}" {{ $checked }}>
                        <label for="{{ $permission->name }}">{{ $permission->name }}</label>
                    </div>
                @endforeach
                </div>
            </div>
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
        getRoles(1);
    });

    $('#frm').on('submit', function(e){
        var permissions = [];
        var ctr = 0;

        $('.permissions input[type=checkbox]').each(function() {
            if ($(this).is(":checked")) {
                permissions[ctr] = $(this).val();
                ctr++;
            }
        });
        
        e.preventDefault();

        $.ajax({
            headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: 'roleStore',
            method: 'POST',
            data: $('#frm').serialize() + '&permissions=' + permissions,
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
                            getRoles(1);
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