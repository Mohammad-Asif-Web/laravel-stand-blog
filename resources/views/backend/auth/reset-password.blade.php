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
        <div class="h4 text-muted text-center pt-2">Reset Your Password</div>
        <form method="POST" action="{{route('password.store')}}" class="pt-3">
            @csrf
            <!-- Password Reset Token -->
            <input type="hidden" name="token" value="{{ $request->route('token') }}">
            {{-- email --}}
            <div class="form-group py-2">
                <div class="{{$errors->has('email') ? 'is-invalid input-field form-control': 'input-field'}}">
                    <span class="far fa-user p-2"></span>
                    <input type="email" name="email" class=""
                        placeholder="Email Address" 
                        value={{$request->email}} >
                </div>
            </div>
            @error('email')
                <p class="text-danger">{{$message}}</p>
            @enderror
            {{-- password --}}
            <div class="form-group py-1 pb-2">
                <div class="{{$errors->has('password') ? 'is-invalid input-field form-control': 'input-field'}}">
                    <span class="fas fa-lock p-2"></span>
                    <input type="password" name="password"
                            placeholder="Enter your Password" required class="">
                    <button class="btn bg-white text-muted">
                        <span class="far fa-eye-slash"></span>
                    </button>
                </div>
            </div>
            @error('password')
                <p class="text-danger">{{$message}}</p>
            @enderror
            {{-- Confirm Password --}}
            <div class="form-group py-1 pb-2">
                <div class="{{$errors->has('password') ? 'is-invalid input-field form-control': 'input-field'}}">
                    <span class="fas fa-lock p-2"></span>
                    <input type="password" name="password_confirmation"
                            placeholder="Enter your Password" required class="">
                    <button class="btn bg-white text-muted">
                        <span class="far fa-eye-slash"></span>
                    </button>
                </div>
            </div>
            @error('password_confirmation')
                <p class="text-danger">{{$message}}</p>
            @enderror
            <button type="submit" class="btn btn-block text-center my-3">Reset Password</button>
        </form>
    </div>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js" crossorigin="anonymous"></script>

</body>
</html>