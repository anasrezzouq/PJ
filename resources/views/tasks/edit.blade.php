<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit a task') }}
        </h2>
    </x-slot>

    <x-tasks-card>
        <!-- Success Message -->
        @if (session()->has('message'))
            <div class="mt-3 mb-4 list-disc list-inside text-sm text-green-600">
                {{ session('message') }}
            </div>
        @endif

        <form action="{{ route('tasks.update', $task->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('put')

            <!-- Title -->
            <div>
                <x-input-label for="title" :value="__('Title')" />

                <x-text-input id="title" class="block mt-1 w-full" type="text" name="title" :value="old('title', $task->title)" required autofocus />

                <x-input-error :messages="$errors->get('title')" class="mt-2" />
            </div>

            <!-- Detail -->
            <div class="mt-4">
                <x-input-label for="detail" :value="__('Detail')" />

                <x-textarea class="block mt-1 w-full" id="detail" name="detail">{{ old('detail', $task->detail) }}</x-textarea>

                <x-input-error :messages="$errors->get('detail')" class="mt-2" />
            </div>

            <!-- Task Done -->
            <div class="block mt-4">
                <label for="state" class="inline-flex items-center">
                    <input id="state" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="state" @if(old('state', $task->state)) checked @endif>
                    <span class="ml-2 text-sm text-gray-600">{{ __('Task done') }}</span>
                </label>
            </div>

            <div class="mt-4">
                <x-input-label for="category" :value="__('Category')" />
                <select id="category" name="category" class="block mt-1 w-full rounded-md border-gray-300 shadow-sm">
                    <option value="sport">{{ __('Sport') }}</option>
                    <option value="education">{{ __('Education') }}</option>
                    <option value="art">{{ __('Art') }}</option>
                    <option value="politique">{{ __('Politique') }}</option>
                    <option value="sante">{{ __('Sante') }}</option>
                </select>
                <x-input-error :messages="$errors->get('category')" class="mt-2" />
            </div>

            <!-- Image -->
            <div class="mt-4">
                <x-input-label for="image" :value="__('Image')" />

                <x-text-input id="image" class="block mt-1 w-full" type="file" name="image" />

                <x-input-error :messages="$errors->get('image')" class="mt-2" />

                @if ($task->image_path)
                    <img src="{{ $task->image_url }}" alt="{{ $task->title }}" class="img-thumbnail mt-2" width="200">
                @endif
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-primary-button class="ml-3">
                    {{ __('Send') }}
                </x-primary-button>
            </div>
        </form>
    </x-tasks-card>
</x-app-layout>
