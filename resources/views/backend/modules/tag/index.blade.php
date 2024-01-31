@extends('backend.layouts.master')

@section('title', 'Tag')

@section('sub_title', 'List')

@section('content')

<div class="row mt-5">
    <div class="col-lg-8">
        <div class="card bg-primary">
            <div class="card-header d-flex justify-content-between bg-primary p-2">
                <h4 class="text-white">Tag List</h4>
                <a href="{{route('tag.create')}}" class="btn btn-md btn-success "> Add New Tag</a>
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
                        @if (!empty($tags->count()))
                            @php
                                $sl = 1
                            @endphp
                            @foreach ($tags as $tag)
                            <tr>
                                <td>{{$sl++}}</td>
                                <td>{{$tag->name}}</td>
                                <td>{{$tag->slug}}</td>
                                <td>{{$tag->status == 1 ? 'Active' : 'Inactive'}}</td>
                                <td>{{$tag->order_by}}</td>
                                <td>{{$tag->created_at->toDayDateTimeString()}}</td>
                                <td>{{$tag->created_at == $tag->updated_at ? 'Not Updated' : $tag->updated_at->toDayDateTimeString()}}</td>
                                <td class="d-flex gap-1">
                                    {{-- show --}}
                                    <a href="{{route('tag.show', $tag->id)}}"
                                        class="btn btn-info btn-sm">
                                        <i class="fa-solid fa-eye"></i>
                                    </a>
                                    {{-- edit --}}
                                    <a href="{{route('tag.edit', $tag->id)}}"
                                        class="btn btn-sm btn-warning">
                                        <i class="fa-solid fa-edit"></i>
                                    </a>
                                    {{-- delete --}}
                                    <form method="post" action="{{route('tag.destroy', $tag->id)}}">
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
                                <td colspan="8" class="text-center text-danger h2 py-5">No Records Found!
                                    <br>
                                    <img src="{{asset('images/skeleton.png')}}" alt="" class="w-25 h- mt-2">
                                </td>
                            </tr>
                        @endif

                    </tbody>
                </table>
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