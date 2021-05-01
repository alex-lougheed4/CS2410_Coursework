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
                    <a href="/home">Home</a>
                  </div>
                  <div class="topnav-right">
                    <a class="active" href="/account">Account</a>
                  </div>
                  @if( Auth::user()->role == 1)
                  <a href="/staffportal">Staff</a>
                  @endif
                </div>

                @guest

                @else
                <li class ="nav-item">
                  <a class="nav=link" href = "{{ url('adoptions') }}">List Your Adoption Requests</a>
                </li>
                @endguest
        </div>
    </body>
</html>
