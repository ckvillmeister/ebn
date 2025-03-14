@extends('index')
@section('content')

<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div class="page-title-icon">
                <i class="pe-7s-users icon-gradient bg-amy-crisp">
                </i>
            </div>
            <div>Product Information Form
                <div class="page-title-subheading">Page for creating / updating product's information
                </div>
            </div>
        </div>    
    </div>
</div>

<div class="row clearfix">
    <div class="col-sm-12">
        <div class="card p-3">
            <div class="body" id="content">

                <form id="frm" method="POST">
                    <input type="hidden" name="id" value="{{ ($product) ? $product->id : null }}">
                    <div class="row clearfix">
                        <div class="col-sm-2">
                            <label for="code" class="col-form-label">Product Code:</label>
                        </div>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" id="code" name="code" placeholder="Product Code" value="{{ ($product) ? $product->code : $code }}" readonly>
                        </div>
                    </div>
                    <div class="row clearfix mt-2">
                        <div class="col-sm-2">
                            <label for="code" class="col-form-label">Product Name:</label>
                        </div>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" name="name" placeholder="Product Name" value="{{ ($product) ? $product->name : '' }}" required>
                        </div>
                    </div>
                    <div class="row clearfix mt-2">
                        <div class="col-sm-2">
                            <label for="description" class="col-form-label">Product Description:</label>
                        </div>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="description" placeholder="Product Description" value="{{ ($product) ? $product->description : '' }}" required>
                        </div>
                    </div>
                    <div class="row clearfix mt-2">
                        <div class="col-sm-2">
                            <label for="brand" class="col-form-label">Brand:</label>
                        </div>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" name="brand" placeholder="Brand" value="{{ ($product) ? $product->brand : '' }}">
                        </div>
                    </div>
                    <div class="row clearfix mt-2">
                        <div class="col-sm-2">
                            <label for="uom" class="col-form-label">Unit of Measurement:</label>
                        </div>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" name="uom" placeholder="Unit of Measurement" value="{{ ($product) ? $product->uom : '' }}" required>
                        </div>
                    </div>
                    <div class="row clearfix mt-2">
                        <div class="col-sm-2">
                            <label for="price" class="col-form-label">Price:</label>
                        </div>
                        <div class="col-sm-5">
                            <input type="number" step="any" class="form-control" name="price" placeholder="Price" value="{{ ($product) ? $product->price : '' }}" required>
                        </div>
                    </div>
                    <div class="row clearfix">
                        <div class="col-sm-8">
                            
                        </div>
                        <div class="col-sm-4 d-flex justify-content-end">
                            <div class="btn-group">
                                <button type="submit" class="btn btn-primary waves-effect btn-save">
                                    <i class="fas fa-save mr-2"></i>
                                    <span>Save</span>
                                </button>
                                <a href="{{ (request()->segment(2)==='delivery') ? route('transaction-delivery') : route('transaction-inventory') }}" class="btn btn-secondary waves-effect btn-back">
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
    var url = "{{ (request()->segment(2)==='delivery') ? route('transaction-delivery') : route('transaction-inventory') }}";

    $('#frm').on('submit', function(e){
        e.preventDefault();

        $.ajax({
            headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{ route('transaction-product-store') }}",
            method: 'POST',
            data: $('#frm').serialize(),
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
                            window.location.href = url;
                        }
                    }
                });
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
</script>
@endpush