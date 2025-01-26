@extends('index')
@section('content')

<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div class="page-title-icon">
                <i class="pe-7s-users icon-gradient bg-amy-crisp">
                </i>
            </div>
            <div>Client Information Manager
                <div class="page-title-subheading">Manager for different client's information
                </div>
            </div>
        </div>    
    </div>
</div>

<div class="row">
    <div class="col-sm-12">
        <div class="card p-3">
            <div class="body" id="content">

                <div class="btn-group">
                    <a type="button" class="btn btn-primary waves-effect btn-new" href="{{ route('new-client') }}">
                        <i class="fas fa-user-tie"></i>
                        <span>New</span>
                    </a>
                    <a type="button" class="btn btn-info waves-effect btn-active" href="{{ url('/client?status=1') }}">
                        <i class="fas fa-check-square"></i>
                        <span>Active</span>
                    </a>
                    <a type="button" class="btn btn-secondary waves-effect btn-trash" href="{{ url('/client?status=0') }}">
                    <i class="fas fa-trash-alt"></i>
                        <span>Trash</span>
                    </a>
                </div><br><br>

                <div class="row mb-5">
                    <div class="col-sm-9"></div>
                    <div class="col-sm-3">
                        <div class="input-group input-group-md">
                            <span class="input-group-addon">
                            </span>
                            <div class="form-line">
                                <form action="{{ route('client') }}" method="GET">
                                    <input type="text" name="search" class="form-control form-control-sm" placeholder="Search">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                @if (!$entities->isEmpty())
                    <div class="row">
                    @foreach ($entities as $entity)
                        <div class="col-lg-3" style="margin-bottom: -10px">
                            <div class="thumbnail">
                                @if ($entity->sex == "M")
                                    <img src="{{ asset('images/profile-male.jpg') }}" class="col-sm-12">
                                @else
                                    <img src="{{ asset('images/profile-female.jpg') }}" class="col-sm-12">
                                @endif
                                    <div class="caption text-center">
                                        <br>
                                        <h6>{{ ($entity->entityname) ? strtoupper($entity->entityname) : strtoupper($entity->firstname.' '.$entity->lastname) }}</h6>
                                        <p>
                                            <div class="btn-group">
                                                @if ($entity->status)
                                                <a href="{{ route('client-profile') }}?id={{ $entity->id }}" class="btn btn-primary waves-effect" title="View Client" >
                                                    <i class="fas fa-search mr-2"></i>View
                                                </a>
                                                <a href="{{ route('new-client') }}?id={{ $entity->id }}" class="btn btn-info waves-effect" title="Edit Client" >
                                                    <i class="fas fa-edit mr-2"></i>Edit
                                                </a>
                                                <a href="#" class="btn btn-primary waves-effect" title="Delete Client" onclick="deleteClient({{ $entity->id }})">
                                                    <i class="fas fa-trash mr-2"></i>Delete
                                                </a>
                                                @else
                                                <a href="#" class="btn btn-success waves-effect" title="Restore Client" onclick="restoreClient({{ $entity->id }})">
                                                    <i class="fas fa-undo mr-2"></i>Restore
                                                </a>
                                                @endif
                                            </div>
                                        </p>
                                    </div>
                            </div>
                        </div>
                    @endforeach
                    </div>
                    <div class="row">
                        <div class="col-sm-9"></div>
                        <div class="col-sm-3">
                            <div class="pull-right">
                                {{ $entities->onEachSide(2)->links() }}
                            </div>
                        </div>
                    </div>
                @else
                    <div class="row">
                        <div class="col-sm-4"></div>
                        <div class="col-sm-4">
                            <div class="card-body cart zero-results">
                                <div class="col-sm-12 empty-cart-cls text-center">
                                    <img src="{{ asset('images/empty.gif') }}" width="250" height="250" class="img-fluid mb-4 mr-3">
                                    <h3><strong>0 Results</strong></h3>
                                    <h5>We searched far and wide and couldn't find any files matching your search</h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4"></div>
                    </div>
                @endif

            </div>
        </div>
    </div>
</div>

@endsection
@push('scripts')
<script>
    function deleteClient(id){
        Swal.fire({
            title: 'Delete Client?',
            text: "Client's record will be stored to trash.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, remove it!'
        }).then((result) => {
            if (result.isConfirmed) {
                toggleStatus(id, 0);
            }
        });
    }

    function restoreClient(id){
        Swal.fire({
            title: 'Restore Client?',
            text: "This means you will using this client's record again.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, restore it!'
        }).then((result) => {
            if (result.isConfirmed) {
                toggleStatus(id, 1);
            }
        });
    }

    function toggleStatus(id, status){
        $.ajax({
            headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: 'clientToggleStatus',
            method: 'POST',
            data: {'id': id, 'status': status},
            dataType: 'JSON',
            success: function(result) {
                window.location.reload();
            },
            error: function(obj, err, ex){
                swal("Server Error", err + ": " + obj.toString() + " " + ex, "error");
            }
        })
    }
</script>
@endpush