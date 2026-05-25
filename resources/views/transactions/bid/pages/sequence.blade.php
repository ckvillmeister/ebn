@extends('index')
@push('css')
<link rel="stylesheet"
href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
<style>
    .ui-state-highlight {
        height: 60px;
        border: 2px dashed #999;
        margin-bottom: 10px;
        background: #f1f1f1;
    }
</style>
@endpush
@section('content')

<div class="app-page-title">
    <div class="page-title-heading">

        <div class="page-title-icon">
            <i class="pe-7s-note2 icon-gradient bg-amy-crisp"></i>
        </div>

        <div>
            Page Sequencing

            <div class="page-title-subheading">
                Drag pages to change print order
            </div>
        </div>

    </div>
</div>

<div class="card p-4">

    <div class="row mb-4">

        <div class="col-md-4">

            <label>
                <b>Component Type</b>
            </label>

            <select class="form-control" id="component_type">

                <option value="Technical Components"
                    {{ $componentType == 'Technical Components' ? 'selected' : '' }}>
                    Technical Components
                </option>

                <option value="Financial Components"
                    {{ $componentType == 'Financial Components' ? 'selected' : '' }}>
                    Financial Components
                </option>

            </select>

        </div>

    </div>

    <div id="sortablePages">

        @foreach($pages as $page)

        <div class="card mb-2 sortable-item"
            data-id="{{ $page->id }}"
            style="cursor: move;">

            <div class="card-body d-flex justify-content-between align-items-center">

                <div>
                    <b>{{ $page->order }}.</b>
                    {{ $page->page_name }}
                </div>

                <div>
                    <i class="pe-7s-menu fa-2x"></i>
                </div>

            </div>

        </div>

        @endforeach

    </div>

    <button class="btn btn-success mt-3" id="btnSaveSequence">
        Save Sequence
    </button>

</div>

@endsection

@push('scripts')

<!-- JQuery UI -->
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
<script>
$(document).ready(function () {

    $('#sortablePages').sortable({
        placeholder: 'ui-state-highlight'
    });

    // CHANGE COMPONENT TYPE
    $('#component_type').change(function () {
        let type = $(this).val();

        window.location =
            `?component_type=${encodeURIComponent(type)}`;

    });

    // SAVE ORDER
    $('#btnSaveSequence').click(function () {

        let pages = [];

        $('.sortable-item').each(function () {

            pages.push($(this).data('id'));

        });

        $.post(
            `/transaction/bids/pages/sequencing/update`,
            {
                _token: $('meta[name="csrf-token"]').attr('content'),
                pages: pages
            },
            function () {

                location.reload();

            }
        );

    });

});

</script>

@endpush
