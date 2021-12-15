<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title> Option2health |  LOGIN</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
   
    <script src="https://kit.fontawesome.com/3a02f57020.js" crossorigin="anonymous"></script>
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        @media screen and (max-width:780px){
          .tt{
            font-size: 0.6em;
          }
          .titulos{
            font-size: 0.8em;
          }
        }
        
        @media screen and (max-width:500px){
          .tt{
            font-size: 0.4em;
          }
          .titulos{
            font-size: 0.6em;
          }
         
        }
        body {
            color: #000;
            overflow-x: hidden;
            height: 100%;
            background-color: #e9ecef;
            background-repeat: no-repeat;
        }

        .card0 {
            box-shadow: 0px 4px 8px 0px #7323c7;
            border-radius: 0px
        }

        .card2 {
            margin: 0px 40px
        }

        .logo {
            width: 15%;
            margin-top: 20px;
            margin-left: 40px
        }

        .image {
            width: 320px;
            height: 240px
        }

        .border-line {
            border-right: 1px solid #EEEEEE
        }



        .line {
            height: 1px;
            width: 25%;
            background-color: #E0E0E0;
            margin-top: 10px
        }

        .or {
            width: 50%;

        }

        .text-sm {
            font-size: 14px !important
        }

        ::placeholder {
            color: #BDBDBD;
            opacity: 1;
            font-weight: 300
        }

        :-ms-input-placeholder {
            color: #BDBDBD;
            font-weight: 300
        }

        ::-ms-input-placeholder {
            color: #BDBDBD;
            font-weight: 300
        }

        input,
        textarea {
            padding: 10px 12px 10px 12px;
            border: 1px solid lightgrey;
            border-radius: 2px;
            margin-bottom: 5px;
            margin-top: 2px;
            width: 100%;
            box-sizing: border-box;
            color: #2C3E50;
            font-size: 14px;
            letter-spacing: 1px
        }

        input:focus,
        textarea:focus {
            -moz-box-shadow: none !important;
            -webkit-box-shadow: none !important;
            box-shadow: none !important;
            border: 1px solid #304FFE;
            outline-width: 0
        }

        button:focus {
            -moz-box-shadow: none !important;
            -webkit-box-shadow: none !important;
            box-shadow: none !important;
            outline-width: 0
        }

        a {
            color: inherit;
            cursor: pointer
        }

        .btn-blue {
            background-color: #605ca8;
            width: 150px;
            color: #fff;
            border-radius: 2px
        }

        .btn-blue:hover {
            color: #fff;
            background-color: #605ca8;
            cursor: pointer
        }

        .bg-blue {
            color: #fff;
            background-color: #605ca8
        }

        @media screen and (max-width: 991px) {
            .logo {
                margin-left: 0px
            }

            .image {
                width: 300px;
                height: 220px
            }

            .border-line {
                border-right: none
            }

            .card2 {
                border-top: 1px solid #EEEEEE !important;
                margin: 0px 10px
            }
        }
    </style>
</head>
<body>
    <div id="app">
        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
