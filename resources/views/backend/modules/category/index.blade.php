@extends('backend.layouts.master')

@section('title', 'Category')

@section('sub_title', 'List')

@section('content')

{{-- @if(session()->has('msg'))
<div class="alert alert-{{ session('cls') }}">
  {{ session('msg') }}
</div>
@endif --}}

<div class="row mt-5">
    <div class="col-lg-8">
        <div class="card bg-primary">
            <div class="card-header d-flex justify-content-between bg-primary p-2">
                <h4 class="text-white">Category List</h4>
                <a href="{{route('category.create')}}" class="btn btn-md btn-success "> Add New Category</a>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-body">
                <table class="table table-responive table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Sl</th>
                            <th>Name</th>
                            <th>Slug</th>
                            <th>Status</th>
                            <th>Order By</th>
                            <th>Created At</th>
                            <th>Updated At</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (!empty($categories->count()))
                            @php
                                $sl = 1
                            @endphp
                            @foreach ($categories as $category)
                            <tr>
                                <td>{{$sl++}}</td>
                                <td>{{$category->name}}</td>
                                <td>{{$category->slug}}</td>
                                <td>{{$category->status == 1 ? 'Active' : 'Inactive'}}</td>
                                <td>{{$category->order_by}}</td>
                                <td>{{$category->created_at->toDayDateTimeString()}}</td>
                                <td>{{$category->created_at == $category->updated_at ? 'Not Updated' : $category->updated_at->toDayDateTimeString()}}</td>
                                <td class="d-flex gap-1">
                                    {{-- show --}}
                                    <a href="{{route('category.show', $category->id)}}"
                                        class="btn btn-info btn-sm">
                                        <i class="fa-solid fa-eye"></i>
                                    </a>
                                    {{-- edit --}}
                                    <a href="{{route('category.edit', $category->id)}}"
                                        class="btn btn-sm btn-warning">
                                        <i class="fa-solid fa-edit"></i>
                                    </a>
                                    {{-- delete --}}
                                    <form method="post" action="{{route('category.destroy', $category->id)}}">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-sm btn-danger show-alert-delete-box">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </form>
                                    {{-- this is Lravel Collective Form delete method --}}
                                    {{-- {!! Form::open([
                                        'method'=>'delete',
                                        'route'=>['category.destroy', $category->id]
                                        ]) 
                                    !!}
                                    {!! Form::button('<i class="fa-solid fa-trash"></i>', [
                                        'type'=>'submit',
                                        'class'=>'btn btn-sm btn-danger show-alert-delete-box',
                                        ]) 
                                    !!}
                                    {!! Form::close() !!} --}}
                                </td>
                            </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="8" class="text-center text-danger h2 py-5">No Records Found!
                                    <br>
                                    <img src="{{asset('images/skeleton.png')}}" alt="" class="w-25 h- mt-2">
                                </td>
                            </tr>
                        @endif

                    </tbody>
                </table>
                    {{$categories->links()}}
            </div>
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