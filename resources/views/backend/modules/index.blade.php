@extends('backend.layouts.master')

@section('title', 'Blog Dashboard')

@section('sub_title', 'Home')

@section('content')
{{-- Cards --}}
<div class="row">
    <div class="col-xl-3 col-md-6">
        <div class="card bg-primary text-white mb-4">
            <div class="card-body d-flex justify-content-between">
                <span>Total User</span>
                <span>100</span>
            </div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                <a class="small text-white stretched-link" href="#">View Details</a>
                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card bg-success text-white mb-4">
            <div class="card-body d-flex justify-content-between">
                <span>Total Post</span>
                <span>100</span>
            </div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                <a class="small text-white stretched-link" href="#">View Details</a>
                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card bg-warning text-white mb-4">
            <div class="card-body d-flex justify-content-between">
                <span>Waiting Post</span>
                <span>100</span>
            </div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                <a class="small text-white stretched-link" href="#">View Details</a>
                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card bg-danger text-white mb-4">
            <div class="card-body">Danger Card</div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                <a class="small text-white stretched-link" href="#">View Details</a>
                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
            </div>
        </div>
    </div>
</div>

{{-- User List --}}
<div class="card mb-4">
    <div class="card-header bg-info text-white">
        <i class="fas fa-table me-1"></i>
        All Users Details
    </div>
    <div class="card-body text-white p-0">
        <table class="table table-responive table-success table-striped table-bordered table-hover user-list-table">
            <thead>
                <tr>
                    <th>User Id</th>
                    <th>Name</th>
                    <th>
                        <span>Division</span><hr>
                        <span>District</span><hr>
                        <span>Thana</span>
                    </th>
                    <th>Address</th>
                    <th>
                        <span>Phone</span><hr>
                        <span>Gender</span>
                    </th>
                    <th>Role</th>
                    <th>Photo</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                <tr>
                    <td>{{$user->user?->id}}</td>
                    <td>{{$user->user?->name}}</td>
                    <td>
                        <span>{{$user->division?->name}}</span><hr>
                        <span>{{$user->district?->name}}</span><hr>
                        <span>{{$user->thana?->name}}</span>
                    </td>
                    <td>{{$user->address}}</td>
                    <td>
                        <span>{{$user->phone}}</span><hr>
                        <span>{{$user->gender}}</span>
                    </td>
                    <td>admin</td>
                    <td><img src="{{asset('images/user/'.$user->photo) }}"  style="width:60px; height: 60px; border-radius:50%; " alt=""></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

{{-- Charts --}}
<div class="row">
    <div class="col-xl-6">
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-chart-area me-1"></i>
                Area Chart Example
            </div>
            <div class="card-body"><canvas id="myAreaChart" width="100%" height="40"></canvas></div>
        </div>
    </div>
    <div class="col-xl-6">
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-chart-bar me-1"></i>
                Bar Chart Example
            </div>
            <div class="card-body"><canvas id="myBarChart" width="100%" height="40"></canvas></div>
        </div>
    </div>
</div>

{{-- Datatables --}}
<div class="card mb-4">
    <div class="card-header">
        <i class="fas fa-table me-1"></i>
        DataTable Example
    </div>
    <div class="card-body">
        <table id="datatablesSimple">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Position</th>
                    <th>Office</th>
                    <th>Age</th>
                    <th>Start date</th>
                    <th>Salary</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th>Name</th>
                    <th>Position</th>
                    <th>Office</th>
                    <th>Age</th>
                    <th>Start date</th>
                    <th>Salary</th>
                </tr>
            </tfoot>
            <tbody>
                <tr>
                    <td>Tiger Nixon</td>
                    <td>System Architect</td>
                    <td>Edinburgh</td>
                    <td>61</td>
                    <td>2011/04/25</td>
                    <td>$320,800</td>
                </tr>
                <tr>
                    <td>Garrett Winters</td>
                    <td>Accountant</td>
                    <td>Tokyo</td>
                    <td>63</td>
                    <td>2011/07/25</td>
                    <td>$170,750</td>
                </tr>
                <tr>
                    <td>Ashton Cox</td>
                    <td>Junior Technical Author</td>
                    <td>San Francisco</td>
                    <td>66</td>
                    <td>2009/01/12</td>
                    <td>$86,000</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection






