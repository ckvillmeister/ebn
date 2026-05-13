@extends('index')

@section('content')

<div class="app-page-title">
    <div>
        <h4>{{ isset($data) ? 'Edit Project' : 'Create Project' }}</h4>
    </div>
</div>

<div class="card p-3">
<form method="POST" enctype="multipart/form-data"
      action="{{ isset($data) ? route('projects.update', $data->id) : route('projects.store') }}">

    @csrf

    <div class="row">

        <!-- BASIC INFO -->

        <div class="col-md-12 mb-3">
            <h4>Basic Project Information</h4>
        </div>

        <div class="col-md-6">
            <label>Project Reference No</label>
            <input type="text" name="project_reference_no"
                   value="{{ $data->project_reference_no ?? '' }}"
                   class="form-control" required>
        </div>

        <div class="col-md-6">
            <label>Project Identification No</label>
            <input type="text" name="project_identification_no"
                   value="{{ $data->project_identification_no ?? '' }}"
                   class="form-control" required>
        </div>

        <div class="col-md-6 mt-2">
            <label>Project Name</label>
            <input type="text" name="project_name"
                   value="{{ $data->project_name ?? '' }}"
                   class="form-control" required>
        </div>

        <div class="col-md-6 mt-2">
            <label>Project Cost</label>
            <input type="number" step="0.01" name="project_cost"
                   value="{{ $data->project_cost ?? '' }}"
                   class="form-control" required>
        </div>

        <div class="col-md-6 mt-2">
            <label>Project Type</label>
            <select name="project_type" class="form-control" required>
                <option value="Government" {{ (isset($data) && $data->project_type == 'Government') ? 'selected' : '' }}>
                    Government
                </option>
                <option value="Private" {{ (isset($data) && $data->project_type == 'Private') ? 'selected' : '' }}>
                    Private
                </option>
            </select>
        </div>

        <div class="col-md-12 mt-3"><hr></div>

        <!-- AGENCY INFO -->
        <div class="col-md-12 mb-3">
            <h4>Agency Information (Project Proponent)</h4>
        </div>

        <div class="col-md-6">
            <label>Agency Name</label>
            <input type="text" name="agency_name"
                   value="{{ $data->agency_name ?? '' }}"
                   class="form-control">
        </div>

        <div class="col-md-6">
            <label>Contact No</label>
            <input type="text" name="contact_no"
                   value="{{ $data->contact_no ?? '' }}"
                   class="form-control">
        </div>

        <div class="col-md-6 mt-2">
            <label>Address</label>
            <input type="text" name="address"
                   value="{{ $data->address ?? '' }}"
                   class="form-control">
        </div>

        <div class="col-md-6 mt-2">
            <label>Agency Logo</label>
            <input type="file" name="agency_logo_url" class="form-control">

            @if(isset($data) && $data->agency_logo_url)
                <div class="mt-2">
                    <img src="{{ asset($data->agency_logo_url) }}" width="120">
                </div>
            @endif
        </div>

        <div class="col-md-12 mt-3"><hr></div>

        <div class="col-md-12 mb-3">
            <h4>Project Progress Details</h4>
        </div>
        <!-- WORK DETAILS -->
        <div class="col-md-6">
            <label>Nature of Work</label>
            <textarea name="nature_of_work" class="form-control">{{ $data->nature_of_work ?? '' }}</textarea>
        </div>

        <div class="col-md-6">
            <label>Bidder Role Description</label>
            <textarea name="bidder_role_desc" class="form-control">{{ $data->bidder_role_desc ?? '' }}</textarea>
        </div>

        <div class="col-md-6 mt-2">
            <label>Bidder Role Percent</label>
            <input type="text" name="bidder_role_percent"
                   value="{{ $data->bidder_role_percent ?? '' }}"
                   class="form-control">
        </div>

        <div class="col-md-12 mt-3"></div>

        <!-- DATES -->
        <div class="col-md-4">
            <label>Date Awarded</label>
            <input type="date" name="date_awarded"
                   value="{{ $data->date_awarded ?? '' }}"
                   class="form-control">
        </div>

        <div class="col-md-4">
            <label>Date Started</label>
            <input type="date" name="date_started"
                   value="{{ $data->date_started ?? '' }}"
                   class="form-control">
        </div>

        <div class="col-md-4">
            <label>Date of Completion</label>
            <input type="date" name="date_of_completion"
                   value="{{ $data->date_of_completion ?? '' }}"
                   class="form-control">
        </div>

        <div class="col-md-12 mt-3"></div>

        <!-- PROGRESS -->
        <div class="col-md-6">
            <label>Planned % Accomplishment</label>
            <input type="number" step="0.01"
                   name="percent_accomplishment_planned"
                   value="{{ $data->percent_accomplishment_planned ?? '' }}"
                   class="form-control">
        </div>

        <div class="col-md-6">
            <label>Actual % Accomplishment</label>
            <input type="number" step="0.01"
                   name="percent_accomplishment_actual"
                   value="{{ $data->percent_accomplishment_actual ?? '' }}"
                   class="form-control">
        </div>

        <div class="col-md-6 mt-2">
            <label>Value</label>
            <input type="text" name="value"
                   value="{{ $data->value ?? '' }}"
                   class="form-control">
        </div>

        <div class="col-md-12 mt-3"><hr></div>

        <div class="col-md-12 mb-3">
            <h4>Other Details</h4>
        </div>
        <!-- COMPLIANCE DATES -->
        <div class="col-md-6 mb-2">
            <label>Bid Securing Declaration Date</label>
            <input type="date" name="bid_securing_declaration_date"
                   value="{{ $data->bid_securing_declaration_date ?? '' }}"
                   class="form-control">
        </div>

        <div class="col-md-6 mb-2">
            <label>Omnibus Sworn Statement Date</label>
            <input type="date" name="omnibus_sworn_statement_date"
                   value="{{ $data->omnibus_sworn_statement_date ?? '' }}"
                   class="form-control">
        </div>

        <!-- FINAL CONTRACT FIELDS -->
        <div class="col-md-6">
            <label>Proponent (For Financial Component)</label>
            <input type="text" name="fc_proponent"
                   value="{{ $data->fc_proponent ?? '' }}"
                   class="form-control" required>
        </div>

        <div class="col-md-6">
            <label>Warranty Calendar Days (For Financial Component)</label>
            <input type="text" name="fc_warranty_calendar_days"
                   value="{{ $data->fc_warranty_calendar_days ?? '' }}"
                   class="form-control">
        </div>

        <div class="col-md-6 mt-2">
            <label>Product to be Supplied (For Financial Component)</label>
            <textarea name="fc_product_to_be_supplied"
                      class="form-control">{{ $data->fc_product_to_be_supplied ?? '' }}</textarea>
        </div>

        <div class="col-md-6 mt-2">
            <label>Warranty (For Financial Component)</label>
            <input type="text" name="fc_warranty"
                   value="{{ $data->fc_warranty ?? '' }}"
                   class="form-control">
        </div>

    </div>

    <div class="mt-3">
        <button class="btn btn-primary">
            Save Project
        </button>
    </div>

</form>
</div>

@endsection
