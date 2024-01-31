@extends('backend.layouts.master')

@section('title', 'Tag')
Target class [App\Http\Controllers\TagController] does not exist.
@section('sub_title', 'Create')

@section('content')

<div class="row mt-5">
    <div class="col-lg-6">
        <div class="card bg-success">
            <div class="card-header d-flex justify-content-between">
                <h4 class="text-white">Create Tag</h4>
                <a href="{{route('tag.index')}}" class="btn btn-md btn-primary">Tag List</a>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{$error}}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{route('tag.store')}}">
                    @csrf
                    {{-- name --}}
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" placeholder="Enter tag name" class="form-control">
                    {{-- slug --}}
                    <label for="slug" class="mt-2">Slug</label>
                    <input type="text" name="slug" id="slug" placeholder="Slug name" class="form-control">
                    {{-- order_by --}}
                    <label for="order_by" class="mt-2">Tag Serial</label>
                    <input type="number" name="order_by" id="order_by" placeholder="Enter tag serial" class="form-control">
                    {{-- status --}}
                    <label for="status" class="mt-2">Tag status</label>
                    <select name="status" id="status" class="form-select">
                        <option>Select Status</option>
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                    </select>

                    <button type="submit" class="btn btn-success mt-2">Create Tag</button>
                </form>

            </div>
        </div>
    </div>
</div>

@push('js')
    <script>
        $('#name').on('input', function(){
            let name = $(this).val();
            let slug = name.replaceAll(' ', '-');
            $('#slug').val(slug.toLowerCase());
        });
    </script>
@endpush

@endsection