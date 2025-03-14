@extends('index')
@section('content')

<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div class="page-title-icon">
                <i class="fas fa-store icon-gradient bg-amy-crisp">
                </i>
            </div>
            <div>Sales
                <div class="page-title-subheading">Product Sales Transaction
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
                    <div class="col-sm-2">
                        <label for="product" class="col-form-label">Sales Transaction No:</label>
                    </div>
                    <div class="col-sm-3">
                        <input class="form-control form-control-sm" type="text" value="{{ $code ?? '' }}" readonly>
                    </div>
                </div>

                <div class="row mt-2">
                    <div class="col-sm-2">
                        <label for="transaction-date" class="col-form-label">Transaction Date:</label>
                    </div>
                    <div class="col-sm-3">
                        <input class="form-control form-control-sm" name="transaction-date" id="transaction-date" type="date" value="{{ now()->format('Y-m-d') }}">
                    </div>
                </div>

                <div class="divider"></div>
                <div class="row">
                    <div class="col-sm-2">
                        <label for="product" class="col-form-label">Location:</label>
                    </div>
                    <div class="col-sm-3">
                        <select class="form-control show-tick" name="town" id="town">
                            <option value="">Select Location</option>
                            @foreach ($towns as $town)
                            <option value="{{ $town->code }}" data-name="{{ $town->description ?? '' }}">{{ $town->description ?? '' }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-sm-2">
                        <label for="product" class="col-form-label">Products:</label>
                    </div>
                    <div class="col-sm-6">
                        <select class="form-control form-control-sm show-tick" name="product" id="product">
                        </select>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-sm-2">
                    </div>
                    <div class="col-sm-4">
                        <button class="btn btn-primary btn-add-to-list"><i class="fas fa-plus mr-2"></i>Add to List</button>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-sm-12">
                        <table class="table table-sm table-bordered table-hovered">
                            <thead>
                                <tr>
                                    <th class="text-center">No</th>
                                    <th class="text-center">Product Name</th>
                                    <th class="text-center">Description</th>
                                    <th class="text-center">Price</th>
                                    <th class="text-center" style="width: 10%">Quantity</th>
                                    <th class="text-center">Sub Total</th>
                                    <th class="text-center">Control</th>
                                </tr>
                            </thead>
                            <tbody id="product-sales-list">
                                
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-sm-12 d-flex justify-content-end">
                        <button class="btn btn-primary waves-effect btn-save-sales">
                            <i class="fas fa-save mr-2"></i>
                            <span>Save</span>
                        </button>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script>
    var ctr = 1;
    $('#town').select2({ width: '100%' });
    MicroModal.init();

    $('#town').on('change', function(){
        var code = $(this).val();

        $.ajax({
            headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{ route('transaction-sales-get-products') }}",
            method: 'POST',
            data: {
                'code': code
            },
            dataType: 'JSON',
            success: function(result) {
                $('#product').empty();

                $.each(result, function(index, item) {
                    $('#product').append('<option value="' + item.product_id + '" data-name="' + item.name + '" data-desc="' + item.description + '" data-price="' + item.price + '" data-stocks="' + item.stocks + '">' + item.name + ' - ' + item.description +
                                            '</option>');
                });

                $('#product').select2({ width: '100%' });
                
            },
            error: function(obj, err, ex){
                swal.fire({
                    title: "Server Error", 
                    icon: "error",
                    text: err + ": " + obj.toString() + " " + ex
                });
            }
        })
    });

    $('.btn-add-to-list').on('click', function(){
        Swal.fire({
            title: 'Please enter a quantity.',
            input: 'number',
            showCancelButton: true,
            confirmButtonText: 'Submit',
            inputAttributes: {
                min: '1', // Set minimum value
                max: '100', // Set maximum value
                step: '1' // Set step value
            }
        }).then((result) => {
            if (result.isConfirmed) {
                var product = $('#product').val().trim();
                var name = $('#product :selected').data('name');
                var desc = $('#product :selected').data('desc');
                var price = $('#product :selected').data('price');
                var stocks = $('#product :selected').data('stocks');
                var location = $('#town').val();
                var quantity = parseInt(result.value);
                var exists = false;

                if (quantity > stocks){
                    swal.fire({
                        title: "Not enough stocks!", 
                        icon: "error",
                        text: "Please check your inventory."
                    });

                    return;
                }

                $('#product-sales-list tr').each(function(){
                    var rowName = $(this).find('td:nth-child(2)').text().trim();
                    var rowDesc = $(this).find('td:nth-child(3)').text().trim();

                    if (rowName === name && rowDesc === desc) {
                        var quantityInput = $(this).find('td:nth-child(5) input');
                        var currentQty = parseInt(quantityInput.val(), 10) || 0;
                        quantityInput.val(currentQty + quantity);
                        
                        var subTotal = parseFloat(currentQty + quantity) * parseFloat(price);
                        $(this).find('td:nth-child(6)').text(subTotal.toFixed(2));
                        exists = true;
                        return false;
                    }
                });

                if (!exists) {
                    var subTotal = parseFloat(quantity) * parseFloat(price);
                    $('#product-sales-list').append('<tr>' +
                        '<td class="text-center">' + ctr++ + '</td>' +
                        '<td>' + name + '</td>' +
                        '<td>' + desc + '</td>' +
                        '<td class="text-right">' + price.toFixed(2) + '</td>' +
                        '<td class="text-center"><input id="prod-qty-sale" class="form-control form-control-sm text-center" type="number" value="' + quantity + '"></td>' +
                        '<td class="text-right">' + subTotal.toFixed(2) + '</td>' +
                        '<td class="text-center"><button class="btn btn-sm btn-danger" data-productid="' + product + '" data-location="' + location + '" onclick="removeItem(event, this)"><i class="fas fa-minus-square"></i></td>' +
                    '</tr>');
                }
            }
        });

        
    });

    $(document).on('input', '#product-sales-list input[type="number"]', function() {
        var row = $(this).closest('tr');
        var price = parseFloat(row.find('td:nth-child(4)').text()) || 0;
        var quantity = parseInt($(this).val()) || 0;
        var subTotal = price * quantity;
        var stocks = $('#product :selected').data('stocks');

        if (quantity > stocks){
            swal.fire({
                title: "Not enough stocks!", 
                icon: "error",
                text: "Please check your inventory."
            });

            $(this).val(quantity - parseInt(1));

            return;
        }

        row.find('td:nth-child(6)').text(subTotal.toFixed(2));
    });


    $('.btn-add-delivery').on('click', function(){
        var product = $('#product').val();

        if (!product){
            swal.fire({
                title: "No product selected!",
                icon: "error",
                text: "Please select a product to be added to the delivery list!",
                confirmButtonText: "Okay",
            });
        }
        else{
            $('#product-id').val(product);
            MicroModal.show('add-product-delivery');
        }
    });

    

    $('.btn-save-sales').on('click', function(e){
        e.preventDefault();
        var trans_date = $('#transaction-date').val();
        var products = [];

        $('#product-sales-list tr').each(function() {
            var price = parseFloat($(this).find('td:eq(3)').text());
            var quantity = $(this).find('td:eq(4) input[type="number"]').val();
            var location = $(this).find('td:eq(6) button').data('location');
            var product_id = $(this).find('td:eq(6) button').data('productid');

            products.push([price, quantity, location, product_id]);
        });

        $.ajax({
            headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{ route('transaction-sales-save') }}",
            method: 'POST',
            data: {
                'trans_date': trans_date,
                'products': products
            },
            dataType: 'JSON',
            beforeSend: function() {
                $('#loading-overlay').show();
            },
            success: function(result) {
                $('#loading-overlay').hide();
                swal.fire({
                    title: result['title'],
                    icon: result['icon'],
                    text: result['message'],
                    confirmButtonText: "Okay",
                }).then((res) => {
                    if (res.isConfirmed) {
                        if (result['icon'] == 'success'){
                            location.reload();
                        }
                    }
                });

                setTimeout(function(){ location.reload(); }, 5000);
            },
            error: function(obj, err, ex){
                swal.fire({
                    title: "Server Error", 
                    icon: "error",
                    text: err + ": " + obj.toString() + " " + ex
                });
            }
        })
    });

    function removeItem(ev, el){
        Swal.fire({
            title: 'Remove Item?',
            text: "Item will be removed from the list.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, remove it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $(el).closest('tr').remove();
                ctr--;

                var num = 1;
                $('#product-sales-list tr').each(function(index) {
                    $(this).find('td:first').text(num++);
                });
            }
        });
    }
</script>
@endpush