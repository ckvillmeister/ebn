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
        <!-- <div class="col-md-6">
            <label>Proponent <b><em>For Financial Component</em></b></label>
            <input type="text" name="fc_proponent"
                   value="{{ $data->fc_proponent ?? '' }}"
                   class="form-control" required>
        </div> -->

        <div class="col-md-6 mt-2">
            <label>Warranty Calendar Days <b><em>For Financial Component</em></b></label>
            <input type="number" name="fc_warranty_calendar_days"
                   value="{{ $data->fc_warranty_calendar_days ?? '' }}"
                   class="form-control">
        </div>

        <div class="col-md-6 mt-2">
            <label>Warranty (in Months) <b><em>For Financial Component</em></b></label>
            <input type="number" name="fc_warranty"
                   value="{{ $data->fc_warranty ?? '' }}"
                   class="form-control">
        </div>

        <div class="col-md-12 mt-2">
            <label>Product to be Supplied <b><em>For Financial Component</em></b></label>
            <textarea name="fc_product_to_be_supplied"
                      class="form-control">{{ $data->fc_product_to_be_supplied ?? '' }}</textarea>
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
