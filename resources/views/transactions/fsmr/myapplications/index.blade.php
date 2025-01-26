@extends('index')
@section('content')

<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div class="page-title-icon">
                <i class="pe-7s-safe icon-gradient bg-amy-crisp">
                </i>
            </div>
            <div>My FSMR Applications
                <div class="page-title-subheading">Displays your applied Fire Safety Maintenance Reports
                </div>
            </div>
        </div>    
    </div>
</div>

<div class="row">
    <div class="col-sm-12">
        <div class="card p-3">
            <div class="body" id="content">

            </div>
        </div>
    </div>
</div>

@endsection
@push('scripts')
<script>
    getMyFSMRS(1);

    function getMyFSMRS(status){
        $.ajax({
            headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: 'myFSMRRetrieve',
            method: 'POST',
            data: {'status': status, 'retrieve': 1},
            dataType: 'html',
            beforeSend: function() {
                $('#content').html('<div class="progress" style="height: 13px;">' +
                                    '<div class="progress-bar progress-bar-success progress-bar-striped active" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 100%">' +
                                    '<span class="sr-only">40% Complete (success)</span>' +
                                    '</div>' +
                                    '</div>');
            },
            complete: function(){
                
            },
            success: function(result) {
                $('#content').html(result);
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
    }
</script>
@endpush