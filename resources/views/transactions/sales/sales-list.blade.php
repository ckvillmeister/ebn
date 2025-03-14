@extends('index')
@section('content')

<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div class="page-title-icon">
                <i class="fas fa-store icon-gradient bg-amy-crisp">
                </i>
            </div>
            <div>Sales List
                <div class="page-title-subheading">List of Sales Transactions
                </div>
            </div>
        </div>    
    </div>
</div>

<div class="row">
    <div class="col-sm-12">
        <div class="card p-3">
            <div class="body" id="content">
        
                <div class="row mt-3">
                    <div class="col-sm-12">
                        <table class="table table-sm table-bordered table-hovered" id="table-list" style="width: 100%">
                            <thead>
                                <tr>
                                    <th class="text-center">No</th>
                                    <th class="text-center">Sales Transaction Code</th>
                                    <th class="text-center">Transaction Date</th>
                                    <th class="text-center">Processed By</th>
                                    <th class="text-center">Control</th>
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
@endsection

@push('modal')
<style>
    #sub-loading-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(255, 255, 255, 0.8);
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 9999;
    }
</style>

<div class="modal fade bd-example-modal-lg" id="view-sales-trans-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Sales Transaction Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="sub-loading-overlay" style="display: none;">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden"></span>
                    </div>
                </div>
                <div id="trans-view-content">

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-warning">Print</button>
            </div>
        </div>
    </div>
</div>
@endpush
@push('scripts')
<script>
    $(document).ready(function() {
        generateSalesTransactionList(1);
    });

    function generateSalesTransactionList(status){
        if ($.fn.DataTable.isDataTable('#table-list')) {
            $('#table-list').DataTable().destroy();
        }

        $('#table-list').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('transaction-sales-trans-list') }}" + "?status="+status,
            columns: [
                { data: null, name: 'id', className: 'text-center', render: (data, type, row, meta) => meta.row + meta.settings._iDisplayStart + 1 },
                { data: 'code', name: 'code', className: 'text-center'},
                { data: 'transaction_date', name: 'transaction_date', className: 'text-center'},
                { data: 'processed_by', name: 'processed_by', className: 'text-center'},
                { data: 'action', name: 'action', className: 'text-center', orderable: false, searchable: false }
            ],
        });
    }

    function voidSalesTransaction(ev, el){
        var id = $(el).val();

        Swal.fire({
            title: 'Void Sales Transaction Record?',
            text: "Record will be voided and stocks from your inventory will be returned. Are you sure you want to continue?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, remove it!'
        }).then((result) => {
            if (result.isConfirmed) {

                $.ajax({
                    headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "{{ route('transaction-sales-void') }}",
                    method: 'POST',
                    data: {'id': id},
                    dataType: 'HTML',
                    error: function(obj, err, ex){
                        swal.fire({
                            title: "Server Error", 
                            icon: "error",
                            text: err + ": " + obj.toString() + " " + ex
                        });
                    }
                });
                generateSalesTransactionList(1);

            }
        });
    }

    function viewSalesTransaction(ev, el){
        var id = $(el).val();

        $.ajax({
            headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{ route('transaction-sales-view') }}",
            method: 'POST',
            data: {'id': id},
            dataType: 'HTML',
            beforeSend: function() {
                $('#sub-loading-overlay').show();
            },
            success: function(result) {
                $('#sub-loading-overlay').hide();
                $('#trans-view-content').html(result);
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