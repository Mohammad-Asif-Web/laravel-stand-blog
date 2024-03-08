@extends('backend.layouts.master')

@section('title', 'User Profile')

@section('sub_title', './Profile Update')

@section('content')

<div class="row mt-5">
    <div class="col-md-8 mb-5">
        <div class="row">
            <div class="card">
                <div class="card-header">
                    <h4 class="">Profile Details</h4>
                </div>
            </div>
        </div>
        <div class="row mt-1">
            <div class="col-md-12">
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

                        {{-- this is Laravel Collective Form Design --}}
                        {!! Form::model($profile, ['method'=>'post', 'route'=>'profile.store']) !!}
                        {!! Form::label('phone', 'Phone', ['class'=>'w-100 mb-1']) !!}
                        {!! Form::text('phone', null, ['class'=>'form-control', 'placeholder'=>'Enter phone']) !!}
                        {!! Form::label('address', 'Address', ['class'=>'w-100 mt-3 mb-1']) !!}
                        {!! Form::text('address', null, ['class'=>'form-control', 'placeholder'=>'Enter address']) !!}

                        <div class="row mt-3">
                            {{-- division --}}
                            <div class="col-md-4">
                                {!! Form::label('division_id', 'Select Division', ['class'=>'w-100 mb-1']) !!}
                                {!! Form::select('division_id', $divisions, null, ['id'=>'division_id', 'class'=>'form-select', 'placeholder'=>'select division']) !!}
                            </div>
                            {{-- district --}}
                            <div class="col-md-4">
                                {!! Form::label('district_id', 'Select District', ['class'=>'w-100 mb-1']) !!}
                                <select name="district_id" id="district_id" class="form-select" disabled>
                                    <option >Select District</option>
                                </select>
                            </div>
                            {{-- thana --}}
                            <div class="col-md-4">
                                {!! Form::label('thana_id', 'Select Thana', ['class'=>'w-100 mb-1']) !!}
                                <select name="thana_id" id="thana_id" class="form-select" disabled>
                                    <option >Select Thana</option>
                                </select>
                            </div>
                        </div>

                        {!! Form::label('gender', 'Select Gender', ['class'=>'w-100 mt-3']) !!}
                        <div class="d-flex">
                            <div class="d-flex"> {!! Form::radio('gender', 'Male', false, ['class'=>'form-check me-1']) !!} Male</div>
                            <div class="d-flex mx-2"> {!! Form::radio('gender', 'Female', false, ['class'=>'form-check me-1']) !!} Female</div>
                            <div class="d-flex"> {!! Form::radio('gender', 'Other', false, ['class'=>'form-check me-1']) !!} Other</div>
                        </div>


                        {!! Form::button('Update Profile', ['type'=>'submit', 'class'=>'btn btn-success mt-3']) !!}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- profile --}}
    <div class="col-md-4">
        <div class="row">
            <div class="card">
                <div class="card-header">
                    <h4 class="">Profile Photo</h4>
                </div>
            </div>
        </div>
        <div class="row mt-1">
            <div class="card">
                <div class="card-body">
                    <label for="photo" class="w-100 mb-3">Upload Profile Photo</label>
                    <div class="row">
                        <div class="col-12">
                            <input type="file" id="photo" name="photo" class="custom-file-input"
                                    oninput="img_preview.src=window.URL.createObjectURL(this.files[0])">
                        </div>
                        <div class="col-12 mt-2">
                            <img id="img_preview" height="80px" width="100px;" >
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('js')
<script src="{{asset('backend/js/axios.min.js')}}"></script>
{{-- # $('') () ! --}}
<script>

    const DomainUrl = window.location.origin;
    const DivisionId = $('#division_id');
    const DistrictId = $('#district_id');
    const ThanaId = $('#thana_id');

    const getDistrict = (divisionId, selected = null) => {
        axios.get(`${DomainUrl}/get-district/${divisionId}`).then(res=>{
            let districts = res.data;
            DistrictId.removeAttr('disabled');
            DistrictId.empty();
            DistrictId.append(`<option>Select District</option>`)
            districts.map(singleItem =>{
                console.log(singleItem.name);
                DistrictId.append(`<option value="${singleItem.id}"
                                    ${selected==singleItem.id ? 'selected' : null}>
                                    ${singleItem.name}
                                   </option>`);
            })
        })
    }

    const getThana = (districtId, selected = null) => {
        axios.get(`${DomainUrl}/get-thana/${districtId}`).then(res=>{
            let thanas = res.data;
            ThanaId.removeAttr('disabled');
            ThanaId.empty();
            ThanaId.append(`<option>Select Thana</option>`)
            thanas.map(singleItem =>{
                console.log(singleItem.name);
                ThanaId.append(`<option value="${singleItem.id}"
                                 ${selected==singleItem.id ? 'selected' : null}>
                                 ${singleItem.name}
                                </option>`);
            })
        })
    }

    DivisionId.on('change', function(){
        getDistrict($(this).val());
        // যখন  ডিভিসন চ্যন্জ করা হবে, তখন জেলা শো করাবে কিন্তু থানা ডিজেবল থাকবে।
        // থানা তখনই একটিভ হবে যখন জেলা চ্যান্জ হবে। তাই ডিভিসন চ্যান্জ করলে থানা খালি হয়ে
        // নতুন অপশন ইলেমেন্ট যোগ হবে এবং সিলেক্ট বক্সটি ডিজেবল হয়ে যাবে।
        ThanaId.empty().append(`<option>Select Thana</option>`).attr('disabled', 'disabled');
    })
    DistrictId.on('change', function(){
        getThana($(this).val());
    })


    // typeof দিয়ে চেক করা হয় $profile ভেরিয়েবল আছে কিনা? যেহেতু এক পেজেই profile create and update
    // করা হইছে, update করার সময় মডেল বাইন্ডিং করতে ভেরিয়েবল বসিয়ে দিতে হয়। কিন্তু এই ভেরিয়েবল
    // create এর সময় undefined ইরর রিটার্ন করবে। তাই নিচে এই লজিক দেয়া হইছে। যদি $profile ভেরিয়েবল
    // থাকে তাহলে এই ফাংশনগুলো কাজ করবে না হয় এগুলো কাজ করবে না।
    if (typeof '{{$profile}}' !== 'undefined') {
        getDistrict('{{$profile?->division_id}}', '{{$profile?->district_id}}');
        getThana('{{$profile?->district_id}}', '{{$profile?->thana_id}}');
    }

</script>
@endpush

@endsection

