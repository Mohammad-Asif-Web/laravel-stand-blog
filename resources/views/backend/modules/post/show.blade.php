@extends('backend.layouts.master')

@section('title', 'Post')

@section('sub_title', 'Show single data')

@section('content')

<div class="row mt-5">
    {{-- post --}}
    <div class="col-lg-6">
        <div class="row">
            <div class="col-lg-12">
                <div class="card bg-primary">
                    <div class="card-header d-flex justify-content-between bg-primary p-2">
                        <h4 class="text-white">Post Details</h4>
                        <a href="{{route('post.index')}}" class="btn btn-md btn-dark"> < Back</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <table class="table table-responive table-striped table-bordered table-hover">
                            <tbody>
                                @php
                                    $sl = 1;
                                @endphp
                                <tr>
                                    <th>SL No.</th>
                                    <td>{{$sl++}}</td>
                                </tr>
                                <tr>
                                    <th>Title</th>
                                    <td>{{$post->title}}</td>
                                </tr>
                                <tr>
                                    <th>Slug</th>
                                    <td>{{$post->slug}}</td>
                                </tr>
                                <tr>
                                    <th>Status</th>
                                    <td>{{$post->status == 1 ? 'Active' : 'Inactive'}}</td>
                                </tr>
                                <tr>
                                    <th>Is Approved</th>
                                    <td>{{$post->is_approved == 1 ? 'Approved' : 'Not Approved'}}</td>
                                </tr>
                                <tr>
                                    <th>Description</th>
                                    <th>{!! $post->description !!}</th>
                                </tr>
                                <tr>
                                    <th>Admin Comment</th>
                                    <td>{{$post->admin_comment}}</td>
                                </tr>
                                
                                <tr>
                                    <th>Created At</th>
                                    <td>{{$post->created_at->toDayDateTimeString()}}</td>
                                </tr>
                                <tr>
                                    <th>Updated At</th>
                                    <td>{{$post->created_at == $post->updated_at ? 'Not Updated' : $post->updated_at->toDayDateTimeString()}}</td>
                                </tr>
                                <tr>
                                    <th>Deleted At</th>
                                    <td>{{$post->deleted_at == Null ? 'Not Deleted' : toDayDateTimeString()}}</td>
                                </tr>
                                <tr>
                                    <th>Photo</th>
                                    <td><img src="{{url('images/thumbnail/'.$post->photo)}}"
                                        data-src="{{url('images/original/'.$post->photo)}}"
                                         class="post-img" alt="post_img">
                                    </td>
                                </tr>
                                <tr>
                                    <th>Tags</th>
                                    <td>
                                        @php
                                        $classes = ['btn-success', 'btn-danger', 'btn-warning', 'btn-info', 'btn-primary', 'btn-secondary'];
                                        @endphp
                                        @foreach ($post->tag as $tag)
                                        <a href="{{route('tag.show', $tag->id)}}" 
                                            class="btn btn-sm {{$classes[rand(0,5)]}} mb-1">{{$tag->name}}</a>
                                        @endforeach
                                    </td>
                                </tr>
        
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-lg-6">
        {{-- cateogory --}}
        <div class="row">
            <div class="col-lg-12">
                <div class="card bg-primary">
                    <div class="card-header d-flex justify-content-between bg-primary p-2">
                        <h4 class="text-white">Category Details</h4>
                        <a href="{{route('category.show', $post->category_id)}}" class="btn btn-md btn-dark"> < Details</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <table class="table table-responive table-striped table-bordered table-hover">
                            <tbody>
                                <tr>
                                    <th>ID</th>
                                    <td>{{$post->category->id}}</td>
                                </tr>
                                <tr>
                                    <th>Name</th>
                                    <td>{{$post->category->name}}</td>
                                </tr>
                                <tr>
                                    <th>Slug</th>
                                    <td>{{$post->category->slug}}</td>
                                </tr>
                                <tr>
                                    <th>Order By</th>
                                    <td>{{$post->category->order_by}}</td>
                                </tr>
                                <tr>
                                    <th>Status</th>
                                    <td>{{$post->category->status == 1 ? 'Active' : 'Inactive'}}</td>
                                </tr>
                                <tr>
                                    <th>Created At</th>
                                    <td>{{$post->category->created_at->toDayDateTimeString()}}</td>
                                </tr>
                                <tr>
                                    <th>Updated At</th>
                                    <td>{{$post->category->created_at == $post->category->updated_at ? 'Not Updated' : $post->category->updated_at->toDayDateTimeString()}}</td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div> 
        {{-- Sub cateogory --}}
        <div class="row mt-4">
            <div class="col-lg-12">
                <div class="card bg-primary">
                    <div class="card-header d-flex justify-content-between bg-primary p-2">
                        <h4 class="text-white">Sub Category Details</h4>
                        <a href="{{route('sub-category.show', $post->sub_category_id)}}" class="btn btn-md btn-dark"> < Details</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <table class="table table-responive table-striped table-bordered table-hover">
                            <tbody>
                                <tr>
                                    <th>ID</th>
                                    <td>{{$post->subCategory->id}}</td>
                                </tr>
                                <tr>
                                    <th>Name</th>
                                    <td>{{$post->subCategory->name}}</td>
                                </tr>
                                <tr>
                                    <th>Slug</th>
                                    <td>{{$post->subCategory->slug}}</td>
                                </tr>
                                <tr>
                                    <th>Order By</th>
                                    <td>{{$post->subCategory->order_by}}</td>
                                </tr>
                                <tr>
                                    <th>Status</th>
                                    <td>{{$post->subCategory->status == 1 ? 'Active' : 'Inactive'}}</td>
                                </tr>
                                <tr>
                                    <th>Created At</th>
                                    <td>{{$post->subCategory->created_at->toDayDateTimeString()}}</td>
                                </tr>
                                <tr>
                                    <th>Updated At</th>
                                    <td>{{$post->subCategory->created_at == $post->subCategory->updated_at ? 'Not Updated' : $post->subCategory->updated_at->toDayDateTimeString()}}</td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>      
        {{-- User Details --}}
        <div class="row mt-4">
            <div class="col-lg-12">
                <div class="card bg-primary">
                    <div class="card-header bg-primary p-2">
                        <h4 class="text-white">User Details</h4>
                        {{-- <a href="" class="btn btn-md btn-dark"> < Details</a> --}}
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <table class="table table-responive table-striped table-bordered table-hover">
                            <tbody>
                                <tr>
                                    <th>ID</th>
                                    <td>{{$post->user->id}}</td>
                                </tr>
                                <tr>
                                    <th>Name</th>
                                    <td>{{$post->user->name}}</td>
                                </tr>
                                <tr>
                                    <th>Email</th>
                                    <td>{{$post->user->email}}</td>
                                </tr>
                                <tr>
                                    <th>Created At</th>
                                    <td>{{$post->user->created_at->toDayDateTimeString()}}</td>
                                </tr>
                                <tr>
                                    <th>Updated At</th>
                                    <td>{{$post->user->created_at == $post->user->updated_at ? 'Not Updated' : $post->user->updated_at->toDayDateTimeString()}}</td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>      


    </div>
</div>







@push('js')

@endpush

@endsection