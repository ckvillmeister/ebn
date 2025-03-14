@extends('index')
@section('content')
<style>
    .eer-tbl input[type="radio"], #table-fss-list input[type="radio"], #table-assessment-list input[type="radio"] { 
        width: 20px; height: 20px;
    }
</style>
<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div class="page-title-icon">
                <i class="pe-7s-safe icon-gradient bg-amy-crisp">
                </i>
            </div>
            <div>Product Information Overview
                <div class="page-title-subheading">Product information overview.
                </div>
            </div>
        </div>    
    </div>
</div>

<div class="row">
    <div class="col-sm-12">
        <div class="card p-3">
            <div class="body" id="content">

                <div class="row">
                   <div class="col-sm-9">
                        <h3>{{ ($product) ? $product->code.'-'.$product->name : '' }}</h3>
                        <h6 class="text-primary"><i class="fas fa-map-marker mr-2"></i>{{ ($product) ? $product->description : '' }}</h6>
                        <div class="divider"></div>
                        <p class="text-secondary">OTHER INFORMATION</p>
                        <h6 class="text-secondary"><i class="fas fa-copyright mr-2"></i><em>Brand:</em> <b>{{ ($product) ? $product->brand : '' }}</b></h6>
                        <h6 class="text-secondary"><i class="fas fa-weight mr-2"></i><em>Unit of Measurement:</em> <b>{{ ($product) ? $product->uom : '' }}</b></h6>
                        <h6 class="text-secondary"><i class="fas fa-tags mr-2"></i><em>Price:</em> <b>{{ ($product) ? $product->price : '' }}</b></h6>
                        <h6 class="text-secondary"><i class="fas fa-boxes mr-2"></i><em>Stocks:</em> <b>{{ ($product) ? $product->stocks : '' }}</b></h6>
                    </div>
                    <div class="col-sm-3 justify-content-end text-right">
                        <div class="btn-group">
                            <a href="{{ route('transaction-product-update') }}?id={{ $product->id }}" class="btn btn-warning waves-effect btn-save">
                                <i class="fas fa-edit mr-2"></i>
                                <span>Edit</span>
                            </a>
                            <a href="{{ route('transaction-inventory') }}" class="btn btn-secondary waves-effect btn-back">
                                <i class="fas fa-undo mr-2"></i>
                                <span>Return</span>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="divider"></div>

                <p class="text-secondary">INVENTORY LOGS</p>
                <div class="row">
                    <div class="col-sm-12">
                        <table class="table table-sm table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th class="text-center">No</th>
                                    <th class="text-center">Action</th>
                                    <th class="text-center">Quantity</th>
                                    <th class="text-center">Processed By</th>
                                    <th class="text-center">Date Processed</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                @if (!blank($product))
                                    @php ($ctr = 1)
                                    @foreach($product->inventory_logs as $log)
                                    <tr>
                                        <td class="text-center">{{ $ctr++ }}</td>
                                        <td class="text-center">{{ $log->action }}</td>
                                        <td class="text-center">{{ $log->quantity }}</td>
                                        <td class="text-center"><label class="badge badge-primary">{{ $log->getRelation('processed_by')->firstname.' '.$log->getRelation('processed_by')->lastname }}</label></td>
                                        <td class="text-center">{{ date( "F d, Y", strtotime($log->date_processed)) }}</td>
                                    </tr>
                                    @endforeach
                                @endif
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>



@endsection

@push('scripts')
<script>
    
</script>
@endpush