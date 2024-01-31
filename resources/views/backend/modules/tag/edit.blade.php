@extends('backend.layouts.master')

@section('title', 'Tag')

@section('sub_title', 'Edit')

@section('content')

<div class="row mt-5">
    <div class="col-lg-6">
        <div class="card bg-primary">
            <div class="card-header d-flex justify-content-between">
                <h4 class="text-white">Edit Tag</h4>
                <a href="{{route('tag.index')}}" class="btn btn-md btn-dark"> < Back</a>
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

                <form method="post" action="{{route('tag.update', $tag->id)}}">
                    @csrf
                    @method('PUT') 

                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" value="{{$tag->name}}" 
                        placeholder="Enter tag name" class="form-control">
                    
                    <label for="slug" class="mt-2">Slug</label>
                    <input type="text" name="slug" id="slug" value="{{$tag->slug}}" 
                        placeholder="Slug name" class="form-control">
                    
                    <label for="order_by" class="mt-2">Category Serial</label>
                    <input type="number" name="order_by" id="order_by" value="{{$tag->order_by}}"
                        placeholder="Enter tag serial" class="form-control">

                    <label for="status" class="mt-2">Category status</label>
                    <select name="status" id="status" class="form-select">
                        @if ($tag->status == 1)
                            <option value="1" selected>Active</option> 
                            <option value="0">Inactive</option>
                        @else
                            <option value="0" selected>Inactive</option>
                            <option value="1">Active</option>
                        @endif
                    </select>

                    <button type="submit" class="btn btn-success mt-2">Update Tag</button>
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