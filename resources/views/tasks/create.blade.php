<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-900 leading-tight">
            {{ __('Create Blog') }}
        </h2>
    </x-slot>

    <!-- Success Message -->
    @if (session()->has('message'))
    <div class="fixed top-4 right-4 bg-green-500 text-white px-4 py-2 rounded shadow-md w-60 transition-opacity duration-1000"
         x-data="{ show: true }"
         x-show="show"
         x-init="setTimeout(() => show = false, 4000)"
         x-transition:leave="transition ease-in duration-1000"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0">
        {{ session('message') }}
    </div>
    @endif

    <x-tasks-card class="max-w-3xl mx-auto mt-6 p-6 bg-white rounded-lg shadow-md">
        <form action="{{ route('tasks.store') }}" method="post" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <!-- Title -->
            <div>
                <x-input-label for="title" :value="__('Title')" class="text-lg font-medium text-gray-700" />
                <x-text-input id="title" class="block mt-2 w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" type="text" name="title" :value="old('title')" required autofocus />
                <x-input-error :messages="$errors->get('title')" class="mt-2 text-red-500 text-sm" />
            </div>

            <!-- Detail -->
            <div>
                <x-input-label for="detail" :value="__('Detail')" class="text-lg font-medium text-gray-700" />
                <x-textarea id="detail" class="block mt-2 w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="detail">{{ old('detail') }}</x-textarea>
                <x-input-error :messages="$errors->get('detail')" class="mt-2 text-red-500 text-sm" />
            </div>

            <!-- Image -->
            <div>
                <x-input-label for="image" :value="__('Image')" class="text-lg font-medium text-gray-700" />
                <x-text-input id="image" class="block mt-2 w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" type="file" name="image" />
                <x-input-error :messages="$errors->get('image')" class="mt-2 text-red-500 text-sm" />
            </div>

            <!-- Category -->
            <div>
                <x-input-label for="category" :value="__('Category')" class="text-lg font-medium text-gray-700" />
                <select id="category" name="category" class="block mt-2 w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    <option value="sport">{{ __('Sport') }}</option>
                    <option value="education">{{ __('Education') }}</option>
                    <option value="art">{{ __('Art') }}</option>
                    <option value="politique">{{ __('Politique') }}</option>
                    <option value="sante">{{ __('Sante') }}</option>
                </select>
                <x-input-error :messages="$errors->get('category')" class="mt-2 text-red-500 text-sm" />
            </div>

            <!-- Submit Button -->
            <div class="flex items-center justify-end">
                <x-primary-button class="ml-3 bg-yellow-500 hover:bg-yellow-600 focus:bg-yellow-700 active:bg-indigo-800 text-white py-2 px-4 rounded-md shadow-sm">
                    {{ __('Create') }}
                </x-primary-button>
            </div>
        </form>
    </x-tasks-card>
</x-app-layout>
