<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Blade 模板引擎
        </h2>
    </x-slot>

    <div>
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            <x-jet-action-section>
                <x-slot name="title">这里是侧边栏</x-slot>
                <x-slot name="description">学院君致力于提供优质 Laravel 中文学习资源</x-slot>
                <x-slot name="content">这里是主体内容...</x-slot>
            </x-jet-action-section>
        </div>
    </div>
</x-app-layout>
