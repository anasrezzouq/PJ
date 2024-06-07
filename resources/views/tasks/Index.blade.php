<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @lang('Blog List')
        </h2>
    </x-slot>
    @if(session('success'))
    <div id="success-alert"
    x-data="{ show: true }"
    x-show="show"
    x-init="setTimeout(() => show = false, 4000)"
    x-transition:leave="transition ease-in duration-1000"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0"
     class="fixed top-4 right-4 bg-green-600 text-white px-4 py-2 rounded shadow w-60 transition-opacity duration-1000">
        {{ session('success') }}
    </div>
    @endif
    <!-- Filter Form -->
    <div class='p-12'>
        <form method="GET" action="{{ route('tasks.index') }}" class="mb-6 w-80 relative float-end">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <div>
                    <label for="category" class="block text-sm font-medium text-gray-700">@lang('Category')</label>
                    <select name="category" id="category" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                        <option value="">@lang('All')</option>
                        <option value="sport" {{ request('category') == 'sport' ? 'selected' : '' }}>@lang('Sport')</option>
                        <option value="education" {{ request('category') == 'education' ? 'selected' : '' }}>@lang('Education')</option>
                        <option value="art" {{ request('category') == 'art' ? 'selected' : '' }}>@lang('Art')</option>
                        <option value="politique" {{ request('category') == 'politique' ? 'selected' : '' }}>@lang('Politique')</option>
                        <option value="sante" {{ request('category') == 'sante' ? 'selected' : '' }}>@lang('Sante')</option>
                    </select>
                </div>
                <div class="flex items-end">
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded shadow">@lang('Filter')</button>
                </div>
            </div>
        </form>
    </div>
    <div class="max-w-7xl mx-auto p-6 lg:p-8">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($tasks as $task)
            <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                <img class="w-full h-48 object-cover" src="{{ asset('storage/' . $task->image_path) }}"alt="{{ $task->title }}">
                <div class="p-6 flex flex-col justify-between">
                    <div>
                        <h3 class="mt-2 text-xl font-semibold text-gray-900">{{ $task->title }}</h3>
                        <p class="mt-4 text-gray-600 text-sm line-clamp-3">
                            {{ $task->detail }}
                        </p>
                        <p class="mt-2 text-gray-600 text-sm">Category: {{ $task->category }}</p>
                    </div>
                    <div class="mt-4 flex space-x-2">
                        <x-link-button href="{{ route('tasks.show', $task->id) }}" class="text-sm px-3 py-1">
                            @lang('Show')
                        </x-link-button>
                        <x-link-button href="{{ route('tasks.edit', $task->id) }}" class="text-sm px-3 py-1">
                            @lang('Edit')
                        </x-link-button>
                        <x-link-button onclick="event.preventDefault(); document.getElementById('destroy{{ $task->id }}').submit();" class="text-sm px-3 py-1">
                            @lang('Delete')
                        </x-link-button>
                        <form id="destroy{{ $task->id }}" action="{{ route('tasks.destroy', $task->id) }}" method="POST" style="display: none;">
                            @csrf
                            @method('DELETE')
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    <br/>
</x-app-layout>
