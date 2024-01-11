<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight dark:text-gray-200">
            {{ __('Event') }}
        </h2>
    </x-slot>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:w-10/12 md:w-8/10 lg:w-8/12">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white dark:bg-gray-800 border-b border-grey-200 dark:border-gray-800">
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight dark:text-gray-200">
                        {{ __('招待されているイベント一覧') }}
                    </h2>


                    @foreach ($meetings as $meeting)
                    @php
                    $attendance = $meeting->attendances()->where('user_id', auth()->id())->first();
                    @endphp
                    @if ($attendance)
                    <a href="{{ route('meeting_attendance.edit', $meeting->id) }}">
                        <div class="scale-100 p-6 bg-white dark:bg-gray-800/50 dark:bg-gradient-to-bl from-gray-700/50 via-transparent dark:ring-1 dark:ring-inset dark:ring-white/5 rounded-lg shadow-2xl shadow-gray-500/20 dark:shadow-none flex motion-safe:hover:scale-[1.01] transition-all duration-250 focus:outline focus:outline-2 focus:outline-red-500 mt-6" style="background-image: linear-gradient(135deg, rgba(255, 165, 0, 0.2), white);">
                            <div>
                                <h2 class="mt-2 text-xl font-semibold text-gray-900 dark:text-white">{{$meeting->name}}</h2>
                                <p class="mt-2 text-gray-500 dark:text-gray-400 text-sm leading-relaxed">{{$meeting->description}}</p>
                            </div>
                        </div>
                    </a>
                    @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>