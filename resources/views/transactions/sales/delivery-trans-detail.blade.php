<div class="row">
    <div class="col-sm-4">
        <h6 class="text-secondary"><i class="fas fa-copyright mr-2"></i><em>Delivery Transaction Code:</em></h6>
    </div>
    <div class="col-sm-5">
        <b>{{ $transaction->code ?? '' }}</b>
    </div>
</div>
<div class="row">
    <div class="col-sm-4">
        <h6 class="text-secondary"><i class="fas fa-calendar-alt mr-2"></i><em>Date of Delivery:</em></h6>
    </div>
    <div class="col-sm-5">
        <b>{{ date('F d, Y', strtotime($transaction->delivery_date)) ?? '' }}</b>
    </div>
</div>
<div class="row">
    <div class="col-sm-4">
        <h6 class="text-secondary"><i class="fas fa-user-tie mr-2"></i><em>Processed By:</em></h6>
    </div>
    <div class="col-sm-5">
        <b>{{ $transaction->fullname ?? '' }}</b>
    </div>
</div>
<div class="row mt-4">
    <div class="col-sm-12">
        &nbsp;<label><b><em>List of Products Delivered</em></b></label>
        <table class="table table-sm table-bordered table-hovered" id="table-list" style="width: 100%">
            <thead>
                <tr>
                    <th class="text-center">No</th>
                    <th class="text-center">Product Name</th>
                    <th class="text-center">Description</th>
                    <th class="text-center">Location</th>
                    <th class="text-center">Quantity</th>
                </tr>
            </thead>
            <tbody>
            @if (!blank($transaction->products))
                @php ($ctr = 1)
                @foreach ($transaction->products as $product)
                <tr>
                    <td class="text-center">{{ $ctr++ }}</td>
                    <td class="">{{ $product->productInfo->name ?? '' }}</td>
                    <td class="">{{ $product->productInfo->description ?? '' }}</td>
                    <td class="text-center">{{ $product->town->description ?? '' }}</td>
                    <td class="text-center">{{ $product->quantity ?? '' }}</td>
                </tr>
                @endforeach
            @endif
            </tbody>
        </table>
    </div>
</div>