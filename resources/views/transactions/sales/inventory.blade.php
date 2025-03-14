@extends('index')
@section('content')

<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div class="page-title-icon">
                <i class="pe-7s-users icon-gradient bg-amy-crisp">
                </i>
            </div>
            <div>Inventory
                <div class="page-title-subheading">Inventory of products
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
                    <a type="button" class="btn btn-primary waves-effect btn-new" href="{{ route('transaction-product-new') }}">
                        <i class="fas fa-plus mr-2"></i>
                        <span>Add New Product</span>
                    </a>
                </div>

                <br><br>

                <div class="card-header-tab card-header">
                    <div class="card-header-title">
                        <i class="header-icon lnr-bicycle icon-gradient bg-love-kiss"> </i>
                    </div>
                    <ul class="nav">
                        <li class="nav-item"><a data-toggle="tab" href="#inventory" class="nav-link active show"><i class="fas fa-box-open mr-2"></i>Inventory</a></li>
                        <li class="nav-item"><a data-toggle="tab" href="#inventory-by-location" class="nav-link show"><i class="fas fa-map-marker mr-2"></i>Inventory by Location</a></li>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content">
                        <div class="tab-pane active show" id="inventory" role="tabpanel">

                            <div class="btn-group">
                                <button type="button" class="btn btn-info waves-effect btn-active">
                                    <i class="fas fa-check-square mr-2"></i>
                                    <span>View Active</span>
                                </button>
                                <button type="button" class="btn btn-secondary waves-effect btn-trash">
                                    <i class="fas fa-trash-alt mr-2"></i>
                                    <span>View Trashed</span>
                                </button>
                            </div>

                            <br><br>

                            <table class="table table-striped table-hover" id="table-list" style="width: 100%">
                                <thead>
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th class="text-center">Product Code</th>
                                        <th class="text-center">Product Name</th>
                                        <th class="text-center">Description</th>
                                        <th class="text-center">Unit</th>
                                        <th class="text-center">Brand</th>
                                        <th class="text-center">Price</th>
                                        <th class="text-center">Total Stocks</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>

                        </div>
                        <div class="tab-pane show" id="inventory-by-location" role="tabpanel">

                            <div class="row mb-3">
                                <div class="col-sm-1">
                                    <label for="location" class="col-form-label">Filter by:</label>
                                </div>
                                <div class="col-sm-3">
                                    <select class="form-control" name="filter-location" id="filter-location">
                                        <option value="">- Select Location -</option>
                                        @if (!blank($towns))
                                            @foreach ($towns as $town)
                                            <option value="{{ $town->code }}">{{ $town->description }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>

                            <table class="table table-striped table-hover" id="tbl-inventory-list" style="width: 100%">
                                <thead>
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th class="text-center">Product Code</th>
                                        <th class="text-center">Product Name</th>
                                        <th class="text-center">Description</th>
                                        <th class="text-center">Unit</th>
                                        <th class="text-center">Brand</th>
                                        <th class="text-center">Price</th>
                                        <th class="text-center">Total Stocks</th>
                                        <th class="text-center">Location</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<div class="modal micromodal-slide" id="manage-stocks" aria-hidden="true">
  <div class="modal__overlay" tabindex="-1">

    <div class="modal__container" role="dialog" aria-modal="true" aria-labelledby="myModal-title">
      <header class="modal__header">
        <h2 id="myModal-title">Manage Stocks</h2>
        <button class="modal__btn" data-micromodal-close><i class="fas fa-times mr-2"></i>Close</button>
      </header>
      <main class="modal__content">
        <form id="frm">
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
                    <label for="code" class="col-form-label">Action:</label>
                </div>
                <div class="col-sm-10">
                    <select class="form-control form-control-sm show-tick" name="action" id="action">
                        <option value=""></option>
                        <option value="Add">Add</option>
                        <option value="Deduct">Deduct</option>
                    </select>
                </div>
            </div>
            <div class="row clearfix mt-2">
                <div class="col-sm-2">
                    <label for="code" class="col-form-label">Quantity:</label>
                </div>
                <div class="col-sm-10">
                <input type="text" class="form-control form-control-sm" name="quantity" id="quantity">
                </div>
            </div>
            <div class="row clearfix mt-3">
                <div class="col-sm-8"></div>
                <div class="col-sm-4 d-flex justify-content-end">
                    <div class="btn-group">
                        <button type="submit" class="btn btn-primary waves-effect btn-save-stock">
                            <i class="fas fa-save mr-2"></i>
                            <span>Save</span>
                        </button>
                    </div>
                </div>
            </div>
        </form>
      </main>
    </div>

  </div>
</div>

<style>
  .modal { display: none; }
  .modal.is-open { display: block; }
  #manage-stocks .modal__container {
        width: 30% !important;  /* Force width */
        max-width: none !important;  /* Remove Bootstrap or MicroModal width restrictions */
  }
</style>

@endsection
@push('scripts')
<script>
    $('#location').select2({ width: '100%' });
    MicroModal.init();

    $('.btn-active').on('click', function(){
        generateProductsList(1, 0);
    });

    $('.btn-trash').on('click', function(){
        generateProductsList(0, 0);
    });

    $('#filter-location').on('change', function(){
        var code = $(this).val();
        if ($.fn.DataTable.isDataTable('#tbl-inventory-list')) {
            $('#tbl-inventory-list').DataTable().destroy();
        }

        $('#tbl-inventory-list').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('transaction-product-list') }}" + "?status=1&viewall=1&location="+code,
            columns: [
                { data: null, name: 'id', className: 'text-center', render: (data, type, row, meta) => meta.row + meta.settings._iDisplayStart + 1 },
                { data: 'code', name: 'code', className: 'text-center' },
                { data: 'name', name: 'name' },
                { data: 'description', name: 'description' },
                { data: 'uom', name: 'uom', orderable: false, searchable: false },
                { data: 'brand', name: 'brand', orderable: false, searchable: false },
                { data: 'price', name: 'price', className: 'text-right' },
                { data: 'stocks', name: 'stocks', className: 'text-center', orderable: false, searchable: false },
                { data: 'location', name: 'location', className: 'text-center' },
                { data: 'action', name: 'action', className: 'text-center', orderable: false, searchable: false }
            ],
        });
    });

    $('#frm').on('submit', function(e){
        e.preventDefault();

        $.ajax({
            headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{ route('transaction-manage-stocks') }}",
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
                            window.location.href = "{{ route('transaction-inventory') }}";
                        }
                    }
                });

                setTimeout(function(){ window.location.href = "{{ route('transaction-inventory') }}"; }, 5000);
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

    $(document).ready(function() {
        generateProductsList(1, 0);
    });

    function generateProductsList(status, view){
        if ($.fn.DataTable.isDataTable('#table-list')) {
            $('#table-list').DataTable().destroy();
        }

        $('#table-list').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('transaction-product-list') }}" + "?status="+status+"&view="+view,
            columns: [
                { data: null, name: 'id', className: 'text-center', render: (data, type, row, meta) => meta.row + meta.settings._iDisplayStart + 1 },
                { data: 'code', name: 'code', className: 'text-center'},
                { data: 'name', name: 'name'},
                { data: 'description', name: 'description'},
                { data: 'uom', name: 'uom'},
                { data: 'brand', name: 'brand'},
                { data: 'price', name: 'price', className: 'text-right'},
                { data: 'stocks', name: 'stocks', className: 'text-center'},
                { data: 'action', name: 'action', className: 'text-center', orderable: false, searchable: false }
            ],
        });
    }

    function deleteProduct(ev, el){
        var id = $(el).val();

        Swal.fire({
            title: 'Delete Product?',
            text: "Product record will be stored to trash.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, remove it!'
        }).then((result) => {
            if (result.isConfirmed) {
                toggleStatus(id, 0);
                generateProductsList(1, 0);
            }
        });
    }

    function restoreProduct(ev, el){
        var id = $(el).val();

        Swal.fire({
            title: 'Restore Product?',
            text: "This means you will be using this record again.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, restore it!'
        }).then((result) => {
            if (result.isConfirmed) {
                toggleStatus(id, 1);
                generateProductsList(1, 0);
            }
        });
    }

    function manageProductStocks(ev, el){
        $('#product-id').val($(el).val());
        MicroModal.show('manage-stocks');
    }

    function toggleStatus(id, status){
        $.ajax({
            headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{ route('transaction-product-toggle-status') }}",
            method: 'POST',
            data: {'id': id, 'status': status},
            dataType: 'HTML',
            success: function(result) {
                
            },
            error: function(obj, err, ex){
                swal.fire({
                    title: "Server Error", 
                    icon: "error",
                    text: err + ": " + obj.toString() + " " + ex
                });
            }
        })
    }
</script>
@endpush