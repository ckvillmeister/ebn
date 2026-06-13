@extends('index')

@section('content')

<div class="app-page-title">
    <div>
        <h4>Project Template Manager</h4>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <a href="{{ route('project-template.create') }}"
           class="btn btn-primary">
            Add Template
        </a>
    </div>


<div class="card-body">

    <table class="table table-bordered">

        <thead>
            <tr>
                <th>ID</th>
                <th>Template Name</th>
                <th width="150">Action</th>
            </tr>
        </thead>

        <tbody>

        @foreach($templates as $template)

            <tr>
                <td>{{ $template->id }}</td>
                <td>{{ $template->template_name }}</td>

                <td>

                    <a href="{{ route('project-template.edit',$template->id) }}"
                       class="btn btn-warning btn-sm">
                        Edit
                    </a>

                    <form
                        action="{{ route('project-template.destroy',$template->id) }}"
                        method="POST"
                        style="display:inline;">

                        @csrf
                        @method('DELETE')

                        <button
                            onclick="return confirm('Delete template?')"
                            class="btn btn-danger btn-sm">

                            Delete

                        </button>

                    </form>

                </td>

            </tr>

        @endforeach

        </tbody>

    </table>

</div>

</div>

@endsection
