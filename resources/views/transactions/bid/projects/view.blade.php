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
                            <i class="fas fa-print mr-2"></i>Technical Components
                        </a>
                    </div>
                    <div class="col-6">
                        <a href="{{ route('projects.print', [$data->id, 'financial']) }}"
                        target="_blank"
                        class="btn btn-success col-12">
                            <i class="fas fa-print mr-2"></i>Financial Components
                        </a>
                    </div>
                </div>
                <div class="row mt-3 mb-3">
                    <div class="col-6">
                        <a href="{{ route('projects.edit', $data->id) }}" class="btn btn-warning col-12"><i class="fas fa-edit mr-2"></i>Edit</a>
                    </div>
                    <div class="col-6">
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
            <!-- <li class="nav-item">
                <a role="tab" class="nav-link active" data-toggle="tab" href="#tab-nfcc">
                    <span>Net Financial</span>
                </a>
            </li> -->
            <li class="nav-item">
                <a role="tab" class="nav-link active" data-toggle="tab" href="#tab-aogpc">
                    <span>TC - All Ongoing Contracts</span>
                </a>
            </li>
            <li class="nav-item">
                <a role="tab" class="nav-link" data-toggle="tab" href="#tab-slcc">
                    <span>TC - Largest Contract</span>
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
            <li class="nav-item">
                <a role="tab" class="nav-link" data-toggle="tab" href="#tab-attachments">
                    <span>Attachments</span>
                </a>
            </li>
        </ul>

        <!-- Tabs Content -->
        <div class="tab-content mt-3">

            <!-- AOGPC -->
            <div class="tab-pane fade show active" id="tab-aogpc" role="tabpanel">
                <div id="aogpc-container">
                    <!-- CRUD UI goes here -->
                    <button class="btn btn-success mb-4" id="btnToggleForm">New</button>

                    <div id="ongoingFormPanel" style="display:none;" class="card card-body mb-3 border">

                        <div class="mb-2">
                            <label><b>Search Existing Record</b></label>
                            <select id="existingSelect" class="form-control"></select>
                            <small class="text-muted">Select existing record or create new</small>
                        </div>

                        <hr>

                        <form id="ongoingForm">

                            <input type="hidden" id="record_id">

                            <div class="row">

                                <div class="col-md-6">
                                    <label>Name of Contract</label>
                                    <input type="text" class="form-control" id="contract_name">
                                </div>

                                <div class="col-md-6">
                                    <label>Project Cost</label>
                                    <input type="number" class="form-control" id="project_cost">
                                </div>

                                <div class="col-md-6 mt-3">
                                    <label>Project Type</label>

                                    <select class="form-control" id="project_type">
                                        <option value="Government">Government</option>
                                        <option value="Private">Private</option>
                                    </select>
                                </div>

                                <div class="col-md-6 mt-3">
                                    <label>Owner Name</label>
                                    <input type="text" class="form-control" id="owner_name">
                                </div>

                                <div class="col-md-12 mt-3">
                                    <label>Address</label>
                                    <input type="text" class="form-control" id="address">
                                </div>

                                <div class="col-md-6 mt-3">
                                    <label>Telephone</label>
                                    <input type="text" class="form-control" id="telephone">
                                </div>

                                <div class="col-md-6 mt-3">
                                    <label>Nature of Work</label>
                                    <input type="text" class="form-control" id="nature">
                                </div>

                                <div class="col-md-6 mt-3">
                                    <label>Role Description</label>
                                    <input type="text" class="form-control" id="role_desc">
                                </div>

                                <div class="col-md-6 mt-3">
                                    <label>Role %</label>
                                    <input type="text" class="form-control" id="role_percent">
                                </div>

                                <div class="col-md-6 mt-3">
                                    <label>Date Awarded</label>
                                    <input type="date" class="form-control" id="date_awarded">
                                </div>

                                <div class="col-md-6 mt-3">
                                    <label>Date Started</label>
                                    <input type="date" class="form-control" id="date_started">
                                </div>

                                <div class="col-md-6 mt-3">
                                    <label>Date Completed</label>
                                    <input type="date" class="form-control" id="date_completed">
                                </div>

                                <div class="col-md-6 mt-3">
                                    <label>Percentage Planned</label>
                                    <input type="text" class="form-control" id="planned">
                                </div>

                                <div class="col-md-6 mt-3">
                                    <label>Percentage Actual</label>
                                    <input type="text" class="form-control" id="actual">
                                </div>

                                <div class="col-md-6 mt-3">
                                    <label>Outstanding Works</label>
                                    <input type="text" class="form-control" id="outstanding">
                                </div>

                            </div>

                            <div class="mt-3">
                                <button type="submit" class="btn btn-success">
                                    Save Record
                                </button>

                                <button type="button" class="btn btn-secondary" id="btnCancelForm">
                                    Cancel
                                </button>
                            </div>

                        </form>

                    </div>

                    <table class="table" id="ongoingTable">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Cost</th>
                                <th>Owner</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>

            <!-- SLCC -->
            <div class="tab-pane fade" id="tab-slcc" role="tabpanel">
                <div id="slcc-container">
                    <!-- CRUD UI goes here -->
                    <button class="btn btn-success mb-4" id="btnToggleSlccForm">New</button>

                    <div id="slccFormPanel" style="display:none;" class="card card-body mb-3 border">

                        <div class="mb-2">
                            <label><b>Search Existing Record</b></label>

                            <select id="existingSlccSelect" class="form-control">
                                <option value="">-- Select Existing --</option>
                            </select>

                            <small class="text-muted">
                                Select existing record or create new
                            </small>
                        </div>

                        <hr>

                        <form id="slccForm">

                            <input type="hidden" id="slcc_record_id">

                            <div class="row">

                                <div class="col-md-6">
                                    <label>Name of Contract</label>
                                    <input type="text" class="form-control" id="slcc_contract_name">
                                </div>

                                <div class="col-md-6">
                                    <label>Project Cost</label>
                                    <input type="number" class="form-control" id="slcc_project_cost">
                                </div>

                                <div class="col-md-6 mt-3">
                                    <label>Project Type</label>

                                    <select class="form-control" id="slcc_project_type">
                                        <option value="Government">Government</option>
                                        <option value="Private">Private</option>
                                    </select>
                                </div>

                                <div class="col-md-6 mt-3">
                                    <label>Owner Name</label>
                                    <input type="text" class="form-control" id="slcc_owner_name">
                                </div>

                                <div class="col-md-12 mt-3">
                                    <label>Address</label>
                                    <input type="text" class="form-control" id="slcc_address">
                                </div>

                                <div class="col-md-6 mt-3">
                                    <label>Telephone No.</label>
                                    <input type="text" class="form-control" id="slcc_telephone">
                                </div>

                                <div class="col-md-6 mt-3">
                                    <label>Nature of Work</label>
                                    <input type="text" class="form-control" id="slcc_nature">
                                </div>

                                <div class="col-md-6 mt-3">
                                    <label>Bidder Role Description</label>
                                    <input type="text" class="form-control" id="slcc_role_desc">
                                </div>

                                <div class="col-md-6 mt-3">
                                    <label>Bidder Role Percentage</label>
                                    <input type="text" class="form-control" id="slcc_role_percent">
                                </div>

                                <div class="col-md-6 mt-3">
                                    <label>Amount of Award</label>
                                    <input type="number" class="form-control" id="slcc_award">
                                </div>

                                <div class="col-md-6 mt-3">
                                    <label>Amount of Completion</label>
                                    <input type="number" class="form-control" id="slcc_completion">
                                </div>

                                <div class="col-md-6 mt-3">
                                    <label>Duration</label>
                                    <input type="text" class="form-control" id="slcc_duration">
                                </div>

                                <div class="col-md-6 mt-3">
                                    <label>Date Awarded</label>
                                    <input type="date" class="form-control" id="slcc_date_awarded">
                                </div>

                                <div class="col-md-6 mt-3">
                                    <label>Contract Effectivity</label>
                                    <input type="date" class="form-control" id="slcc_effectivity">
                                </div>

                                <div class="col-md-6 mt-3">
                                    <label>Date Completed</label>
                                    <input type="date" class="form-control" id="slcc_date_completed">
                                </div>

                            </div>

                            <div class="mt-3">
                                <button type="submit" class="btn btn-success">
                                    Save Record
                                </button>

                                <button type="button" class="btn btn-secondary" id="btnCancelSlccForm">
                                    Cancel
                                </button>
                            </div>

                        </form>

                    </div>

                    <table class="table" id="slccTable">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Owner</th>
                                <th>Type</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>

            <!-- DELIVERY SCHEDULE -->
            <div class="tab-pane fade" id="tab-delivery" role="tabpanel">
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
            <!-- <div class="tab-pane fade" id="tab-nfcc" role="tabpanel">
                <div id="nfcc-container">
                <div>

                    <div class="mb-4">
                        <button class="btn btn-success btn-sm" id="btnNewNfcc"><i class="fas fa-plus mr-2"></i>New</button>
                    </div>

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
            </div> -->

            <!-- DELIVERY SCHEDULE -->
            <div class="tab-pane" id="tab-attachments" role="tabpanel">
                <div id="attachments">
                    <!-- CRUD UI goes here -->
                    <div class="card p-3">

                        <form id="attachmentForm">

                            <div class="form-group">
                                <label>Attachment Type</label>

                                <select class="form-control" id="attachment_type">
                                    @foreach(App\Enums\BidDocAttachmentTypes::$attachmentTypes as $key => $value)
                                        <option value="{{ $key }}">
                                            {{ $value }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Select Image</label>

                                <input type="file"
                                    id="attachment_image"
                                    class="form-control"
                                    accept="image/png,image/jpeg">
                            </div>

                            <div class="mt-3 mb-3 text-center">

                                <img id="previewImage"
                                    style="max-width:100%; display:none;">

                            </div>

                            <button type="submit" class="btn btn-primary">
                                Upload
                            </button>

                        </form>

                        <div class="row mt-3">

                            @foreach($attachments as $attachment)

                                <div class="col-md-3 mb-3">

                                    <div class="card p-2">

                                        <img src="{{ asset($attachment->image_url) }}"
                                            style="width:100%; height:250px; object-fit:cover;">

                                        <div class="mt-2">
                                            <b>
                                                {{ App\Enums\BidDocAttachmentTypes::$attachmentTypes[$attachment->attachment_type] ?? '' }}
                                            </b>
                                        </div>

                                        <button class="btn btn-danger btn-sm mt-2 deleteAttachmentBtn"
                                                data-id="{{ $attachment->id }}">
                                            Delete
                                        </button>

                                    </div>

                                </div>

                            @endforeach

                            </div>

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
        aogpc: false,
        delivery: false,
        pow: false,
        manpower: false,
        tools: false
    };

    $(function () {
        initTabFix();

    loadTable();
    loadPowTable();
    loadManTable();
    loadTeTable();
    loadNfccTable();
    loadAllOngoingProjects();
    loadAllOngoingProjectsDropdown()
    loadSlccTable();
    loadSlccDropdown();

    loadedTabs.aogpc = true;
    loadedTabs.delivery = true;
    loadedTabs.pow = true;
    loadedTabs.manpower = true;
    loadedTabs.tools = true;
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

    //loadTable();

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

    //Start Project Attachments
    let cropper;

    $('#attachment_image').change(function(e) {

        let file = e.target.files[0];

        if (!file) return;

        let reader = new FileReader();

        reader.onload = function(event) {

            $('#previewImage')
                .attr('src', event.target.result)
                .show();

            if (cropper) {
                cropper.destroy();
            }

            cropper = new Cropper(
                document.getElementById('previewImage'),
                {
                    aspectRatio: 210 / 297, // A4 ratio
                    viewMode: 1
                }
            );

        };

        reader.readAsDataURL(file);

    });

    $('#attachmentForm').submit(function(e) {

        e.preventDefault();

        if (!cropper) {

            alert('Please select image.');

            return;
        }

        let canvas = cropper.getCroppedCanvas({

            width: 1240,
            height: 1754

        });

        // DETECT ORIGINAL EXTENSION
        let file = $('#attachment_image')[0].files[0];

        let mimeType = file.type;

        let base64 = canvas.toDataURL(mimeType);

        $.ajax({

            url: '/transaction/bids/projects/{{ $data->id }}/attachments/store',

            method: 'POST',

            data: {

                _token: $('meta[name="csrf-token"]').attr('content'),

                attachment_type: $('#attachment_type').val(),

                image: base64

            },

            success: function() {

                location.reload();

            }

        });

    });


    $(document).on('click', '.deleteAttachmentBtn', function(){

        let id = $(this).data('id');

        Swal.fire({
            title: 'Delete attachment?',
            icon: 'warning',
            showCancelButton: true
        }).then((result) => {

            if(result.isConfirmed){

                $.ajax({
                    url: `/transaction/bids/projects/attachments/delete/${id}`,
                    type: 'DELETE',
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(){
                        location.reload();
                    }
                });

            }

        });

        });
    //End Project Attachments
    //let projectId = "{{ $data->id }}";

    /* =======================
    ONGOING TABLE
    ======================= */
    let ongoingTable;

    $('#btnToggleForm').click(function () {
        $('#ongoingFormPanel').slideToggle();
    });

    $('#btnCancelForm').click(function () {
        $('#ongoingFormPanel').slideUp();
        $('#ongoingForm')[0].reset();
        $('#record_id').val('');
    });

    function loadAllOngoingProjects(){
        ongoingTable = $('#ongoingTable').DataTable({
            processing: true,
            serverSide: true,
            autoWidth: false,
            ajax: `/transaction/bids/projects/${projectId}/ongoing/list`,
            columns: [
                { data: 'name_of_contract' },
                { data: 'project_cost' },
                { data: 'owner_name' },
                { data: 'action', orderable:false }
            ]
        });

        setTimeout(() => ongoingTable.columns.adjust(), 150);
    }

    function loadAllOngoingProjectsDropdown() {
        $.get(`/transaction/bids/projects/ongoing/search/all`, function (res) {

            $('#existingSelect').html(`<option value="">-- Select Existing --</option>`);

            res.forEach(r => {
                $('#existingSelect').append(`
                    <option value="${r.id}">
                        ${r.name_of_contract} - ${r.owner_name}
                    </option>
                `);
            });

        });
    }

    $('#existingSelect').on('change', function () {

        let id = $(this).val();
        if (!id) return;

        $.get(`/transaction/bids/projects/ongoing/show/${id}`, function (data) {
            $('#record_id').val('');
            // $('#record_id').val(data.id);
            $('#contract_name').val(data.name_of_contract);
            $('#project_cost').val(data.project_cost);
            $('#project_type').val(data.project_type);
            $('#owner_name').val(data.owner_name);
            $('#address').val(data.address);
            $('#telephone').val(data.telephone_no);
            $('#nature').val(data.nature_of_work);
            $('#role_desc').val(data.bidder_role_description);
            $('#role_percent').val(data.bidder_role_percentage);
            $('#date_awarded').val(data.date_awarded);
            $('#date_started').val(data.date_started);
            $('#date_completed').val(data.date_of_completion);
            $('#planned').val(data.percent_planned);
            $('#actual').val(data.percent_actual);
            $('#outstanding').val(data.outstanding_works_value);

            $('#ongoingFormPanel').slideDown();

        });

    });

    // EDIT BUTTON
    $(document).on('click', '.editOngoing', function () {

    let id = $(this).data('id');

    $.get(`/transaction/bids/projects/ongoing/show/${id}`, function (data) {

        // show form
        $('#ongoingFormPanel').slideDown();

        // set hidden id
        $('#record_id').val(data.id);

        // fill fields
        $('#contract_name').val(data.name_of_contract);
        $('#project_cost').val(data.project_cost);
        $('#owner_name').val(data.owner_name);
        $('#project_type').val(data.project_type);
        $('#address').val(data.address);
        $('#telephone').val(data.telephone_no);
        $('#nature').val(data.nature_of_work);
        $('#role_desc').val(data.bidder_role_description);
        $('#role_percent').val(data.bidder_role_percentage);
        $('#date_awarded').val(data.date_awarded);
        $('#date_started').val(data.date_started);
        $('#date_completed').val(data.date_of_completion);
        $('#planned').val(data.planned_percentage);
        $('#actual').val(data.actual_percentage);
        $('#outstanding').val(data.outstanding_works);

    });

    });

    $('#ongoingForm').submit(function (e) {
        e.preventDefault();

        $.post(`/transaction/bids/projects/${projectId}/ongoing/store`, {
            _token: $('meta[name="csrf-token"]').attr('content'),
            id: $('#record_id').val(),
            project_id: projectId,
            name_of_contract: $('#contract_name').val(),
            project_cost: $('#project_cost').val(),
            project_type: $('#project_type').val(),
            owner_name: $('#owner_name').val(),
            address: $('#address').val(),
            telephone_no: $('#telephone').val(),
            nature_of_work: $('#nature').val(),
            bidder_role_description: $('#role_desc').val(),
            bidder_role_percentage: $('#role_percent').val(),
            date_awarded: $('#date_awarded').val(),
            date_started: $('#date_started').val(),
            date_of_completion: $('#date_completed').val(),
            planned_percentage: $('#planned').val(),
            actual_percentage: $('#actual').val(),
            outstanding_works: $('#outstanding').val()

        }, function () {

            $('#ongoingFormPanel').slideUp();
            $('#ongoingForm')[0].reset();
            $('#record_id').val('');

            ongoingTable.ajax.reload();
            loadAllOngoingProjectsDropdown();

        });

    });

    /* DELETE ONGOING */
    $(document).on('click', '.deleteOngoing', function () {

        let id = $(this).data('id');

        $.ajax({
            url: `/transaction/bids/projects/ongoing/delete/${id}`,
            type: 'DELETE',
            data: { _token: $('meta[name="csrf-token"]').attr('content') },
            success: function () {
                ongoingTable.ajax.reload();
            }
        });

    });


    /* =======================
    SINGLE TABLE
    ======================= */
    let singleTable;

    function loadSingleLargestContracts(){
        singleTable = $('#singleTable').DataTable({
            processing: true,
            serverSide: true,
            autoWidth: false,
            ajax: `/transaction/bids/projects/${projectId}/single/list`,
            columns: [
                { data: 'name_of_contract' },
                { data: 'project_cost' },
                { data: 'owner_name' },
                { data: 'action', orderable:false }
            ]
        });

        setTimeout(() => singleTable.columns.adjust(), 150);
    }

    /* ADD SINGLE */
    $('#btnAddSingle').click(function () {

        $.post(`/transaction/bids/projects/${projectId}/single/store`, {
            _token: $('meta[name="csrf-token"]').attr('content'),
            name_of_contract: prompt("Contract Name"),
            project_cost: prompt("Cost"),
            owner_name: prompt("Owner")
        }, function () {

            singleTable.ajax.reload();

        });

    });

    /* DELETE SINGLE */
    $(document).on('click', '.deleteSingle', function () {

        let id = $(this).data('id');

        $.ajax({
            url: `/transaction/bids/projects/single/delete/${id}`,
            type: 'DELETE',
            data: { _token: $('meta[name="csrf-token"]').attr('content') },
            success: function () {
                singleTable.ajax.reload();
            }
        });

    });

    //SLCC
    let slccTable;

    $('#btnToggleSlccForm').click(function () {
        $('#slccFormPanel').slideToggle();
    });

    $('#btnCancelSlccForm').click(function () {

        $('#slccFormPanel').slideUp();

        $('#slccForm')[0].reset();

        $('#slcc_record_id').val('');

    });

    function loadSlccTable(){

        slccTable = $('#slccTable').DataTable({
            processing: true,
            serverSide: true,
            autoWidth: false,
            ajax: `/transaction/bids/projects/${projectId}/slcc/list`,
            columns: [
                { data: 'name_of_contract' },
                { data: 'owner_name' },
                { data: 'project_type' },
                { data: 'action', orderable:false }
            ]
        });

        setTimeout(() => slccTable.columns.adjust(), 150);
    }

    function loadSlccDropdown() {

        $.get(`/transaction/bids/projects/slcc/search/all`, function (res) {

            $('#existingSlccSelect').html(`
                <option value="">-- Select Existing --</option>
            `);

            res.forEach(r => {

                $('#existingSlccSelect').append(`
                    <option value="${r.id}">
                        ${r.name_of_contract} - ${r.owner_name}
                    </option>
                `);

            });

        });

    }

    $('#existingSlccSelect').on('change', function () {

        let id = $(this).val();

        if (!id) return;

        $.get(`/transaction/bids/projects/slcc/show/${id}`, function (data) {

            $('#slcc_record_id').val(data.id);

            $('#slcc_contract_name').val(data.name_of_contract);
            $('#slcc_project_cost').val(data.project_cost);
            $('#slcc_project_type').val(data.project_type);
            $('#slcc_owner_name').val(data.owner_name);
            $('#slcc_address').val(data.address);
            $('#slcc_telephone').val(data.telephone_no);
            $('#slcc_nature').val(data.nature_of_work);
            $('#slcc_role_desc').val(data.bidder_role_description);
            $('#slcc_role_percent').val(data.bidder_role_percentage);
            $('#slcc_award').val(data.amount_of_award);
            $('#slcc_completion').val(data.amount_of_completion);
            $('#slcc_duration').val(data.duration);
            $('#slcc_date_awarded').val(data.date_awarded);
            $('#slcc_effectivity').val(data.contract_effectivity);
            $('#slcc_date_completed').val(data.date_completed);

            $('#slccFormPanel').slideDown();

        });

    });

    $(document).on('click', '.editSlcc', function () {

        let id = $(this).data('id');

        $.get(`/transaction/bids/projects/slcc/show/${id}`, function (data) {

            $('#slccFormPanel').slideDown();

            $('#slcc_record_id').val(data.id);

            $('#slcc_contract_name').val(data.name_of_contract);
            $('#slcc_project_cost').val(data.project_cost);
            $('#slcc_project_type').val(data.project_type);
            $('#slcc_owner_name').val(data.owner_name);
            $('#slcc_address').val(data.address);
            $('#slcc_telephone').val(data.telephone_no);
            $('#slcc_nature').val(data.nature_of_work);
            $('#slcc_role_desc').val(data.bidder_role_description);
            $('#slcc_role_percent').val(data.bidder_role_percentage);
            $('#slcc_award').val(data.amount_of_award);
            $('#slcc_completion').val(data.amount_of_completion);
            $('#slcc_duration').val(data.duration);
            $('#slcc_date_awarded').val(data.date_awarded);
            $('#slcc_effectivity').val(data.contract_effectivity);
            $('#slcc_date_completed').val(data.date_completed);

        });

    });

    $('#slccForm').submit(function (e) {

        e.preventDefault();

        $.post(`/transaction/bids/projects/${projectId}/slcc/store`, {

            _token: $('meta[name="csrf-token"]').attr('content'),

            project_id: projectId,

            id: $('#slcc_record_id').val(),

            name_of_contract: $('#slcc_contract_name').val(),
            project_cost: $('#slcc_project_cost').val(),
            project_type: $('#slcc_project_type').val(),
            owner_name: $('#slcc_owner_name').val(),
            address: $('#slcc_address').val(),
            telephone_no: $('#slcc_telephone').val(),
            nature_of_work: $('#slcc_nature').val(),
            bidder_role_description: $('#slcc_role_desc').val(),
            bidder_role_percentage: $('#slcc_role_percent').val(),
            amount_of_award: $('#slcc_award').val(),
            amount_of_completion: $('#slcc_completion').val(),
            duration: $('#slcc_duration').val(),
            date_awarded: $('#slcc_date_awarded').val(),
            contract_effectivity: $('#slcc_effectivity').val(),
            date_completed: $('#slcc_date_completed').val()

        }, function () {

            $('#slccFormPanel').slideUp();

            $('#slccForm')[0].reset();

            $('#slcc_record_id').val('');

            slccTable.ajax.reload();

            loadSlccDropdown();

        });

    });

    $(document).on('click', '.deleteSlcc', function () {

        let id = $(this).data('id');

        $.ajax({
            url: `/transaction/bids/projects/slcc/delete/${id}`,
            type: 'DELETE',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function () {

                slccTable.ajax.reload();

            }
        });

    });
</script>
@endpush
