<!DOCTYPE html>
<html>

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="p-4">
        <form method="POST" action="{{ route('meeting.store') }}">
            @csrf
            <div class="row">
                <div class="col-6 mb-3">
                    <label class="form-label">イベント名（ミーティング名）</label>
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
                    <label class="form-label">招待するユーザー</label>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js"></script>
</body>

</html>