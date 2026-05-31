<x-layouts.auth>
    <x-slot:title>Reset Password | Hailerz</x-slot>

    <form method="POST" action="{{ route('password.update') }}" class="auth-form">
        @csrf
        <input type="hidden" name="token" value="{{ $token }}">

        <div class="input-group">
            <label for="email">Email Address</label>
            <input id="email" type="email" name="email" value="{{ $email ?? old('email') }}" required autofocus>
        </div>

        <div class="input-group">
            <label for="password">New Password</label>
            <input id="password" type="password" name="password" required>
        </div>

        <div class="input-group">
            <label for="password_confirmation">Confirm New Password</label>
            <input id="password_confirmation" type="password" name="password_confirmation" required>
        </div>

        <button type="submit" class="btn-primary">Reset Password</button>
    </form>
</x-layouts.auth>
