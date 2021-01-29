<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <style>
        body {
            margin: 0;
            padding: 0;
            background: url("{{ asset('assets/login_background.jpg') }}") no-repeat center center fixed;
            /*background-size: cover;*/
            /*background-repeat: no-repeat;*/
            /*background-size: 100% auto;*/
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
            font-family: sans-serif;
            background-color: black;
        }

        .box {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 30rem;
            padding: 2.5rem;
            box-sizing: border-box;
            /*background: rgba(0, 0, 0, 0.6);*/
            border-radius: 0.625rem;
        }
        .box h2 {
            margin: 0 0 1.875rem;
            padding: 0;
            color: #fff;
            text-align: center;
        }

        .box .inputBox {
            position: relative;
            margin-top: 0.5rem;
        }

        .box .inputBox input {
            width: 100%;
            padding: 0.625rem 0;
            font-size: 1rem;
            color: #fff;
            letter-spacing: 0.062rem;
            margin-bottom: 0.5rem;
            border: none;
            border-bottom: 0.065rem solid #fff;
            outline: none;
            background: transparent;
        }

        input:-webkit-autofill,
        input:-webkit-autofill:hover,
        input:-webkit-autofill:focus,
        textarea:-webkit-autofill,
        textarea:-webkit-autofill:hover,
        textarea:-webkit-autofill:focus,
        select:-webkit-autofill,
        select:-webkit-autofill:hover,
        select:-webkit-autofill:focus {
            border: none;
            border-bottom: 0.065rem solid #fff;
            outline: none;
            background: transparent;
            -webkit-text-fill-color: white;
            transition: background-color 5000s ease-in-out 0s;
        }

        .box .inputBox label {
            position: absolute;
            top: 0;
            left: 0;
            padding: 0.625rem 0;
            font-size: 1rem;
            color: #fff;
            pointer-events: none;
            transition: 0.5s;
        }

        .box .inputBox input:focus ~ label,
        .box .inputBox input:valid ~ label,
        .box .inputBox input:not([value=""]) ~ label {
            top: -1.125rem;
            left: 0;
            color: #03a9f4;
            font-size: 0.75rem;
        }

        .box input[type="submit"] {
            border: none;
            outline: none;
            color: #fff;
            background-color: #03a9f4;
            padding: 0.625rem 1.25rem;
            cursor: pointer;
            border-radius: 0.312rem;
            font-size: 1rem;
            width: 100%;
        }

        .box input[type="submit"]:hover {
            background-color: #1cb1f5;
        }
        .checkbox {
            display: inline-flex;
            cursor: pointer;
            position: relative;
            margin-bottom: 20px;
        }

        .checkbox > span {
            color: white;
            font-size: 14px;
            padding: 0.5rem;
        }

        .checkbox > input {
            height: 25px;
            width: 25px;
            -webkit-appearance: none;
            -moz-appearance: none;
            -o-appearance: none;
            appearance: none;
            border: 1px solid #34495E;
            border-radius: 4px;
            outline: none;
            transition-duration: 0.3s;
            border: 2px solid #41B883;
            cursor: pointer;
            margin-top: 6px !important;
        }

        .checkbox > input:checked {
            border: 2px solid #41B883;
            background-color: #34495E;
        }

        .checkbox > input:checked + span::before {
            content: '\2713';
            display: block;
            text-align: center;
            color: #41B883;
            position: absolute;
            left: 0.5rem;
            top: 0.5rem;
            font-weight: bold;
        }

        .checkbox > input:active {
            border: 2px solid #34495E;
        }
        @media only screen and (max-width: 600px) {
            .box {
                width: 20rem;
            }
            .checkbox > input {
                width: 35px;
            }
        }
        .invalid-feedback {
            display: block;
        }
    </style>
</head>
<body>
<div class="box">
    <div class="col-md-12">
        <h2 class="mb-4">{{ __('global.ResetPassword') }}</h2>
        <form method="POST" action="{{ route('password.email') }}">
            @csrf
            @error('email')
            <div class="alert-danger p-1 mb-4">
                <strong>{{ $message }}</strong>
            </div>
            @enderror
            @if (session('status'))
                <div class="alert-success p-1 mb-4" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            <div class="inputBox">
                <input type="email" name="email" autocomplete="off" required onkeyup="this.setAttribute('value', this.value);" value="{{ old('email') }}">
                <label>{{ __('global.Email') }}</label>
            </div>
            <input type="submit" class="mt-3" name="sign-in" value="{{ __('global.send_password_reset') }}">
        </form>
    </div>
    <div class="col-md-12 text-right">
        <a href="{{ route('login') }}" class="text-white-50">{{ __('global.LoginHere') }}</a>
    </div>
</div>
</body>

</html>
