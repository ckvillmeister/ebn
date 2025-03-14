@extends('index')
@section('content')

<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div class="page-title-icon">
                <i class="fas fa-file-alt icon-gradient bg-amy-crisp">
                </i>
            </div>
            <div>Delivery
                <div class="page-title-subheading">Product Delivery Transaction
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
                        <label for="product" class="col-form-label">Delivery Transaction No:</label>
                    </div>
                    <div class="col-sm-3">
                        <input class="form-control form-control-sm" type="text" value="{{ $code ?? '' }}" readonly>
                    </div>
                </div>

                <div class="row mt-2">
                    <div class="col-sm-2">
                        <label for="delivery-date" class="col-form-label">Delivery Date:</label>
                    </div>
                    <div class="col-sm-3">
                        <input class="form-control form-control-sm" name="delivery-date" id="delivery-date" type="date" value="{{ now()->format('Y-m-d') }}">
                    </div>
                </div>

                <div class="divider"></div>
                <div class="row">
                    <div class="col-sm-1">
                        <label for="product" class="col-form-label">Products:</label>
                    </div>
                    <div class="col-sm-6">
                        <select class="form-control show-tick" name="product" id="product">
                            @foreach ($products as $product)
                            <option value="{{ $product->id }}" data-name="{{ $product->name ?? '' }}" data-desc="{{ $product->description ?? '' }}" >{{ $product->name.' - '.$product->description }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm-2">
                        <button class="btn btn-primary btn-add-delivery"><i class="fas fa-plus mr-2"></i>Add to Delivery</button>
                    </div>
                    <div class="col-sm-3 d-flex justify-content-end">
                        <div class="btn-group">
                            <a type="button" class="btn btn-primary waves-effect btn-new" href="{{ route('transaction-delivery-product-new') }}">
                                <i class="fas fa-plus mr-2"></i>
                                <span>New Product</span>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-sm-12">
                        &nbsp;&nbsp;<label><b><em>List of Products Delivered</em></b></label>
                        <table class="table table-sm table-bordered table-hovered">
                            <thead>
                                <tr>
                                    <th class="text-center">No</th>
                                    <th class="text-center">Product Name</th>
                                    <th class="text-center">Description</th>
                                    <th class="text-center">Location</th>
                                    <th class="text-center" style="width: 10%">Quantity</th>
                                    <th class="text-center">Control</th>
                                </tr>
                            </thead>
                            <tbody id="product-delivery-list">
                                
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-sm-12 d-flex justify-content-end">
                        <button class="btn btn-primary waves-effect btn-save-delivery">
                            <i class="fas fa-save mr-2"></i>
                            <span>Save</span>
                        </button>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<div class="modal micromodal-slide" id="add-product-delivery" aria-hidden="true">
  <div class="modal__overlay" tabindex="-1">

    <div class="modal__container" role="dialog" aria-modal="true" aria-labelledby="myModal-title">
      <header class="modal__header">
        <h2 id="myModal-title"></h2>
        <button class="modal__btn" data-micromodal-close><i class="fas fa-times mr-2"></i>Close</button>
      </header>
      <main class="modal__content">        
        <input type="hidden" name="product-id" id="product-id">
        <div class="row clearfix">
            <div class="col-sm-2">
                <label for="code" class="col-form-label">Location:</label>
            </div>
            <div class="col-sm-10">
                <select class="form-control form-control-sm show-tick" name="location" id="location">
                    <option value=""></option>
                    @foreach ($towns as $town)
                    <option value="{{ $town->code }}">{{ $town->description }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="row clearfix mt-2">
            <div class="col-sm-2">
                <label for="code" class="col-form-label">Quantity:</label>
            </div>
            <div class="col-sm-10">
            <input type="number" class="form-control form-control-sm" name="quantity" id="quantity">
            </div>
        </div>
        <div class="row clearfix mt-3">
            <div class="col-sm-8"></div>
            <div class="col-sm-4 d-flex justify-content-end">
                <div class="btn-group">
                    <button type="submit" class="btn btn-primary waves-effect btn-add-product-to-list">
                        <i class="fas fa-save mr-2"></i>
                        <span>Add</span>
                    </button>
                </div>
            </div>
        </div>
      </main>
    </div>

  </div>
</div>
@endsection
@push('scripts')
<script>
    var ctr = 1;
    $('#product').select2({ width: '100%' });
    MicroModal.init();

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

    $('.btn-add-product-to-list').on('click', function(){
        var product = $('#product').val();
        var name = $('#product :selected').data('name');
        var desc = $('#product :selected').data('desc');
        var location = $('#location :selected').text();
        var loc_code = $('#location').val();
        var quantity = parseInt($('#quantity').val(), 10) || 0;
        var exists = false;

        $('#product-delivery-list tr').each(function(){
            var rowName = $(this).find('td:nth-child(2)').text().trim();
            var rowDesc = $(this).find('td:nth-child(3)').text().trim();
            var rowLocation = $(this).find('td:nth-child(4)').text().trim();

            if (rowName === name && rowDesc === desc && rowLocation === location) {
                var quantityInput = $(this).find('td:nth-child(5) input');
                var currentQty = parseInt(quantityInput.val(), 10) || 0;
                quantityInput.val(currentQty + quantity);
                exists = true;
                return false;
            }
        });

        if (!exists) {
            $('#product-delivery-list').append('<tr>' +
                '<td class="text-center">' + ctr++ + '</td>' +
                '<td>' + name + '</td>' +
                '<td>' + desc + '</td>' +
                '<td>' + location + '</td>' +
                '<td class="text-center"><input class="form-control form-control-sm text-center" type="number" value="' + quantity + '"></td>' +
                '<td class="text-center"><button class="btn btn-sm btn-danger" data-location="' + loc_code + '" value="' + product + '" onclick="removeItem(event, this)">Remove</button></td>' +
            '</tr>');
        }

        MicroModal.close('add-product-delivery');
    });

    $('.btn-save-delivery').on('click', function(e){
        e.preventDefault();
        var del_date = $('#delivery-date').val();
        var products = [];

        $('#product-delivery-list tr').each(function() {
            var quantity = $(this).find('td:eq(4) input[type="number"]').val();
            var location = $(this).find('td:eq(5) button').data('location');
            var product_id = $(this).find('td:eq(5) button').val();

            products.push([product_id, location, quantity]);
        });

        $.ajax({
            headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{ route('transaction-delivery-save') }}",
            method: 'POST',
            data: {
                'delivery_date': del_date,
                'products': products
            },
            dataType: 'JSON',
            success: function(result) {
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
                $('#product-delivery-list tr').each(function(index) {
                    $(this).find('td:first').text(num++);
                });
            }
        });
    }
</script>
@endpush