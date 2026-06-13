@extends('index')

@section('content')

<form method="POST"
    action="{{ route('project-template.update', $projectTemplate) }}">

@csrf

<div class="card">

    <div class="card-header">
        Update Project Template
    </div>

    <div class="card-body">

        <div class="mb-3">
            <label>Template Name</label>
            <input type="text"
                   name="template_name"
                   value="{{ $projectTemplate->template_name }}"
                   class="form-control"
                   required>
        </div>

        <div class="mb-3">
            <label>System Components</label>
            <textarea id="system_components"
                      name="system_components">{{ $projectTemplate->system_components }}</textarea>
        </div>

        <div class="mb-3">
            <label>After Sales Service & Parts</label>
            <textarea id="service_parts"
                      name="service_parts">{{ $projectTemplate->service_parts }}</textarea>
        </div>

        <div class="mb-3">
            <label>Compliance & Certifications</label>
            <textarea id="certifications"
                      name="certifications">{{ $projectTemplate->certifications }}</textarea>
        </div>

    </div>

    <div class="card-footer">
        <button class="btn btn-success">
            Save Template
        </button>
    </div>

</div>

</form>

<script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/classic/ckeditor.js"></script>

<script>

ClassicEditor.create(
    document.querySelector('#system_components')
);

ClassicEditor.create(
    document.querySelector('#service_parts')
);

ClassicEditor.create(
    document.querySelector('#certifications')
);

</script>

@endsection
