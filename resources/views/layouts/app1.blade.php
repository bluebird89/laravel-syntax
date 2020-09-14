<html>
<head>
    <title>应用名称 - @yield('title')</title>
</head>
<body>

@section('header')
    这里是header栏
@show

@section('siderbar')
    Sidebar
@show

<div class="container">
    @yield('content')
</div>

@section('Footer')
    Foooter
@show

</body>
</html>
