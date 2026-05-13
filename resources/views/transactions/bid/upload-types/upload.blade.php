@extends('index')

@section('content')

<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div class="page-title-icon">
                <i class="pe-7s-safe icon-gradient bg-amy-crisp"></i>
            </div>
            <div>Upload Documents
                <div class="page-title-subheading">
                    Manage uploaded document images
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card p-3 mb-3">

    <form method="POST" action="{{ route('def-doc.upload.store', $document->id) }}" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label>Upload Image (A4 Ratio)</label>
            <input type="file" id="imageInput" class="form-control" required>
            <input type="hidden" name="cropped_image" id="cropped_image">
        </div>

        <div class="mb-3">
            <img id="preview" style="max-width:100%; display:none;">
        </div>

        <button class="btn btn-primary">Upload</button>
        <a class="btn btn-secondary" href="{{ route('default-upload-types') }}">Back</a>
    </form>

</div>

<div class="card p-3">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Preview</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($uploads as $row)
            <tr>
                <td>
                    <img src="{{ asset($row->image_url) }}" width="120">
                </td>
                <td>
                    @if($row->is_active)
                        <span class="badge badge-success">Active</span>
                    @else
                        <span class="badge badge-secondary">Inactive</span>
                    @endif
                </td>
                <td>
                    @if(!$row->is_active)
                    <a href="{{ url('transaction/bids/default-upload-types/uploads/set-active/'.$row->id) }}"
                       class="btn btn-success btn-sm">
                       Set as Active
                    </a>
                    @elseif($row->is_active)
                    <a href="{{ url('transaction/bids/default-upload-types/uploads/set-inactive/'.$row->id) }}"
                       class="btn btn-danger btn-sm">
                       Set as Inactive
                    </a>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection
@push('scripts')
<script>
let cropper;

$('#imageInput').on('change', function(e) {
    let file = e.target.files[0];
    let reader = new FileReader();

    reader.onload = function(event) {
        $('#preview').attr('src', event.target.result).show();

        if (cropper) cropper.destroy();

        cropper = new Cropper(document.getElementById('preview'), {
            aspectRatio: 210 / 297,
            viewMode: 1
        });
    };

    reader.readAsDataURL(file);
});

// OVERRIDE FORM SUBMIT
$('form').submit(function(e) {
    e.preventDefault();

    if (!cropper) {
        alert('Please select image first.');
        return;
    }

    let canvas = cropper.getCroppedCanvas({
        width: 1240,
        height: 1754
    });

    // Preserve original image type
    let file = $('#imageInput')[0].files[0];
    let mimeType = file.type;

    let base64 = canvas.toDataURL(mimeType);

    $.ajax({
        url: $(this).attr('action'),
        method: 'POST',
        data: {
            _token: $('meta[name="csrf-token"]').attr('content'),
            image: base64
        },
        success: function() {
            location.reload();
        }
    });
});
// $('form').submit(function(e) {
//     e.preventDefault();

//     if (!cropper) {
//         alert('Please select image first.');
//         return;
//     }

//     let canvas = cropper.getCroppedCanvas({
//         width: 1240,   // A4 width (scaled)
//         height: 1754   // A4 height (scaled)
//     });

//     let base64 = canvas.toDataURL('image/jpeg');

//     $.ajax({
//         url: $(this).attr('action'),
//         method: 'POST',
//         data: {
//             _token: $('meta[name="csrf-token"]').attr('content'),
//             image: base64
//         },
//         success: function() {
//             location.reload();
//         }
//     });
// });
</script>
@endpush
