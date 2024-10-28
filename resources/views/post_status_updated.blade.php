<!DOCTYPE html>
<html>
<head>
    <title>Post Status Update</title>
</head>
<body>
    <h1>Important Notification</h1>
    <p>Im here to inform you that your post
        titled <U>{{ $title }}</U>
        @if(is_string($message))
            {{ $message }}
        @else
            {{ json_encode($content) }}
        @endif
    </p>
</body>
</html>
