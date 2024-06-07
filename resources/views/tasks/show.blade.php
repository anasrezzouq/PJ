
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @lang('Blog')
        </h2>
    </x-slot>

    <div class="text-center pt-16 md:pt-32">
        <p class="text-sm md:text-base text-green-500 font-bold">{{ $task->created_at->format('d/m/Y') }}<span class="text-gray-900">/</span>{{Auth::user()->name}}</p>
        <h1 class="font-bold break-normal text-3xl md:text-4xl">{{ $task->title }}</h1>
    </div>

    <img class="container w-full max-w-6xl mx-auto bg-white bg-cover mt-8 rounded" style="height: 75vh;" src="{{ $task->image_path ? asset('storage/' . $task->image_path) : 'https://via.placeholder.com/400x300' }}" alt="{{ $task->title }}">

    <div class="container max-w-5xl mx-auto -mt-32 relative z-10">
        <div class="mx-0 sm:mx-6">
            <div class="bg-white w-full p-8 md:p-24 text-xl md:text-2xl text-gray-800 leading-normal" style="font-family:Georgia,serif;">
                <p class="text-2xl md:text-3xl mb-5">{{ $task->detail }}</p>
                <form action="{{ route('tasks.toggleLike', $task->id) }}" method="POST">
        @csrf
        <button type="submit">
            <span>
                <!-- Display heart icon based on like status -->
                @if($task->likedBy(auth()->user()))
                    <i class="fa-solid fa-heart w-100">like</i>
                @else
                    <i class="fa-regular fa-heart"></i>
                @endif
                <!-- Display number of likes -->
                {{ $likesCount }}
            </span>
        </button>
    </form>
            </div>
            
        </div>
        
    </div>
    
    <section class="py-8 lg:py-16 antialiased bg-gray">
        <div class="max-w-2xl mx-auto px-4">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-lg lg:text-2xl font-bold text-black">Discussion ({{ $task->comments->count() }})</h2>
            </div>

            <form action="{{ route('comments.store', $task->id) }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="comment">Your Comment</label>
                    <textarea name="comment" id="comment" rows="6" class="px-0 w-full text-sm text-gray-900 border-0 focus:ring-0 focus:outline-none dark:text-black dark:placeholder-gray-400 bg-white rounded overflow-hidden shadow-md hover:shadow-lg relative smooth" required></textarea>
                </div>
                <button type="submit" class="inline-flex items-center py-2.5 px-4 text-xs font-medium text-center text-black bg-yellow-400 rounded-lg">
                    Post comment
                </button>
            </form>

            @foreach($task->comments as $comment)
            <article class="p-6 text-base bg-white rounded overflow-hidden shadow-md hover:shadow-lg relative smooth m-6">
                <footer class="flex justify-between items-center mb-2">
                    <div class="flex items-center">
                        <p class="inline-flex items-center mr-3 text-sm text-gray-900  font-semibold">
                            <img class="mr-2 w-6 h-6 rounded-full "  alt="Michael Gough">{{ $comment->user->name }}
                        </p>
                        <p class="text-sm text-gray-600 dark:text-gray-400"><time pubdate datetime="{{ $comment->created_at->toIso8601String() }}" title="{{ $comment->created_at->format('d/m/Y') }}">{{ $comment->created_at->diffForHumans() }}</time></p>
                    </div>

                    <!-- Dropdown menu -->
                    <div id="dropdownComment{{ $comment->id }}" class="w-25 bg-yellow-400 rounded text-black">
                        <ul class="py-1 text-sm" aria-labelledby="dropdownMenuIconHorizontalButton">
                            <li>
                                <form action="{{ route('comments.destroy', $comment->id) }}" method="POST" class="block py-2 px-4  ">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit">Remove <i class="fa-sharp fa-solid fa-trash"></i></button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </footer>
                <p class="text-gray-500 dark:text-gray-400">{{ $comment->comment }}</p>
                <div class="flex items-center mt-4 space-x-4">
                    <button type="button" class="flex items-center text-sm text-gray-500 hover:underline dark:text-gray-400 font-medium">
                        <svg class="mr-1.5 w-3.5 h-3.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 18">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5h5M5 8h2m6-3h2m-5 3h6m2-7H2a1 1 0 0 0-1 1v9a1 1 0 0 0 1 1h3v5l5-5h8a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1Z"/>
                        </svg>
                        Reply
                    </button>
                </div>
            </article>
            @endforeach
        </div>
    </section>

    <div class="bg-gray">
        <div class="container w-full max-w-6xl mx-auto px-2 py-8">
            <h1 class="font-bold break-normal text-3xl md:text-5xl text-center uppercase">read more</h1>
            <div class="flex flex-wrap -mx-2">
                <div class="w-full md:w-1/3 px-2 pb-12">
                    <div class="h-full bg-white rounded overflow-hidden shadow-md hover:shadow-lg relative smooth">
                        <a href="#" class="no-underline hover:no-underline">
                            <img class="w-full h-48 object-cover" src="{{ $task->image_path ? asset('storage/' . $task->image_path) : 'https://via.placeholder.com/400x300' }}" alt="{{ $task->title }}">
                            <div class="p-6 h-auto md:h-48">
                                <div class="font-bold text-xl text-gray-900">{{ $task->title }}</div>
                                <p class="text-gray-800 font-serif text-base mb-5 line-clamp-3">
                                    {{ $task->detail }}
                                </p>
                            </div>
                            <div class="flex items-center justify-between inset-x-0 bottom-0 p-6">
                                <img class="w-8 h-8 rounded-full mr-4" src="http://i.pravatar.cc/300" alt="Avatar of Author">
                                <p class="text-gray-600 text-xs md:text-sm">{{ $task->created_at->format('d/m/Y') }}</p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    

    {{-- <form action="{{ route('jaime.unlike', $task->id) }}" method="POST">
        @csrf
        <button type="submit">Unlike</button>
    </form> --}}


    
</x-app-layout>
