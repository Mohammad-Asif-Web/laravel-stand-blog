<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Forgot Password Form</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" rel="stylesheet" />    
    <link rel="stylesheet" href="{{asset('auth/login.css')}}">
</head>
<body>
    
    <div class="wrapper bg-white">
        <div class="h2 text-center">Dashboard</div>
        <div class="text-muted text-center pt-2">Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.</div>
        <form method="POST" action="{{route('password.email')}}" class="pt-3">
            @csrf
            {{-- email --}}
            <div class="form-group py-2">
                <div class="{{$errors->has('email') ? 'is-invalid input-field form-control': 'input-field'}}">
                    <span class="far fa-user p-2"></span>
                    <input type="email" name="email" 
                        placeholder="Email Address" class="">
                </div>
            </div>
            @error('email')
                <p class="text-danger">{{$message}}</p>
            @enderror

            <button type="submit" class="btn btn-block text-center my-3">Email Password Reset Link</button>
        </form>
    </div>



    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js" crossorigin="anonymous"></script>

</body>
</html>