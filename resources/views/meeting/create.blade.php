<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight dark:text-gray-200">
            {{ __('Create New Event') }}
        </h2>
    </x-slot>

    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:w-8/12 md:w-1/2 lg:w-5/12">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-800 ">
                    <div class="p-4">
                        <form method="POST" action="{{ route('meeting.store') }}">
                            @csrf
                            <div class="row">
                                <div class="col-6 mb-3">
                                    <label class="form-label">イベント名</label>
                                    <input type="text" name="name" class="form-control">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6 mb-3">
                                    <label class="form-label">詳細</label>
                                    <textarea rows="5" name="description" class="form-control"></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6 mb-3">
                                    <label class="form-label">招待する部署</label>
                                    @foreach($groups as $group)
                                    <input type="checkbox" name="group_ids[]" value="{{ $group->id }}" id="group_{{ $group->id }}">
                                    <label for="group_{{ $group->id }}">{{ $group->name }}</label>

                                    <!-- 各グループに所属するユーザーの情報をhiddenフィールドとして追加 -->
                                    @foreach($group->groupUsers as $user)
                                    <input type="hidden" name="user_ids[{{ $group->id }}][]" value="{{ $user->id }}">
                                    @endforeach
                                    @endforeach
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">送信する</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>