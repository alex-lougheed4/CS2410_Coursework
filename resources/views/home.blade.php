<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Homepage</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
        </style>
    </head>
    <body class="antialiased">


            <div>
              <h1>Aston Animal Sanctuary</h1>

                <div class="topnav">
                  <div class="topnav-centered">
                    <a class="active" href="/home">Home</a>
                  </div>
                  <div class="topnav-right">
                    <a href="/account">Account</a>
                  </div>
                  @if( Auth::user()->role == 1)
                  <a href="/staffportal">Staff</a>
                  @endif
                </div>
                <br>
                <a href="{{ route('display_animal') }}" class="btn btnprimary">Display Animals </a>

        </div>
    </body>
</html>
