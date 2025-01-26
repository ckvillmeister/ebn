@extends('index')
@section('content')

<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div class="page-title-icon">
                <i class="pe-7s-users icon-gradient bg-amy-crisp">
                </i>
            </div>
            <div>Client Information Entry
                <div class="page-title-subheading">Page for creating / updating client's information
                </div>
            </div>
        </div>    
    </div>
</div>

<div class="row clearfix">
    <div class="col-sm-12">
        <div class="card p-3">
            <div class="body" id="content">

                <form id="frm" method="POST" action="{{ route('store-client') }}">
                    <input type="hidden" name="id" value="{{ ($client) ? $client->id : null }}">
                    <div class="row clearfix">
                        <div class="col-sm-2">
                            <label for="firstname" class="col-form-label">Complete Name</label>
                        </div>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="firstname" name="firstname" placeholder="First Name" value="{{ ($client) ? $client->firstname : '' }}">
                            <label class="error" for="firstname">{{ $errors->first('firstname') }}</label>
                        </div>
                    </div>
                    <div class="row clearfix">
                        <div class="col-sm-2"></div>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="middlename" placeholder="Middle Name" value="{{ ($client) ? $client->middlename : '' }}">
                            <label class="error" for="firstname">{{ $errors->first('middlename') }}</label>
                        </div>
                    </div>
                    <div class="row clearfix">
                        <div class="col-sm-2"></div>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="lastname" placeholder="Last Name" value="{{ ($client) ? $client->lastname : '' }}">
                            <label class="error" for="lastname">{{ $errors->first('lastname') }}</label>
                        </div>
                    </div>
                    <div class="row clearfix">
                        <div class="col-sm-2">
                            <span>Sex:</span>
                        </div>
                        <div class="col-sm-1">
                            <input name="sex" type="radio" id="male" value="M" {{ ($client) ? (($client->sex=='M') ? 'checked' : '') : '' }}> <label for="male">Male</label>
                            <label class="error" for="lastname">{{ $errors->first('sex') }}</label>
                        </div>
                        <div class="col-sm-1">
                            <input name="sex" type="radio" id="female" value="F" {{ ($client) ? (($client->sex=='F') ? 'checked' : '') : '' }}> <label for="female">Female</label>
                            <label class="error" for="lastname">{{ $errors->first('sex') }}</label>
                        </div>
                    </div>
                    <div class="row clearfix">
                        <div class="col-sm-2">
                            <span>Contact:</span>
                        </div>
                        <div class="col-sm-3">
                            <input type="text" class="form-control" name="contact_number" placeholder="Contact Number" value="{{ ($client) ? $client->contact_number : '' }}">
                            <label class="error" for="lastname">{{ $errors->first('contact_number') }}</label>
                        </div>
                        <div class="col-sm-3">
                            <input type="email" class="form-control" name="email" placeholder="E-mail" value="{{ ($client) ? $client->email : '' }}">
                            <label class="error" for="lastname">{{ $errors->first('email') }}</label>
                        </div>
                    </div>
                    <div class="row clearfix">
                        <div class="col-sm-2">
                            <span>Address:</span>
                        </div>
                        <div class="col-sm-6">
                            <select class="form-control show-tick" name="province" id="province">
                                <option value="">Select Province</option>
                                @foreach ($provinces as $province)
                                <option value="{{ $province->code }}" {{ ($client) ? (($province->code == $client->province) ? 'selected' : '') : (($province->code == '0712') ? 'selected' : '') }}>{{ $province->description }}</option>
                                @endforeach
                            </select>
                            <label class="error" for="province"></label>
                        </div>
                    </div>
                    <div class="row clearfix">
                        <div class="col-sm-2">
                            <span></span>
                        </div>
                        <div class="col-sm-6">
                            <select class="form-control show-tick" name="municipality" id="municipality">
                                <option value="">Select Municipality</option>
                                @foreach ($towns as $town)
                                <option value="{{ $town->code }}" {{ ($client) ? (($town->code == $client->municipality) ? 'selected' : '') : (($town->code == '071244') ? 'selected' : '') }}>{{ $town->description }}</option>
                                @endforeach
                            </select>
                            <label class="error" for="municipality"></label>
                        </div>  
                    </div>
                    <div class="row clearfix">
                        <div class="col-sm-2">
                            <span></span>
                        </div>
                        <div class="col-sm-6">
                            <select class="form-control show-tick" name="barangay" id="barangay">
                                <option value="">Select Barangay</option>
                                @foreach ($brgys as $brgy)
                                <option value="{{ $brgy->code }}" {{ ($client) ? (($brgy->code == $client->barangay) ? 'selected' : '') : '' }}>{{ strtoupper($brgy->description) }}</option>
                                @endforeach
                            </select>
                            <label class="error" for="barangay"></label>
                        </div>
                    </div>
                    <div class="row clearfix">
                        <div class="col-sm-2">
                            <span></span>
                        </div>
                        <div class="col-sm-6">
                            <input list="puroks" class="form-control show-tick" name="purok" id="purok" placeholder="Search Purok / Type Sitio" value="{{ ($client) ? $client->purok : '' }}">
                                <datalist id="puroks">
                                    <option value="PUROK 1">
                                    <option value="PUROK 2">
                                    <option value="PUROK 3">
                                    <option value="PUROK 4">
                                    <option value="PUROK 5">
                                    <option value="PUROK 6">
                                    <option value="PUROK 7">
                                </datalist>
                            <label class="error" for="purok"></label>
                        </div>
                    </div>
                    <div class="row clearfix">
                        <div class="col-sm-12 float-right">
                            <div class="btn-group">
                                <button type="submit" class="btn btn-primary waves-effect btn-save">
                                    <i class="fas fa-save mr-2"></i>
                                    <span>Save</span>
                                </button>
                                <a href="{{ route('client') }}" class="btn btn-secondary waves-effect btn-back">
                                    <i class="fas fa-undo mr-2"></i>
                                    <span>Back</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="footer">
                
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // $('#province').select2()
    // $('#municipality').select2()
    // $('#barangay').select2();

    $('select[name="province"]').on('change', function() {
        var code = $(this).val();

        $.ajax({
            headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '/address/towns/'+code,
            method: 'POST',
            dataType: 'JSON',
            success: function(result) {
                $('#municipality').html('');
                $('#municipality').append('<option value="">Select Municipality</option>');
                $.each(result, function (key, value) {
                    $('#municipality').append('<option value="'+value['code']+'">'+value['description']+'</option>');
                });
            }
        })
    });

    $('select[name="municipality"]').on('change', function() {
        var code = $(this).val();

        $.ajax({
            headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '/address/barangays/'+code,
            method: 'POST',
            dataType: 'JSON',
            success: function(result) {
                $('#barangay').html('');
                $('#barangay').append('<option value="">Select Barangay</option>');
                $.each(result, function (key, value) {
                    $('#barangay').append('<option>'+value['description'].toUpperCase()+'</option>');
                });
            }
        })
    });

    $('#frm').on('submit', function(e){
        e.preventDefault();

        $.ajax({
            headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '{{ route("store-client") }}',
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
                            window.location.href = "{{ route('client') }}";
                        }
                    }
                });
            },
            error: function(obj, err, ex){
                swal("Server Error", err + ": " + obj.toString() + " " + ex, "error");
            }
        })
    });
</script>
@endpush