<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight dark:text-gray-200">
            {{ __('Meeting Attendance') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:w-8/12 md:w-1/2 lg:w-5/12">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-800">
                    <div class="p-4">
                        <form method="POST" action="{{ route('meeting_attendance.update', $meeting->id) }}">
                            @csrf
                            @method('PUT')
                            <div class="mb-4">
                                <p>「<span class="text-gray-dark dark:text-gray-200 font-semibold">{{ $meeting->name }}</span>」への出欠はどうしますか？</p>
                            </div>
                            <div class="mb-4">
                                @foreach($attendance_types as $id => $type)
                                <label>
                                    <input type="radio" name="type_id" value="{{ $id }}" required> {{ $type }}
                                </label>
                                @endforeach
                            </div>
                            <span class="badge bg-primary mb-4">現在の出欠状況</span>
                            <div class="p-3 bg-light">
                                @foreach($grouped_attendances as $id => $attendances)

                                <div>
                                    {{ $attendance_types[$id] }}: {{ $attendances->count() }}人
                                </div>

                                @endforeach
                            </div>
                            <div class="flex items-center mt-4">
                                <x-primary-button class="ml-3">
                                    {{ __('送信する') }}
                                </x-primary-button>
                            </div>
                            <div class="flex items-center justify-end mt-4">
                                <a href="{{ url()->previous() }}">
                                    <x-secondary-button class="ml-3">
                                        {{ __('Back') }}
                                        </x-primary-button>
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>