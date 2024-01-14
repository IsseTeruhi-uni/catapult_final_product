<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight dark:text-gray-200">
            {{ __('Create New Event') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:w-8/12 md:w-1/2 lg:w-5/12">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-800">
                    <div class="p-4">
                        <form method="POST" action="{{ route('meeting.store') }}">
                            @csrf
                            <div class="mb-4">
                                <label class="block text-gray-700 dark:text-gray-400 text-sm font-bold mb-2">イベント名</label>
                                <input type="text" name="name" class="form-input w-full" required>
                            </div>
                            <div class="mb-4">
                                <label class="block text-gray-700 dark:text-gray-400 text-sm font-bold mb-2">詳細</label>
                                <textarea rows="5" name="description" class="form-input w-full" required></textarea>
                            </div>
                            <div class="mb-4">
                                <label class="block text-gray-700 dark:text-gray-400 text-sm font-bold mb-2">招待する部署</label>
                                @foreach($groups as $group)
                                <div class="flex items-center mb-2">
                                    <input type="checkbox" name="group_ids[]" value="{{ $group->id }}" id="group_{{ $group->id }}" class="mr-2">
                                    <label for="group_{{ $group->id }}" class="text-sm">{{ $group->name }}</label>
                                    @foreach($group->groupUsers as $user)
                                    <input type="hidden" name="user_ids[{{ $group->id }}][]" value="{{ $user->id }}">
                                    @endforeach
                                </div>
                                @endforeach
                            </div>
                            <div class="flex items-center mt-4">
                                <x-primary-button class="ml-3">
                                    {{ __('送信する') }}
                                </x-primary-button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>