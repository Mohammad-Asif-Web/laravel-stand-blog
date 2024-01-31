@extends('backend.layouts.master')

@section('title', 'Tag')

@section('sub_title', 'Show single data')

@section('content')

<div class="row mt-5">
    <div class="col-lg-6">
        <div class="card bg-primary">
            <div class="card-header d-flex justify-content-between bg-primary p-2">
                <h4 class="text-white">Tag single</h4>
                <a href="{{route('tag.index')}}" class="btn btn-md btn-dark"> < Back</a>
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
                            <td>{{$tag->name}}</td>
                        </tr>
                        <tr>
                            <th>Slug</th>
                            <td>{{$tag->slug}}</td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>{{$tag->status == 1 ? 'Active' : 'Inactive'}}</td>
                        </tr>
                        <tr>
                            <th>Created At</th>
                            <td>{{$tag->created_at->toDayDateTimeString()}}</td>
                        </tr>
                        <tr>
                            <th>Updated At</th>
                            <td>{{$tag->created_at == $tag->updated_at ? 'Not Updated' : $tag->updated_at->toDayDateTimeString()}}</td>
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