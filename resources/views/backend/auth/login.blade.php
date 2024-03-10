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
        <div class="h4 text-muted text-center pt-2">Enter your login details</div>
        <form method="POST" action="{{route('login')}}" class="pt-3">
            @csrf
            {{-- email --}}
            <div class="form-group py-2">
                <div class="{{$errors->has('email') ? 'is-invalid input-field form-control': 'input-field'}}">
                    <span class="far fa-user p-2"></span>
                    <input type="email" name="email"
                        placeholder="Email Address"
                        class="" required>
                </div>
            </div>
            @error('email')
                <p class="text-danger">{{$message}}</p>
            @enderror
            {{-- password --}}
            <div class="form-group py-1 pb-2">
                <div class="{{$errors->has('password') ? 'is-invalid input-field form-control': 'input-field'}}">
                    <span class="fas fa-lock p-2"></span>
                    <input type="password" name="password" type="text" id="password" class=""
                            placeholder="Enter your Password" required>
                    <a class="btn bg-white text-muted">
                        <span style="color: #400485;" class="far fa-eye-slash" id="eye"></span>
                    </a>
                </div>
            </div>
            @error('password')
                <p class="text-danger">{{$message}}</p>
            @enderror
            {{-- remember me --}}
            <div class="d-flex align-items-start">
                <div class="remember">
                    <label class="option text-muted"> Remember me
                        <input type="radio" name="radio">
                        <span class="checkmark"></span>
                    </label>
                </div>
                {{-- forgot password --}}
                <div class="ml-auto">
                    <a href="{{route('password.request')}}" id="forgot">Forgot Password?</a>
                </div>
            </div>
            <button type="submit" class="btn btn-block text-center my-3">Log in</button>
            <div class="text-center pt-3 text-muted">Not a member? <a href="{{route('register')}}">Sign up</a></div>
        </form>
    </div>



    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js" crossorigin="anonymous"></script>

    <script>
        const passwordInput = $('#password');
        const icon = $('#eye');
        let handle = false;
        icon.on('click', function(){
            if (handle == true) {
                passwordInput.attr('type', 'password');
                icon.removeClass("far fa-eye");
                icon.addClass("far fa-eye-slash");
                handle = false;
            } else {
                passwordInput.attr('type', 'text');
                icon.removeClass("far fa-eye-slash");
                icon.addClass("far fa-eye");
                handle = true;
            }
            // console.log('clicked');

        })
    </script>

</body>
</html>
