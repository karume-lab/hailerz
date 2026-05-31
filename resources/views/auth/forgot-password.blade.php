<x-layouts.auth>
    <x-slot:title>Forgot Password | Hailerz</x-slot>

    <form method="POST" action="{{ route('password.email') }}" class="auth-form">
        @csrf
        <p class="form-instruction">Enter your registered account email address below, and our automated queue network will compile and route a secure password reset link directly to your inbox.</p>

        <div class="input-group">
            <label for="email">Email Address</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus>
        </div>

        <button type="submit" class="btn-primary">Send Secure Password Reset Link</button>
    </form>

    <div class="auth-links">
        <p><a href="{{ route('login') }}">Back to Sign In</a></p>
    </div>
</x-layouts.auth>
