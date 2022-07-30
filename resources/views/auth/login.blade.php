<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Custom Css -->
    <link rel="stylesheet" href="{{asset('css/style.css')}}">


    <!-- Box Icon -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <title>Login</title>
</head>

<body>

<section>
    <div class="area-one">

    </div>
    <div class="form-area">
        <form action="{{ route('login-process') }}" method="post">
            @csrf
            <div class="container-form">
                <div class="input-area">
                    <h3>Silahkan Login</h3>
                </div>
                <div class="input-area">
                    <label for="userName">User Name</label>
                    <input type="text" name="user_name" id="userName" class="@error('username') is-invalid @enderror" value="{{ old('user_name') }}">
                    @error('username')
                             <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                </div>
                <div class="input-area">
                    <label for="userName">Password</label>
                    <input type="password" name="password" id="password" class="@error('password') is-invalid @enderror" value="{{ old('password') }}">
                    @error('password')
                             <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                </div>
                <div class="input-area">
                    <button type="submit">Login</button>
                </div>
            </div>
        </form>
    </div>
</section>























    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.6.1/gsap.min.js" integrity="sha512-cdV6j5t5o24hkSciVrb8Ki6FveC2SgwGfLE31+ZQRHAeSRxYhAQskLkq3dLm8ZcWe1N3vBOEYmmbhzf7NTtFFQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{asset('js/login.js')}}"></script>
    
</body>

</html>