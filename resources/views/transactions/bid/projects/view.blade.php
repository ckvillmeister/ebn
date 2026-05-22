@extends('index')

@section('content')

<div class="app-page-title">
    <div class="page-title-heading">
        <div class="page-title-icon">
            <i class="pe-7s-folder icon-gradient bg-amy-crisp"></i>
        </div>
        <div>Project Name: <b>{{ $data->project_name }}</b></div>
    </div>
</div>

<div class="card p-3">

    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6 text-center">
            @if($data->agency_logo_url)
                <img src="{{ asset($data->agency_logo_url) }}" width="300" class="rounded">
            @endif
            <div class="page-title-actions mt-2">
                <div class="row">
                    <div class="col-6">
                        <a href="{{ route('projects.print', [$data->id, 'technical']) }}"
                        target="_blank"
                        class="btn btn-success col-12">
                            <i class="fas fa-print mr-2"></i>Print Technical Components
                        </a>
                    </div>
                    <div class="col-6">
                        <a href="{{ route('projects.print', [$data->id, 'financial']) }}"
                        target="_blank"
                        class="btn btn-success col-12">
                            <i class="fas fa-print mr-2"></i>Print Financial Components
                        </a>
                    </div>
                </div>
                <div class="row mt-2 mb-3">
                    <div class="col-4">
                        <button class="btn btn-success col-12"><i class="fas fa-file-pdf mr-2"></i>PDF</button>
                    </div>
                    <div class="col-4">
                        <a href="{{ route('projects.edit', $data->id) }}" class="btn btn-warning col-12"><i class="fas fa-edit mr-2"></i>Edit</a>
                    </div>
                    <div class="col-4">
                        <a href="{{ route('projects.index') }}" class="btn btn-secondary col-12"><i class="fas fa-backward mr-2"></i>Back</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3"></div>

        <div class="col-md-6 mt-3">
            <strong>Reference No:</strong> {{ $data->project_reference_no }}
        </div>

        <div class="col-md-6 mt-3">
            <strong>Identification No:</strong> {{ $data->project_identification_no }}
        </div>

        <div class="col-md-6 mt-2">
            <strong>Project Type:</strong> {{ $data->project_type }}
        </div>

        <div class="col-md-6 mt-2">
            <strong>Project Cost:</strong> {{ $data->project_cost }}
        </div>

        <div class="col-md-6 mt-2">
            <strong>Agency Name:</strong> {{ $data->agency_name }}
        </div>

        <div class="col-md-6 mt-2">
            <strong>Contact No:</strong> {{ $data->contact_no }}
        </div>

        <div class="col-md-6 mt-2">
            <strong>Address:</strong> {{ $data->address }}
        </div>

        <div class="col-md-6 mt-2">
            <strong>Nature of Work:</strong> {{ $data->nature_of_work }}
        </div>

        <div class="col-md-6 mt-2">
            <strong>Bidder Role:</strong> {{ $data->bidder_role_desc }}
        </div>

        <div class="col-md-6 mt-2">
            <strong>Role %:</strong> {{ $data->bidder_role_percent }}
        </div>

        <div class="col-md-6 mt-2">
            <strong>Date Awarded:</strong> {{ $data->date_awarded }}
        </div>

        <div class="col-md-6 mt-2">
            <strong>Date Started:</strong> {{ $data->date_started }}
        </div>

        <div class="col-md-6 mt-2">
            <strong>Date Completed:</strong> {{ $data->date_of_completion }}
        </div>

        <div class="col-md-6 mt-2">
            <strong>Planned %:</strong> {{ $data->percent_accomplishment_planned }}
        </div>

        <div class="col-md-6 mt-2">
            <strong>Actual %:</strong> {{ $data->percent_accomplishment_actual }}
        </div>

        <div class="col-md-6 mt-2">
            <strong>Value:</strong> {{ $data->value }}
        </div>

        <div class="col-md-6 mt-2">
            <strong>Bid Securing Date:</strong> {{ $data->bid_securing_declaration_date }}
        </div>

        <div class="col-md-6 mt-2">
            <strong>Omnibus Date:</strong> {{ $data->omnibus_sworn_statement_date }}
        </div>

        <div class="col-md-6 mt-2">
            <strong>Price Validity (Days):</strong> {{ $data->fc_warranty_calendar_days }}
        </div>

        <div class="col-md-6 mt-2">
            <strong>Warranty (Months):</strong> {{ $data->fc_warranty }}
        </div>

        <div class="col-md-12 mt-2">
            <strong>Product:</strong> {{ $data->fc_product_to_be_supplied }}
        </div>


    </div>
    <div class="card p-3 mt-3">

    <!-- Tabs Navigation -->
        <ul class="body-tabs body-tabs-layout tabs-animated body-tabs-animated nav">
            <li class="nav-item">
                <a role="tab" class="nav-link active" data-toggle="tab" href="#tab-nfcc">
                    <span>Net Financial Contracting Capacity</span>
                </a>
            </li>
            <li class="nav-item">
                <a role="tab" class="nav-link" data-toggle="tab" href="#tab-delivery">
                    <span>TC - Delivery Schedule</span>
                </a>
            </li>
            <li class="nav-item">
                <a role="tab" class="nav-link" data-toggle="tab" href="#tab-manpower">
                    <span>TC - Man-Power Requirements</span>
                </a>
            </li>
            <li class="nav-item">
                <a role="tab" class="nav-link" data-toggle="tab" href="#tab-tools">
                    <span>TC - Tools & Equipment</span>
                </a>
            </li>
            <li class="nav-item">
                <a role="tab" class="nav-link" data-toggle="tab" href="#tab-pow">
                    <span>FC - Bill of Materials</span>
                </a>
            </li>
        </ul>

        <!-- Tabs Content -->
        <div class="tab-content mt-3">

            <!-- DELIVERY SCHEDULE -->
            <div class="tab-pane fade show active" id="tab-delivery" role="tabpanel">
                <div id="delivery-container">
                    <!-- CRUD UI goes here -->
                    <div>
                        <!-- BUTTONS -->
                        <div class="mb-4">
                            <button class="btn btn-success btn-sm" id="btnNew"><i class="fas fa-plus mr-2"></i>New</button>
                        </div>

                        <!-- FORM -->
                        <div class="card p-3 mb-3" id="formContainer" style="display:none;">
                            <form id="deliveryForm">

                                <input type="hidden" id="record_id">

                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Description</label>
                                        <input type="text" id="description" class="form-control">
                                    </div>

                                    <div class="col-md-6">
                                        <label>Schedule</label>
                                        <input type="text" id="schedule" class="form-control">
                                    </div>

                                    <div class="col-md-6 mt-2">
                                        <label>Amount</label>
                                        <input type="number" step="0.01" id="amount" class="form-control">
                                    </div>

                                    <div class="col-md-6 mt-2">
                                        <label>Remarks</label>
                                        <input type="text" id="remarks" class="form-control">
                                    </div>
                                </div>

                                <div class="mt-2">
                                    <button type="submit" class="btn btn-primary btn-sm">Save</button>
                                </div>

                            </form>
                        </div>

                        <!-- TABLE -->
                        <table class="table table-bordered w-100" id="deliveryTable">
                            <thead>
                                <tr>
                                    <th>Description</th>
                                    <th>Schedule</th>
                                    <th>Amount</th>
                                    <th>Remarks</th>
                                    <th width="150">Actions</th>
                                </tr>
                            </thead>
                        </table>

                    </div>
                </div>
            </div>

            <!-- PROGRAM OF WORKS -->
            <div class="tab-pane fade" id="tab-pow" role="tabpanel">
                <div id="pow-container">

                <div>

                    <!-- BUTTON -->
                    <div class="mb-4">
                        <button class="btn btn-success btn-sm" id="btnNewPow"><i class="fas fa-plus mr-2"></i>New</button>
                    </div>

                    <!-- FORM -->
                    <div class="card p-3 mb-3" id="powFormContainer" style="display:none;">
                        <form id="powForm">

                            <input type="hidden" id="pow_id">

                            <div class="row">

                                <div class="col-md-6">
                                    <label>Description</label>
                                    <input type="text" id="pow_description" class="form-control">
                                </div>

                                <div class="col-md-3">
                                    <label>Quantity</label>
                                    <input type="number" id="pow_quantity" class="form-control">
                                </div>

                                <div class="col-md-3">
                                    <label>Unit of Measurement</label>
                                    <input type="text" id="pow_unit" class="form-control">
                                </div>

                                <div class="col-md-3 mt-2">
                                    <label>Unit Cost</label>
                                    <input type="number" step="0.01" id="pow_unit_cost" class="form-control">
                                </div>

                                <div class="col-md-3 mt-2">
                                    <label>Total Cost</label>
                                    <input type="number" step="0.01" id="pow_total_cost" class="form-control" readonly>
                                </div>

                            </div>

                            <div class="mt-2">
                                <button class="btn btn-primary btn-sm">Save</button>
                            </div>

                        </form>
                    </div>

                    <!-- TABLE -->
                    <table class="table table-bordered w-100" id="powTable">
                        <thead>
                            <tr>
                                <th>Description</th>
                                <th>Qty</th>
                                <th>Unit of Meas.</th>
                                <th>Unit Cost</th>
                                <th>Total Cost</th>
                                <th width="150">Actions</th>
                            </tr>
                        </thead>
                    </table>

                    </div>

                </div>
            </div>

            <!-- MANPOWER -->
            <div class="tab-pane fade" id="tab-manpower" role="tabpanel">
                <div id="manpower-container">
                                    <div>

                    <div class="mb-4">
                        <button class="btn btn-success btn-sm" id="btnNewMan"><i class="fas fa-plus mr-2"></i>New</button>
                    </div>

                    <!-- FORM -->
                    <div class="card p-3 mb-3" id="manFormContainer" style="display:none;">
                        <form id="manForm">

                            <input type="hidden" id="man_id">

                            <div class="row">

                                <div class="col-md-6">
                                    <label>Man Power Type</label>
                                    <select id="man_power_type_id" class="form-control">
                                        <option value="">Select Type</option>
                                        @foreach($manPowerTypes as $type)
                                            <option value="{{ $type->id }}">{{ $type->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-3">
                                    <label>Quantity</label>
                                    <input type="number" id="man_quantity" class="form-control">
                                </div>

                                <div class="col-md-12 mt-2">
                                    <label>Task</label>
                                    <input type="text" id="man_task" class="form-control">
                                </div>

                            </div>

                            <div class="mt-2">
                                <button class="btn btn-primary btn-sm">Save</button>
                            </div>

                        </form>
                    </div>

                    <!-- TABLE -->
                    <table class="table table-bordered w-100" id="manTable">
                        <thead>
                            <tr>
                                <th>Type</th>
                                <th>Quantity</th>
                                <th>Task</th>
                                <th width="150">Actions</th>
                            </tr>
                        </thead>
                    </table>

                    </div>
                </div>
            </div>

            <!-- TOOLS & EQUIPMENT -->
            <div class="tab-pane fade" id="tab-tools" role="tabpanel">
                <div id="tools-container">

                <div>

                    <div class="mb-4">
                        <button class="btn btn-success btn-sm" id="btnNewTe"><i class="fas fa-plus mr-2"></i>New</button>
                    </div>

                    <!-- FORM -->
                    <div class="card p-3 mb-3" id="teFormContainer" style="display:none;">
                        <form id="teForm">

                            <input type="hidden" id="te_id">

                            <div class="row">

                                <div class="col-md-6">
                                    <label>Tool / Equipment</label>
                                    <select id="tool_equipment_id" class="form-control">
                                        <option value="">Select</option>
                                        @foreach($equipments as $eq)
                                            <option value="{{ $eq->id }}">
                                                {{ $eq->name }} ({{ $eq->type }})
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-3">
                                    <label>Quantity</label>
                                    <input type="number" id="te_quantity" class="form-control">
                                </div>

                            </div>

                            <div class="mt-2">
                                <button class="btn btn-primary btn-sm">Save</button>
                            </div>

                        </form>
                    </div>

                    <!-- TABLE -->
                    <table class="table table-bordered w-100" id="teTable">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Type</th>
                                <th>Quantity</th>
                                <th width="150">Actions</th>
                            </tr>
                        </thead>
                    </table>

                    </div>

                </div>
            </div>

            <!-- NFCC -->
            <div class="tab-pane fade" id="tab-nfcc" role="tabpanel">
                <div id="nfcc-container">
                <div>

                    <div class="mb-4">
                        <button class="btn btn-success btn-sm" id="btnNewNfcc"><i class="fas fa-plus mr-2"></i>New</button>
                    </div>

                    <!-- FORM -->
                    <div class="card p-3 mb-3" id="nfccFormContainer" style="display:none;">
                        <form id="nfccForm">

                            <input type="hidden" id="nfcc_id">

                            <div class="row">

                                <div class="col-md-4">
                                    <label>Name</label>
                                    <input type="text" id="nfcc_name" class="form-control">
                                </div>

                                <div class="col-md-4">
                                    <label>Year</label>
                                    <input type="number" id="nfcc_year" class="form-control">
                                </div>

                                <div class="col-md-4">
                                    <label>Amount</label>
                                    <input type="number" step="0.01" id="nfcc_amount" class="form-control">
                                </div>

                            </div>

                            <div class="mt-2">
                                <button class="btn btn-primary btn-sm">Save</button>
                            </div>

                        </form>
                    </div>

                    <!-- TABLE -->
                    <table class="table table-bordered w-100" id="nfccTable">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Year</th>
                                <th>Amount</th>
                                <th width="180">Actions</th>
                            </tr>
                        </thead>
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
    let loadedTabs = {
        delivery: false,
        pow: false,
        manpower: false,
        tools: false,
        nfcc: false
    };

    $(function () {
        initTabFix();

        loadTable();
    loadPowTable();
    loadManTable();
    loadTeTable();
    loadNfccTable();

    loadedTabs.delivery = true;
    loadedTabs.pow = true;
    loadedTabs.manpower = true;
    loadedTabs.tools = true;
    loadedTabs.nfcc = true;
    });

    function initTabFix() {
        $('a[data-toggle="tab"], a[data-bs-toggle="tab"]').on('shown.bs.tab', function () {

            setTimeout(() => {
                $.fn.dataTable.tables({ visible: true, api: true })
                    .columns.adjust()
                    .responsive?.recalc?.();
            }, 200);
        });
    }

    //Start Project Delivery Module
    let projectId = "{{ $data->id }}";
    let table;

    function loadTable() {
        if (table) table.destroy();

        table = $('#deliveryTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: `/transaction/bids/projects/${projectId}/delivery-schedule`,
            columns: [
                { data: 'description' },
                { data: 'schedule' },
                { data: 'amount' },
                { data: 'remarks' },
                { data: 'action', orderable: false, searchable: false }
            ]
        });
    }

    $(document).ready(function () {

        loadTable();

        $('#btnNew').click(function () {
            $('#formContainer').toggle();
            $('#deliveryForm')[0].reset();
            $('#record_id').val('');
        });

        // EDIT
        $(document).on('click', '.editBtn', function () {
            $('#formContainer').show();

            $('#record_id').val($(this).data('id'));
            $('#description').val($(this).data('description'));
            $('#schedule').val($(this).data('schedule'));
            $('#amount').val($(this).data('amount'));
            $('#remarks').val($(this).data('remarks'));
        });

        // DELETE
        $(document).on('click', '.deleteBtn', function () {
            let id = $(this).data('id');

            Swal.fire({
                title: 'Are you sure?',
                text: 'This will permanently delete the record.',
                icon: 'warning',
                showCancelButton: true
            }).then((result) => {
                if (result.isConfirmed) {

                    $.ajax({
                        url: `/transaction/bids/delivery-schedule/delete/${id}`,
                        type: 'DELETE',
                        data: {
                            _token: $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function () {
                            loadTable();
                        }
                    });

                }
            });
        });

        // SAVE
        $('#deliveryForm').submit(function (e) {
            e.preventDefault();

            let id = $('#record_id').val();

            let url = id
                ? `/transaction/bids/delivery-schedule/update/${id}`
                : `/transaction/bids/projects/${projectId}/delivery-schedule/store`;

            $.post(url, {
                _token: $('meta[name="csrf-token"]').attr('content'),
                description: $('#description').val(),
                schedule: $('#schedule').val(),
                amount: $('#amount').val(),
                remarks: $('#remarks').val()
            }, function () {
                $('#formContainer').hide();
                loadTable();
            });
        });

    });
    //End Project Delivery Module

    //Start Detailed Estimate Module
    let powTable;
    //let projectId = "{{ $data->id }}";

    function loadPowTable() {
        if (powTable) powTable.destroy();

        powTable = $('#powTable').DataTable({
            processing: true,
            serverSide: true,
            autoWidth: false,
            ajax: `/transaction/bids/projects/${projectId}/detailed-estimates`,
            columns: [
                { data: 'description' },
                { data: 'quantity' },
                { data: 'unit' },
                { data: 'unit_cost' },
                { data: 'total_cost' },
                { data: 'action', orderable: false, searchable: false }
            ]
        });

        // FIX: ensure correct width after render
        setTimeout(() => powTable.columns.adjust(), 150);
    }

    $(document).ready(function () {

        $('#btnNewPow').click(function () {
            $('#powFormContainer').toggle();
            $('#powForm')[0].reset();
            $('#pow_id').val('');
        });

        // AUTO COMPUTE TOTAL
        $('#pow_quantity, #pow_unit_cost').on('input', function () {
            let qty = parseFloat($('#pow_quantity').val()) || 0;
            let cost = parseFloat($('#pow_unit_cost').val()) || 0;
            $('#pow_total_cost').val(qty * cost);
        });

        // EDIT
        $(document).on('click', '.editPowBtn', function () {

            $('#powFormContainer').show();

            $('#pow_id').val($(this).data('id'));
            $('#pow_description').val($(this).data('description'));
            $('#pow_quantity').val($(this).data('quantity'));
            $('#pow_unit').val($(this).data('unit'));
            $('#pow_unit_cost').val($(this).data('unit_cost'));
            $('#pow_total_cost').val($(this).data('total_cost'));
        });

        // DELETE
        $(document).on('click', '.deletePowBtn', function () {

            let id = $(this).data('id');

            Swal.fire({
                title: 'Are you sure?',
                text: 'This will permanently delete this record.',
                icon: 'warning',
                showCancelButton: true
            }).then((result) => {
                if (result.isConfirmed) {

                    $.ajax({
                        url: `/transaction/bids/detailed-estimates/delete/${id}`,
                        type: 'DELETE',
                        data: {
                            _token: $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function () {
                            loadPowTable();
                        }
                    });

                }
            });
        });

        // SAVE
        $('#powForm').submit(function (e) {
            e.preventDefault();

            let id = $('#pow_id').val();

            let url = id
                ? `/transaction/bids/detailed-estimates/update/${id}`
                : `/transaction/bids/projects/${projectId}/detailed-estimates/store`;

            $.post(url, {
                _token: $('meta[name="csrf-token"]').attr('content'),
                description: $('#pow_description').val(),
                quantity: $('#pow_quantity').val(),
                unit: $('#pow_unit').val(),
                unit_cost: $('#pow_unit_cost').val(),
                total_cost: $('#pow_total_cost').val()
            }, function () {
                $('#powFormContainer').hide();
                loadPowTable();
            });
        });

    });
    //End Detailed Estimate Module

    //Start Man-Power Requirements Module
    let manTable;

    function loadManTable() {
        if (manTable) manTable.destroy();

        manTable = $('#manTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: `/transaction/bids/projects/${projectId}/manpower`,
            autoWidth: false,
            responsive: true,
            columns: [
                { data: 'type_name' },
                { data: 'quantity' },
                { data: 'task' },
                { data: 'action', orderable: false, searchable: false }
            ]
        });
    }

    $(document).ready(function () {

        $('#btnNewMan').click(function () {
            $('#manFormContainer').toggle();
            $('#manForm')[0].reset();
            $('#man_id').val('');
        });

        // EDIT
        $(document).on('click', '.editManBtn', function () {

            $('#manFormContainer').show();

            $('#man_id').val($(this).data('id'));
            $('#man_power_type_id').val($(this).data('type')).trigger('change');
            $('#man_quantity').val($(this).data('quantity'));
            $('#man_task').val($(this).data('task'));
        });

        // DELETE
        $(document).on('click', '.deleteManBtn', function () {

            let id = $(this).data('id');

            Swal.fire({
                title: 'Delete?',
                text: 'This will permanently delete the record.',
                icon: 'warning',
                showCancelButton: true
            }).then((result) => {
                if (result.isConfirmed) {

                    $.ajax({
                        url: `/transaction/bids/manpower/delete/${id}`,
                        type: 'DELETE',
                        data: {
                            _token: $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function () {
                            loadManTable();
                        }
                    });

                }
            });
        });

        // SAVE
        $('#manForm').submit(function (e) {
            e.preventDefault();

            let id = $('#man_id').val();

            let url = id
                ? `/transaction/bids/manpower/update/${id}`
                : `/transaction/bids/projects/${projectId}/manpower/store`;

            $.post(url, {
                _token: $('meta[name="csrf-token"]').attr('content'),
                man_power_type_id: $('#man_power_type_id').val(),
                quantity: $('#man_quantity').val(),
                task: $('#man_task').val()
            }, function () {
                $('#manFormContainer').hide();
                loadManTable();
            });
        });

    });
    //End Man-Power Requirements Module

    //Start Tools and Equipment Requirement
    let teTable;

    function loadTeTable() {
        if (teTable) teTable.destroy();

        teTable = $('#teTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: `/transaction/bids/projects/${projectId}/tools-equipments`,
            autoWidth: false,
            responsive: true,
            columns: [
                { data: 'name' },
                { data: 'type' },
                { data: 'quantity' },
                { data: 'action', orderable: false, searchable: false }
            ]
        });
    }

    $(document).ready(function () {

        $('#btnNewTe').click(function () {
            $('#teFormContainer').toggle();
            $('#teForm')[0].reset();
            $('#te_id').val('');
        });

        // EDIT
        $(document).on('click', '.editTeBtn', function () {

            $('#teFormContainer').show();

            $('#te_id').val($(this).data('id'));
            $('#tool_equipment_id').val($(this).data('equipment')).trigger('change');
            $('#te_quantity').val($(this).data('quantity'));
        });

        // DELETE
        $(document).on('click', '.deleteTeBtn', function () {

            let id = $(this).data('id');

            Swal.fire({
                title: 'Delete?',
                text: 'This will permanently delete this record.',
                icon: 'warning',
                showCancelButton: true
            }).then((result) => {
                if (result.isConfirmed) {

                    $.ajax({
                        url: `/transaction/bids/tools-equipments-requirement/delete/${id}`,
                        type: 'DELETE',
                        data: {
                            _token: $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function () {
                            loadTeTable();
                        }
                    });

                }
            });
        });

        // SAVE
        $('#teForm').submit(function (e) {
            e.preventDefault();

            let id = $('#te_id').val();

            let url = id
                ? `/transaction/bids/tools-equipments-requirement/update/${id}`
                : `/transaction/bids/projects/${projectId}/tools-equipments/store`;

            $.post(url, {
                _token: $('meta[name="csrf-token"]').attr('content'),
                tool_equipment_id: $('#tool_equipment_id').val(),
                quantity: $('#te_quantity').val()
            }, function () {
                $('#teFormContainer').hide();
                loadTeTable();
            });
        });

    });
    //End Tools and Equipment Requirement

    //Start NFCC Module
    let nfccTable;

    function loadNfccTable() {
        if (nfccTable) nfccTable.destroy();

        nfccTable = $('#nfccTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: `/transaction/bids/projects/${projectId}/nfcc`
            },
            autoWidth: false,
            responsive: true,
            columns: [
                { data: 'name' },
                { data: 'year' },
                { data: 'amount' },
                { data: 'action', orderable: false, searchable: false }
            ]
        });
    }

    $(document).ready(function () {

        $('#btnNewNfcc').click(function () {
            $('#nfccFormContainer').toggle();
            $('#nfccForm')[0].reset();
            $('#nfcc_id').val('');
        });

        // EDIT
        $(document).on('click', '.editNfccBtn', function () {

            $('#nfccFormContainer').show();

            $('#nfcc_id').val($(this).data('id'));
            $('#nfcc_name').val($(this).data('name'));
            $('#nfcc_year').val($(this).data('year'));
            $('#nfcc_amount').val($(this).data('amount'));
        });

        // SAVE
        $('#nfccForm').submit(function (e) {
            e.preventDefault();

            let id = $('#nfcc_id').val();

            let url = id
                ? `/transaction/bids/nfcc/update/${id}`
                : `/transaction/bids/projects/${projectId}/nfcc/store`;

            $.post(url, {
                _token: $('meta[name="csrf-token"]').attr('content'),
                name: $('#nfcc_name').val(),
                year: $('#nfcc_year').val(),
                amount: $('#nfcc_amount').val()
            }, function () {
                $('#nfccFormContainer').hide();
                loadNfccTable();
            });
        });

    });

    $(document).on('click', '.deleteNfccBtn', function () {

    let id = $(this).data('id');

    Swal.fire({
        title: 'Are you sure?',
        text: 'This will permanently delete this record.',
        icon: 'warning',
        showCancelButton: true
    }).then((result) => {
        if (result.isConfirmed) {

            $.ajax({
                url: `/transaction/bids/nfcc/delete/${id}`,
                type: 'DELETE',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                success: function () {
                    loadNfccTable();
                }
            });

        }
    });

    });
    //End NFCC Module
</script>
@endpush
