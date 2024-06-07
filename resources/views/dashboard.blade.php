<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto p-6 lg:p-8">
        <form method="GET" action="{{ route('dashboard.filter') }}" class="mb-6">
            <div class="flex items-center justify-between mb-4">
                <div class="w-1/2 mr-4">
                    <label for="category" class="block text-sm font-medium text-gray-700">@lang('Category')</label>
                    <select name="category" id="category" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200">
                        <option value="">@lang('All')</option>
                        <option value="sport" {{ request('category') == 'sport' ? 'selected' : '' }}>@lang('Sport')</option>
                        <option value="education" {{ request('category') == 'education' ? 'selected' : '' }}>@lang('Education')</option>
                        <option value="art" {{ request('category') == 'art' ? 'selected' : '' }}>@lang('Art')</option>
                        <option value="politique" {{ request('category') == 'politique' ? 'selected' : '' }}>@lang('Politique')</option>
                        <option value="sante" {{ request('category') == 'sante' ? 'selected' : '' }}>@lang('Sante')</option>
                    </select>
                </div>
                <div>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded shadow">@lang('Filter')</button>
                </div>
            </div>
        </form>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($tasks as $task)
            <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                <!-- Image -->
                <img class="w-full h-48 object-cover" src="{{ $task->image_path ? asset('storage/' . $task->image_path) : 'https://via.placeholder.com/400x300' }}" alt="{{ $task->title }}">
                
                <div class="p-6 flex flex-col justify-between">
                    <div>
                        <!-- Title -->
                        <h3 class="mt-2 text-xl font-semibold text-gray-900">{{ $task->title }}</h3>
                        <!-- Detail -->
                        <p class="mt-4 text-gray-600 text-sm line-clamp-3">{{ $task->detail }}</p>
                    </div>
                    <!-- Category -->
                    <p class="mt-2 text-gray-600 text-sm">@lang('Category'): {{ $task->category }}</p>
                </div>
                
                <!-- Author and Date -->
                <div class="flex items-center justify-between p-6">
                    <img class="w-8 h-8 rounded-full mr-4" src="http://i.pravatar.cc/300" alt="Avatar of Author">
                    <p class="text-gray-600 text-xs md:text-sm">{{ $task->created_at->format('d/m/Y') }}</p>
                </div>
                
                <!-- Show Button -->
                <x-link-button href="{{ route('tasks.show', $task->id) }}" class="text-sm px-3 py-1">@lang('Show')</x-link-button>
            </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
