@extends('layouts.app')

@section('content')
<div class="container d-flex justify-content-center align-items-center min-vh-100">
    <div class="card shadow" style="width: 400px;">
        <div class="card-body">
            <h1 class="text-center mb-4">Verify OTP</h1>

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('otp.login.verify') }}">
                @csrf
                <div class="form-group">
                    <label for="otp">Enter OTP</label>
                    <input type="text" name="otp" class="form-control" id="otp" required>
                </div>
                <button type="submit" class="btn btn-primary btn-block">Verify OTP</button>
            </form>
        </div>
    </div>
</div>
@endsection
