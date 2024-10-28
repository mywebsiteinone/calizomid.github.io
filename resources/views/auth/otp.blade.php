@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="otp-verification">
            <h2>Verify Your OTP</h2>
            <form action="{{ route('otp.verify.post') }}" method="POST">
                @csrf
                <label for="otp">Enter the OTP sent to your email:</label>
                <input type="text" name="otp" id="otp" required>
                @error('otp')
                    <div class="error">{{ $message }}</div>
                @enderror
                <button type="submit">Verify OTP</button>
            </form>

            <div id="timer">
                Time remaining: <span id="countdown"></span>
            </div>
        </div>
    </div>

    <style>
        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f9f9f9;
        }

        .otp-verification {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            text-align: center;
            width: 300px;
        }

        h2 {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }

        input[type="text"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-weight: bold;
        }

        button:hover {
            background-color: #0056b3;
        }

        .error {
            color: red;
            margin-top: 10px;
        }

        #timer {
            margin-top: 20px;
            font-size: 16px;
        }
    </style>

    <script>
        // Set the time limit (in seconds)
        let timeLimit = 60; // Example: 60 seconds
        const countdownElement = document.getElementById('countdown');

        function updateCountdown() {
            const minutes = Math.floor(timeLimit / 60);
            const seconds = timeLimit % 60;

            countdownElement.innerText = `${minutes}:${seconds < 10 ? '0' : ''}${seconds}`;

            if (timeLimit > 0) {
                timeLimit--;
            } else {
                // Redirect to registration form
                window.location.href = "{{ route('register') }}";
            }
        }

        // Update the countdown every second
        setInterval(updateCountdown, 1000);
    </script>
@endsection
