<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Welcome to Our Blog') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <p>Explore the latest in Blogs!</p>
                <p>Join us on our journey of discovery.</p>
                <br>
                <a href="{{Route('dashboard')}}" class="bg-yellow-500 hover:bg-yellow-600 focus:bg-yellow-700 active:bg-indigo-800 text-white py-2 px-4 rounded-md shadow-sm ">join</a>
            </div>
        </div>
    </div>
</x-app-layout>
