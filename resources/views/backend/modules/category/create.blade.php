@extends('backend.layouts.master')

@section('title', 'Category')

@section('sub_title', 'Create')

@section('content')

<div class="row mt-5">
    <div class="col-lg-6">
        <div class="card bg-success">
            <div class="card-header d-flex justify-content-between">
                <h4 class="text-white">Create Category</h4>
                <a href="{{route('category.index')}}" class="btn btn-md btn-primary">Cateogory List</a>
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

                <form method="POST" action="{{route('category.store')}}">
                    @csrf
                    {{-- name --}}
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" placeholder="Enter category name" class="form-control">
                    {{-- slug --}}
                    <label for="slug" class="mt-2">Slug</label>
                    <input type="text" name="slug" id="slug" placeholder="Slug name" class="form-control">
                    {{-- order_by --}}
                    <label for="order_by" class="mt-2">Category Serial</label>
                    <input type="number" name="order_by" id="order_by" placeholder="Enter category serial" class="form-control">
                    {{-- status --}}
                    <label for="status" class="mt-2">Category status</label>
                    <select name="status" id="status" class="form-select">
                        <option>Select Status</option>
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                    </select>

                    <button type="submit" class="btn btn-success mt-2">Create Category</button>
                </form>


                {{-- this is Laravel Collective Form Design --}}
                {{-- {!! Form::open(['method'=>'post', 'route'=>'category.store']) !!}
                {!! Form::label('name', 'Name') !!}
                {!! Form::text('name', null, ['id'=>'name', 'class'=>'form-control', 'placeholder'=>'Enter category name']) !!}
                {!! Form::label('slug', 'Slug', ['class'=>'mt-2']) !!}
                {!! Form::text('slug', null, ['id'=>'slug', 'class'=>'form-control', 'placeholder'=>'slug name']) !!}
                {!! Form::label('order_by', 'Category serial', ['class'=>'mt-2']) !!}
                {!! Form::number('order_by', null, ['class'=>'form-control', 'placeholder'=>'Enter category serial']) !!}
                {!! Form::label('status', 'Category status', ['class'=>'mt-2']) !!}
                {!! Form::select('status', [1=>'Active', 0=>'Inactive'], null, ['class'=>'form-select', 'placeholder'=>'Select Status']) !!}
                {!! Form::button('Create Category', ['type'=>'submit', 'class'=>'btn btn-success mt-2']) !!}
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