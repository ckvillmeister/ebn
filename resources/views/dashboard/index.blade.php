@extends('index')
@section('content')

<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div class="page-title-icon">
                <i class="metismenu-icon pe-7s-graph2">
                </i>
            </div>
            <div>Dashboard
                <div class="page-title-subheading">Data summary and statistics
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
</script>
@endpush