@extends('backend.layouts.master')

@section('title', 'Post')

@section('sub_title', 'List')

@section('content')

<div class="row mt-5">
    <div class="col-lg-8">
        <div class="card bg-primary">
            <div class="card-header d-flex justify-content-between bg-primary p-2">
                <h4 class="text-white">Post List</h4>
                <a href="{{route('post.create')}}" class="btn btn-md btn-success "> Add New Post</a>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-body">
                <table class="table table-responive table-striped table-bordered table-hover post-table">
                    <thead>
                        <tr>
                            <th>Sl</th>
                            <th>
                                <span>Title</span><hr>
                                <span>Slug</span>
                            </th>
                            <th>
                                <span>Category</span><hr>
                                <span>Sub Category</span>
                            </th>
                            <th>
                                <span>Status</span><hr>
                                <span>Is Approved</span>
                            </th>
                            <th>Photo</th>
                            <th>Tags</th>
                            <th>
                                <span>Created At</span><hr>
                                <span>Updated At</span><hr>
                                <span>Created By</span>
                            </th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (!empty($posts->count()))
                            @php
                                $sl = 1
                            @endphp
                            @foreach ($posts as $post)
                            <tr>
                                <td class="sl">{{$sl++}}</td>
                                <td>
                                    <span>{{$post->title}}</span><hr>
                                    <span>{{$post->slug}}</span>
                                </td>
                                <td>
                                    <span><a href="{{route('category.show', $post->category_id)}}"> {{$post->category->name}}</a></span><hr>
                                    <span><a href="{{route('sub-category.show', $post->sub_category_id)}}"> {{$post->subCategory->name}}</a></span><hr>
                                </td>
                                <td>
                                    <span>{{$post->status == 1 ? 'Active' : 'Inactive'}}</span><hr>
                                    <span>{{$post->is_approved == 1 ? 'Approve' : 'Not Approved'}}</span>
                                </td>
                                <td><img src="{{url('images/thumbnail/'.$post->photo)}}"
                                        data-src="{{url('images/original/'.$post->photo)}}"
                                         class="post-img" alt="post_img">
                                </td>
                                <td>
                                    @php
                                    $classes = ['btn-success', 'btn-danger', 'btn-warning', 'btn-info', 'btn-primary', 'btn-secondary'];
                                    @endphp
                                    @foreach ($post->tag as $tag)
                                    <a href="{{route('tag.show', $tag->id)}}" 
                                        class="btn btn-sm {{$classes[rand(0,5)]}} mb-1">{{$tag->name}}</a>
                                    @endforeach
                                </td>

                                <td>
                                    <span>{{$post->created_at->toDayDateTimeString()}}</span><hr>
                                    <span>{{$post->created_at == $post->updated_at ? 'Not Updated' : $post->updated_at->toDayDateTimeString()}}</span><hr>
                                    <span>{{$post->user->name}}</span>
                                </td>
                                <td class="d-flex gap-1 justify-content-center">
                                    {{-- show --}}
                                    <a href="{{route('post.show', $post->id)}}"
                                        class="btn btn-info btn-sm">
                                        <i class="fa-solid fa-eye"></i>
                                    </a>
                                    {{-- edit --}}
                                    <a href="{{route('post.edit', $post->id)}}"
                                        class="btn btn-sm btn-warning">
                                        <i class="fa-solid fa-edit"></i>
                                    </a>
                                    {{-- delete --}}
                                    <form method="post" action="{{route('post.destroy', $post->id)}}">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-sm btn-danger show-alert-delete-box">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="9" class="text-center text-danger h2 py-5">No Records Found!
                                    <br>
                                    <img src="{{asset('images/skeleton.png')}}" alt="" class="w-25 h- mt-2">
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
                {{-- pagination --}}
                {{$posts->links()}}
            </div>
        </div>
    </div>
</div>

{{-- post Image modal section --}}
<!-- Button trigger modal -->
<button type="button" id="image-show-button" class="d-none btn btn-primary" data-bs-toggle="modal" data-bs-target="#image-show">
    Post Image 
</button>
  <!-- Main Body -->
<div class="modal fade" id="image-show" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Dispaly Image</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <img class="img-thumbnail" alt="display-img" id="display-img">
        </div>
    </div>
</div>



@if (session('msg'))        
    @push('js')
        <script>
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
            })
            Toast.fire({
                icon: '{{ session('cls') }}',
                title: '{{ session('msg') }}'
            })
        </script>
    @endpush
@endif

@push('js')
<script type="text/javascript">

//Display Post Image modal by click on image
    // post-img e click kra holo
    $('.post-img').on('click', function(){
    // data-src atrribute theke data ti img variable e rakha holo 
    let img = $(this).attr('data-src');
    // img variable er data ti 'dispaly-img' er src e deya holo
    $('#display-img').attr('src', img);
    //jdi image e click kri, tahle button e automatic vabe click hobe, tai 'trigger('click')'
    $('#image-show-button').trigger('click')
    })


//sweet alert
    $(document).ready(function() {
        $(document).on('click', '.show-alert-delete-box', function(event){
            var form =  $(this).closest("form");

            event.preventDefault();
            Swal.fire({
                title: "Are you sure you want to delete this record?",
                text: "If you delete this, it will be gone forever.",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });
</script>
@endpush

@endsection