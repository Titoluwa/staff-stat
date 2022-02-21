<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <title>Employee Data Analytics</title>
    <style>
        .links > a {
            color: rgb(37, 99, 235);
            padding: 0 25px;
            font-size: 15px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }
    </style>
</head>
<body class="bg-gry-100">
    <div class="bg-indigo-200 px-10 p-5">
        <div class="links">
            <a href="/"><img class="absolute h-6 w-6" src="img\analyticslogo.png" alt="logo"></a>
            <a href="/gender">Gender</a>
            <a href="/branch">Branch</a>
            <a href="/marital">Marital Status</a>
            <a href="/position">Position</a>
            <a href="/age">Age</a>
            <a href="/dept">Department</a>
            <a href="/employment_date">Employment Date</a>
            <a href="/salary">Salary</a>
        </div>
    </div>
    @yield('content')

    <!-- Resources -->
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="https://cdn.amcharts.com/lib/4/core.js"></script>
    <script src="https://cdn.amcharts.com/lib/4/charts.js"></script>
    <script src="https://cdn.amcharts.com/lib/4/themes/animated.js"></script>
    @yield('scriptt')
</body>
</html>
