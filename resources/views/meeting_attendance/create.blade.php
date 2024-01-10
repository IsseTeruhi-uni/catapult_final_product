<!DOCTYPE html>
<html>

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="p-4">
        <div class="mb-3">
            <form action="{{ route('meeting_attendance.update', $meeting->id) }}" method="POST">
                @csrf
                @method('PUT')
                <p>「<strong>{{ $meeting->name }}</strong>」への出欠はどうしますか？</p>
                <div class="mt-3 mb-4">
                    @foreach($attendance_types as $id => $type)
                    <label>
                        <input type="radio" name="type_id" value="{{ $id }}" onclick="submitForm()"> {{ $type }}
                    </label>
                    @endforeach
                </div>
                <span class="badge bg-primary mb-2">現在の出欠状況</span>
                <div class="p-3 bg-light">
                    @foreach($grouped_attendances as $id => $attendances)
                    <div>
                        {{ $attendance_types[$id] }}: {{ $attendances->count() }}人
                    </div>
                    @endforeach
                </div>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js"></script>
    <script>
        function submitForm() {
            if (confirm('送信します。よろしいですか？')) {
                document.forms[0].submit();
            }
        }
    </script>
</body>

</html>