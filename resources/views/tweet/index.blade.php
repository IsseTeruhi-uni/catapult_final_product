<!-- resources/views/tweet/index.blade.php -->

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight dark:text-gray-200">
            {{ __('Timeline') }}
        </h2>
    </x-slot>
    <div class="py-6">
        <div class="max-w-md mx-auto sm:w-10/12 md:w-8/12 lg:w-6/12">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-800 ">
                    @include('common.errors')
                    <form class="mb-6" action="{{ route('tweet.store') }}" method="POST">
                        @csrf
                        <div class="flex flex-col mb-4">
                            <x-input-label for="tweet" :value="__('Tweet')" />
                            <x-text-input id="tweet" class="block mt-1 w-full" type="text" name="tweet" :value="old('tweet')" required autofocus />
                            <x-input-error :messages="$errors->get('tweet')" class="mt-2" />
                        </div>
                        <div class="flex flex-col mb-4">
                            <x-input-label for="description" :value="__('Description')" />
                            <x-text-input id="description" class="block mt-1 w-full" type="text" name="description" :value="old('description')" required autofocus />
                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                        </div>
                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button class="ml-3">
                                {{ __('投稿') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:w-10/12 md:w-8/10 lg:w-8/12">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white dark:bg-gray-800 border-b border-grey-200 dark:border-gray-800">
                    <table class="text-center w-full border-collapse">
                        <thead>
                            <tr>
                                <th class="py-4 px-6 bg-gray-lightest dark:bg-gray-darkest font-bold uppercase text-lg text-gray-dark dark:text-gray-200 border-b border-grey-light dark:border-grey-dark">X</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($sorted as $item)
                            @if ($item instanceof \App\Models\Tweet)
                            <tr class="hover:bg-gray-lighter">
                                <td class="py-4 px-6 border-b border-gray-light dark:border-gray-600">
                                    <div class="flex">
                                        <!-- 🔽 編集 -->
                                        <a href="{{ route('employees.show', $item->user->id) }}">
                                            <p class="text-gray-dark dark:text-gray-200 font-semibold">{{$item->user->name}}</p>
                                        </a>
                                        <div style="margin-left: 1cm;">
                                            <p class="text-gray-dark dark:text-gray-200">{{ $item->updated_at }}</p>
                                            <!-- 🔼 ここまで -->
                                        </div>
                                    </div>
                                    <h3 class="text-gray-dark dark:text-gray-200" style="text-align: left;">{{$item->description}}</h3>

                                    <div class="flex">
                                        <!-- 条件分岐でログインしているユーザが投稿したtweetのみ編集ボタンと削除ボタンが表示される -->
                                        @if ($item->user_id === Auth::user()->id)
                                        <!-- 更新ボタン -->
                                        <form action="{{ route('tweet.edit',$item->id) }}" method="GET" class="text-left">
                                            @csrf
                                            <x-primary-button class="ml-3 bg-white">
                                                <svg class="h-6 w-6 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="gray">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                </svg>
                                            </x-primary-button>
                                        </form>
                                        <!-- 削除ボタン -->
                                        <form action="{{ route('tweet.destroy',$item->id) }}" method="POST" class="text-left">
                                            @method('delete')
                                            @csrf
                                            <x-primary-button class="ml-3 bg-white">
                                                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="gray">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </x-primary-button>
                                        </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            @endif
                            @if ($item instanceof \App\Models\Blog)
                            <tr class="hover:bg-gray-lighter">
                                <td class="py-4 px-6 border-b border-gray-light dark:border-gray-600" style="background-image: linear-gradient(to left, rgba(255, 255, 0, 0.2), rgba(255, 255, 0, 0.2) 100%, white 100%)">
                                    <div class="flex">
                                        <!-- 🔽 編集 -->
                                        <p class="text-gray-dark dark:text-gray-200 font-semibold">{{$item->tweet}}</p>
                                        <div style="margin-left: 1cm;">
                                            <p class="text-gray-dark dark:text-gray-200">{{ $item->updated_at }}</p>
                                            <!-- 🔼 ここまで -->
                                        </div>
                                    </div>
                                    <h3 class="text-gray-dark dark:text-gray-200" style="text-align: left;">{{$item->description}}</h3>
                                </td>
                            </tr>
                            @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>