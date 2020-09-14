@extends('layouts.app')

@section('title', 'Laravel学院')

@section('sidebar')
    @parent
    <p>Laravel 学院致力于提供优质 Laravel 中文学习资源</p>
@endsection

@section('content')
    The current UNIX timestamp is {{ time() }}.
    Hello, {!! $name !!}.
    <p>这里是主体内容，完善中...</p>
    @{{ $name }}
@endsection

<script>
    var app = @json($countries, JSON_PRETTY_PRINT);
    console.log(app);
</script>
