@extends('backend.layouts.master')

@section('title', 'User Profile')

@section('sub_title', './Profile Update')

@section('content')

<div class="row justify-content-evenly gap-3 mt-5">
    <div class="col-md-7 mb-5">
        <div class="row">
            <div class="card">
                <div class="card-header">
                    <h4 class="">Profile Details</h4>
                </div>
            </div>
        </div>
        <div class="row mt-1">
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
                    <img src="{{asset('images/user/'.$profile->photo)}}" id="previous_img"
                         style="{{$profile->photo == null ? 'display:none' : 'display:block'}}"
                         class="img-thumbnail" alt="profile-photo"
                     >
                    <label for="photo" class="w-100 my-3">Upload Profile Photo</label>
                    <form>
                        <input type="file" class="form-control" id="image_input">
                        <button type="reset" id="reset" class="d-none"></button>
                    </form>
                    <p class="text-danger" id="error_message"></p>
                    <button style="width: 100px;" class="btn btn-success my-3" id="img_upload_btn">Upload</button>
                    <img src="" alt="" id="img_preview" class="w-100">
                </div>
            </div>
        </div>
    </div>
</div>

@push('js')
<script src="{{asset('backend/js/axios.min.js')}}"></script>
{{-- # $('#') () ! $(this) --}}
<script>

    let is_loading = false;
    let handleLoading = () =>{
        if(is_loading){
            $('#img_upload_btn').html(`<div class="spinner-border spinner-border-sm" role="status">
                                         <span class="visually-hidden">Loading...</span>
                                       </div>`)
        } else {
            $('#img_upload_btn').text('Upload');
        }
    }

    const DomainUrl = window.location.origin;
    let photo;
    // profile image update
    $('#image_input').on('change', function(e){
        // ইনপুট ফাইল থেকে ছবিটিকে আগে নেওয়া হলো
        let file = e.target.files[0];
        let reader = new FileReader();
        reader.readAsDataURL(file);
        reader.onloadend = () =>{
        // ছবিটিকে base64 এ কনভার্ট করসে। form 'multipart‘ এ ডাটা যায় অবজেক্ট আকারে।
        // অবজেক্ট আকারে ডাটা  এপিআই এর দ্বারা পাঠানো যায় না। তাই ছবিটিকে base 64 এ এনকোড করে
        // এপিআই দ্বারা পাঠানো হইসে। এখন এই ফাইল নেয়ে backend এ কাজ করা যাবে।
            photo = reader.result;
            $('#img_preview').attr('src', photo);
        }
    })

    $('#img_upload_btn').on('click', function(){
        is_loading = true;
        handleLoading();
        // যদি ছবি ছাড়া সাবমিট বাটন প্রেস পরে তাহলে ইরর মেসেজ দিবে
        if(photo == undefined){
            $('#error_message').text('Please insert an image');
        } else {
            $('#error_message').text('');
            axios.post(`${DomainUrl}/dashboard/upload-profile-photo`, {
                photo: photo,
            }).then(res => {
                is_loading = false;
                handleLoading();
                let response = res.data
                $('#reset').trigger('click')
                $('#previous_img').attr('src', response.photo).show();
                $('#img_preview').attr('src', '');
                Swal.fire({
                    position: 'top-end',
                    icon: response.cls,
                    toast: true,
                    title: response.msg,
                    showConfirmButton: false,
                    timer: 3000,
                })

            })
        }
    })


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

