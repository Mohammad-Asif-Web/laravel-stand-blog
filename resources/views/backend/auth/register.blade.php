<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login Form</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" rel="stylesheet" />    
    <link rel="stylesheet" href="{{asset('auth/login.css')}}">
</head>
<body>
    
    <div class="wrapper bg-white">
        <div class="h2 text-center">Dashboard</div>
        <div class="h4 text-muted text-center pt-2">Create A New Account</div>
        {!! Form::open(['method'=>'post', 'route'=>'register']) !!}
        {!! Form::label('name', 'Name') !!}
        {!! Form::text('name', null, ['class'=>$errors->has('name') ? 'is-invalid form-control form-control-sm' : 'form-control form-control-sm']) !!}
        @error('name')
            <p class="text-danger">{{$message}}</p>
        @enderror
        {!! Form::label('email', 'Email', ['class'=>'mt-2']) !!}
        {!! Form::email('email', null, ['class'=>$errors->has('email') ? 'is-invalid form-control form-control-sm' : 'form-control form-control-sm']) !!}
        @error('email')
            <p class="text-danger">{{$message}}</p>
        @enderror
        {!! Form::label('password', 'Password',['class'=>'mt-2']) !!}
        {!! Form::password('password', ['class'=>$errors->has('password') ? 'is-invalid form-control form-control-sm' : 'form-control form-control-sm']) !!}
        @error('password')
            <p class="text-danger">{{$message}}</p>
        @enderror
        {!! Form::label('password_confirmation', 'Confirm Password', ['class'=>'mt-2']) !!}
        {!! Form::password('password_confirmation', ['class'=>'form-control form-control-sm']) !!}
        <div class="d-grid">
        {!! Form::button('Register', ['type'=>'submit', 'class'=>'btn btn-info btn-sm mt-2']) !!}
        </div>
        {!! Form::close() !!}
        <div class="pt-3 text-muted">
            Already Have an Account? <a href="{{route('login')}}">Sign In</a>
        </div>





        {{-- <form class="pt-3">
            <div class="form-group py-2">
                <div class="input-field">
                    <span class="far fa-user p-2"></span>
                    <input type="text" placeholder="Username or Email Address" required class="">
                </div>
            </div>
            <div class="form-group py-1 pb-2">
                <div class="input-field">
                    <span class="fas fa-lock p-2"></span>
                    <input type="text" placeholder="Enter your Password" required class="">
                    <button class="btn bg-white text-muted">
                        <span class="far fa-eye-slash"></span>
                    </button>
                </div>
            </div>
            <div class="d-flex align-items-start">
                <div class="remember">
                    <label class="option text-muted"> Remember me
                        <input type="radio" name="radio">
                        <span class="checkmark"></span>
                    </label>
                </div>
                <div class="ml-auto">
                    <a href="{{route('password.request')}}" id="forgot">Forgot Password?</a>
                </div>
            </div>
            <button class="btn btn-block text-center my-3">Log in</button>
            <div class="text-center pt-3 text-muted">Not a member? <a href="{{route('register')}}">Sign up</a></div>
        </form> --}}
    </div>

    <p class="text-center">password: 12345678</p>



    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js" crossorigin="anonymous"></script>

</body>
</html>