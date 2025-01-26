@extends('index')
@section('content')

<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div class="page-title-icon">
                <i class="pe-7s-pendrive icon-gradient bg-amy-crisp">
                </i>
            </div>
            <div>Questions List
                <div class="page-title-subheading">Manager for Emergency Exit & Routes / Fire Suppression System Questions
                </div>
            </div>
        </div>    
    </div>
</div>

<div class="row">
    <div class="col-sm-12">
        <div class="card p-3">
            <div class="body" id="content">

                <div class="card-header-tab card-header">
                    <div class="card-header-title">
                        <i class="header-icon lnr-bicycle icon-gradient bg-love-kiss"> </i>
                    </div>
                    <ul class="nav">
                        <li class="nav-item"><a data-toggle="tab" href="#eer" class="nav-link show active"><i class="fas fa-door-open mr-2"></i>Emergency Exits & Routes</a></li>
                        <li class="nav-item"><a data-toggle="tab" href="#fss" class="nav-link show"><i class="fas fa-fire-extinguisher mr-2"></i>Fire Suppression System</a></li>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content">
                        <div class="tab-pane active show" id="eer" role="tabpanel">

                        </div>
                        <div class="tab-pane show" id="fss" role="tabpanel">
                            
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

@endsection
@push('scripts')
<script>
    getQuestions(1, 'eer');
    getQuestions(1, 'fss');

    function newQuestion(ev, el, type){
        questionCreate(0, type);
    }

    function activeQuestions(ev, el, type){
        getQuestions(1, type);
    }

    function inactiveQuestions(ev, el, type){
        getQuestions(0, type);
    }
    
    function editQuestion(ev, el, type){
        var id = $(el).val();
        questionCreate(id, type);
    }

    function deleteQuestion(ev, el, type){
        var id = $(el).val();

        swal.fire({
            title: "Confirm",
            text: "Are you sure you want to delete this question?",
            type: "warning",
            showCancelButton: true,
            confirmButtonText: "Proceed",
            cancelButtonText: "Cancel",
        }).then((result) => {
            if (result.isConfirmed) {
                toggleStatus(id, 0, type);
            }
        });
    }

    function reactivateQuestion(ev, el, type){
        var id = $(el).val();
        toggleStatus(id, 1, type);
    }

    function questionCreate(id, type){
        $.ajax({
            headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '/questions-create',
            method: 'POST',
            data: {'id': id, 'type': type},
            dataType: 'html',
            beforeSend: function() {
                if (type == 'eer'){
                    $('#eer').html('<div class="progress" style="height: 13px;">' +
                                    '<div class="progress-bar progress-bar-success progress-bar-striped active" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 100%">' +
                                    '<span class="sr-only">40% Complete (success)</span>' +
                                    '</div>' +
                                    '</div>');
                }
                else if (type == 'fss'){
                    $('#fss').html('<div class="progress" style="height: 13px;">' +
                                    '<div class="progress-bar progress-bar-success progress-bar-striped active" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 100%">' +
                                    '<span class="sr-only">40% Complete (success)</span>' +
                                    '</div>' +
                                    '</div>');
                }
            },
            complete: function(){
                
            },
            success: function(result) {
                if (type == 'eer'){
                    $('#eer').html(result);
                }
                else if (type == 'fss'){
                    $('#fss').html(result);
                }
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

    function getQuestions(status, type){
        $.ajax({
            headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '/questions-retrieve',
            method: 'POST',
            data: {'type': type, 'status': status},
            dataType: 'html',
            beforeSend: function() {
                if (type == 'eer'){
                    $('#eer').html('<div class="progress" style="height: 13px;">' +
                                    '<div class="progress-bar progress-bar-success progress-bar-striped active" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 100%">' +
                                    '<span class="sr-only">40% Complete (success)</span>' +
                                    '</div>' +
                                    '</div>');
                }
                else if (type == 'fss'){
                    $('#fss').html('<div class="progress" style="height: 13px;">' +
                                    '<div class="progress-bar progress-bar-success progress-bar-striped active" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 100%">' +
                                    '<span class="sr-only">40% Complete (success)</span>' +
                                    '</div>' +
                                    '</div>');
                }
            },
            complete: function(){
                
            },
            success: function(result) {
                if (type == 'eer'){
                    $('#eer').html(result);
                }
                else if (type == 'fss'){
                    $('#fss').html(result);
                }
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

    function toggleStatus(id, status, type){
        $.ajax({
            headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '/questions-toggle-status',
            method: 'POST',
            data: {'id': id, 'status': status, 'type': type},
            dataType: 'JSON',
            success: function(result) {
                swal.fire(result['title'], result['message'], result['icon']);

                if (result['icon'] != 'error'){
                    if (status){
                        getQuestions(0, type);
                    }
                    else{
                        getQuestions(1, type);
                    }
                }
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



