@extends('backend.layouts.master')

@section('title', 'Post')

@section('sub_title', 'Create')

@section('content')

<div class="row mt-5">
    <div class="col-lg-6">
        <div class="card bg-success">
            <div class="card-header d-flex justify-content-between">
                <h4 class="text-white">Create Post</h4>
                <a href="{{route('post.index')}}" class="btn btn-md btn-primary">Post List</a>
            </div>
        </div>
    </div>
</div>
<div class="row mt-2">
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

                {{-- <form method="POST" action="{{route('post.store')}}">
                    @csrf
                    <label for="title">Title</label>
                    <input type="text" name="title" id="title" placeholder="Enter post name" class="form-control">
                    <label for="slug" class="mt-2">Slug</label>
                    <input type="text" name="slug" id="slug" placeholder="Slug name" class="form-control">
                    <label for="category_id" class="mt-2">Select post</label>

                    <select name="category_id" id="category_id" class="form-select">
                        <option selected disabled>Select Category</option>
                        @foreach ($categories as $id => $category)
                            <option value="{{ $id }}">{{ $category }}</option>
                        @endforeach
                    </select>

                    <label for="status" class="mt-2">Post status</label>
                    <select name="status" id="status" class="form-select">
                        <option>Select Status</option>
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                    </select>
                    <button type="submit" class="btn btn-success mt-2">Create Post</button>
                </form> --}}

                {{-- this is Laravel Collective Form Design --}}
                {!! Form::open(['method'=>'post', 'route'=>'post.store', 'files'=>true]) !!}
                {!! Form::label('title', 'Title:', ['class'=>'fw-bold']) !!}
                {!! Form::text('title', null, ['id'=>'title', 'class'=>'form-control', 'placeholder'=>'Enter post name']) !!}
                {!! Form::label('slug', 'Slug:', ['class'=>'mt-3 fw-bold']) !!}
                {!! Form::text('slug', null, ['id'=>'slug', 'class'=>'form-control', 'placeholder'=>'slug name']) !!}
                {!! Form::label('status', 'Post status;', ['class'=>'mt-3 fw-bold']) !!}
                {!! Form::select('status', [1=>'Active', 0=>'Inactive'], null, ['class'=>'form-select', 'placeholder'=>'Select Status']) !!}
                <div class="row">
                    <div class="col-md-6">
                        {!! Form::label('category_id', 'Select Category:', ['class'=>'mt-3 fw-bold']) !!}
                        {!! Form::select('category_id', $categories, null, ['id'=>'category_id', 'class'=>'form-select', 'placeholder'=>'Select category']) !!}
                    </div>
                    <div class="col-md-6">
                        {!! Form::label('sub_category_id', 'Select Sub Category:', ['class'=>'mt-3 fw-bold']) !!}
                        {{-- {!! Form::select('sub_category_id', $sub_categories, null, ['id'=>'sub_category_id', 'class'=>'form-select', 'placeholder'=>'Select sub category']) !!} --}}
                        <select name="sub_category_id" id="sub_category_id" class="form-select">
                            
                        </select>
                    </div>
                </div>

                {!! Form::label('description', 'Description:', ['class'=>'mt-3 fw-bold']) !!}
                {!! Form::textarea('description', null, ['class'=>'form-control', 'id'=>'editor']) !!}
               
                {!! Form::label('tag_id', 'Select Tag:', ['class'=>'mt-3 fw-bold']) !!}
                <div class="row">
                    @foreach ($tags as $tag)
                    <div class="col-md-3">
                        {!! Form::checkbox('tag_ids[]', $tag->id, false); !!} <span>{{$tag->name}}</span>
                    </div> 
                    @endforeach
                </div>

                {!! Form::label('photo', 'Select Photo:', ['class'=>'mt-3 fw-bold']) !!}
                {!! Form::file('photo', ['class'=>'form-control']) !!}

                {!! Form::button('Create Post', ['type'=>'submit', 'class'=>'btn btn-success mt-3']) !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>

@push('js')
    <script>
        $('#title').on('input', function(){
            let name = $(this).val();
            let slug = name.replaceAll(' ', '-');
            $('#slug').val(slug.toLowerCase());
        });
    </script>
@endpush

@push('js')
<script src="{{asset('backend/js/axios.min.js')}}"></script>
<script src="https://cdn.ckeditor.com/ckeditor5/41.0.0/classic/ckeditor.js"></script>

<script>

// Ckeditor Rich Text for Description area
    ClassicEditor
    .create( document.querySelector('#editor') )
    .catch( error => {
        console.error( error );
    } );


// get SubCategory by Category dropdown
    // get 'Select' tag element from 'Form'
    let selectElement = $('#sub_category_id');
    // get Category id 
    let categoryId = $('#category_id');
    // get original Domain Name from location
    let domainName = window.location.origin;
    categoryId.on('change', function(){
        let categoryId = $(this).val();
        let subCategoryValues;
        selectElement.empty();
        selectElement.append(`<option>Select Sub Category</option>`)
        axios.get(`${domainName}/dashboard/get-subcategory/${categoryId}`).then(result => {
            subCategoryValues = result.data; 
            subCategoryValues.map(subCategoryItem=>{
                selectElement.append(`<option value="${subCategoryItem.id}">${subCategoryItem.name}</option>`);
            })
        })
    })

</script>
@endpush

@endsection

