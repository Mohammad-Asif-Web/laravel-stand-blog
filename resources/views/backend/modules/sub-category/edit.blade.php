@extends('backend.layouts.master')

@section('title', 'Sub Category')

@section('sub_title', 'Edit')

@section('content')

<div class="row mt-5">
    <div class="col-lg-6">
        <div class="card bg-primary">
            <div class="card-header d-flex justify-content-between">
                <h4 class="text-white">Edit Sub Category</h4>
                <a href="{{route('sub-category.index')}}" class="btn btn-md btn-dark"> < Back</a>
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

                <form method="post" action="{{route('sub-category.update', $subCategory->id)}}">
                    @csrf
                    @method('PUT') 
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" value="{{$subCategory->name}}" 
                        placeholder="Enter sub category name" class="form-control">
                    <label for="slug" class="mt-2">Slug</label>
                    <input type="text" name="slug" id="slug" value="{{$subCategory->slug}}" 
                        placeholder="Slug name" class="form-control">
                    <label for="category_id" class="mt-2">Select category</label>
                    <select name="category_id" id="category_id" class="form-select" required>
                        @foreach ($categories as $id => $category)
                        @if ($id === $subCategory->category_id){
                            <option value="{{ $id }}" selected>{{$category}}</option>
                        }
                        @endif
                            <option value="{{ $id }}">{{ $category }}</option>
                        @endforeach
                    </select>
                    <label for="order_by" class="mt-2">Sub Category Serial</label>
                    <input type="number" name="order_by" id="order_by" value="{{$subCategory->order_by}}"
                        placeholder="Enter sub category serial" class="form-control">
                    <label for="status" class="mt-2">Sub Category status</label>
                    <select name="status" id="status" class="form-select">
                        @if ($subCategory->status == 1)
                            <option value="1" selected>Active</option> 
                            <option value="0">Inactive</option>
                        @else
                            <option value="0" selected>Inactive</option>
                            <option value="1">Active</option>
                        @endif
                    </select>

                    <button type="submit" class="btn btn-success mt-2">Update Sub Category</button>
                </form>


                {{-- {!! Form::model($subCategory, ['method'=>'put', 'route'=>['sub-category.update', $subCategory->id]]) !!}
                {!! Form::label('name', 'Name') !!}
                {!! Form::text('name', null, ['id'=>'name', 'class'=>'form-control', 'placeholder'=>'Enter sub category name']) !!}
                {!! Form::label('slug', 'Slug', ['class'=>'mt-2']) !!}
                {!! Form::text('slug', null, ['id'=>'slug', 'class'=>'form-control', 'placeholder'=>'slug name']) !!}
                {!! Form::label('category_id', 'Select Category', ['class'=>'mt-2']) !!}
                {!! Form::select('category_id', $categories, null, ['class'=>'form-select', 'placeholder'=>'Select category']) !!}
                {!! Form::label('order_by', 'Sub category serial', ['class'=>'mt-2']) !!}
                {!! Form::number('order_by', null, ['class'=>'form-control', 'placeholder'=>'Enter sub category serial']) !!}
                {!! Form::label('status', 'Sub category status', ['class'=>'mt-2']) !!}
                {!! Form::select('status', [1=>'Active', 0=>'Inactive'], null, ['class'=>'form-select', 'placeholder'=>'Select Status']) !!}
                {!! Form::button('Update Sub Category', ['type'=>'submit', 'class'=>'btn btn-success mt-2']) !!}
                {!! Form::close() !!} --}}

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