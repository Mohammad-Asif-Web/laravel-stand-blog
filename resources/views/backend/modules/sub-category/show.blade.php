@extends('backend.layouts.master')

@section('title', 'Sub Category')

@section('sub_title', 'Show single data')

@section('content')

<div class="row mt-5">
    <div class="col-lg-6">
        <div class="card bg-primary">
            <div class="card-header d-flex justify-content-between bg-primary p-2">
                <h4 class="text-white">Sub category single</h4>
                <a href="{{route('sub-category.index')}}" class="btn btn-md btn-dark"> < Back</a>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-6">
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
                            <th>Name</th>
                            <td>{{$subCategory->name}}</td>
                        </tr>
                        <tr>
                            <th>Slug</th>
                            <td>{{$subCategory->slug}}</td>
                        </tr>
                        <tr>
                            <th>Category</th>
                            <td>{{$subCategory->category?->name}}</td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>{{$subCategory->status == 1 ? 'Active' : 'Inactive'}}</td>
                        </tr>
                        <tr>
                            <th>Created At</th>
                            <td>{{$subCategory->created_at->toDayDateTimeString()}}</td>
                        </tr>
                        <tr>
                            <th>Updated At</th>
                            <td>{{$subCategory->created_at == $subCategory->updated_at ? 'Not Updated' : $subCategory->updated_at->toDayDateTimeString()}}</td>
                        </tr>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@push('js')

@endpush

@endsection