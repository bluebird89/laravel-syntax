@extends('layouts.app1')

@section('title', 'Laravel学院')

@section('header')
    @parent
    <p>Laravel 学院致力于提供优质 Laravel 中文学习资源</p>
@endsection

@section('siderbar')
    @parent
    <p class="navbar">HHHHHHHH</p>
@endsection

@section('content')
    The current UNIX timestamp is {{ time() }}.
    Hello, {!! $name !!}.
    <p>这里是主体内容，完善中...</p>
    {{ $name }}

    <x-alert type="error" :message="@message" class="mt-4 badge-danger"></x-alert>


    <x-alert2>
        <x-slot name="title">
            Server Error
        </x-slot>

        <strong>Whoops!</strong> Something went wrong!
    </x-alert2>

    <x-alert3 type="warning" :message="@message" class="mt-5"/>
@endsection

@section('footer')
    <div class="blockquote-footer">
        This is last yellow
    </div>a
@endsection

<script>
    var app = @json($countries, JSON_PRETTY_PRINT);
    console.log(app);
</script>
