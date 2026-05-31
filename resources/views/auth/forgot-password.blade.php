<x-layouts.auth>
    <x-slot:title>Forgot Password | Hailerz</x-slot>
    <x-slot:image>images/auth/sign-in.svg</x-slot>

    <h1 class="text-center text-3xl font-extrabold mb-6 text-text-primary">Reset Password</h1>

    <form method="POST" action="{{ route('password.email') }}" class="flex flex-col gap-6">
        @csrf
        <p class="text-sm text-text-secondary text-center mb-4 leading-relaxed">Enter your registered account email address below, and our automated queue network will compile and route a secure password reset link directly to your inbox.</p>

        <x-input label="Email Address" id="email" type="email" name="email" :value="old('email')" required autofocus placeholder="Enter your email" />

        <x-button type="submit" variant="primary" class="w-full mt-4">Send Reset Link</x-button>
    </form>

    <div class="mt-8 text-center text-sm text-text-secondary">
        <p><a href="{{ route('login') }}" class="text-brand-primary underline font-semibold hover:text-brand-accent transition-colors">Back to Sign In</a></p>
    </div>
</x-layouts.auth>
