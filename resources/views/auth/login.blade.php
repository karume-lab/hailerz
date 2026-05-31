<x-layouts.auth>
    <x-slot:title>Sign In | Hailerz</x-slot>
    <x-slot:image>images/auth/sign-in.svg</x-slot>

    <h1 class="text-center text-3xl font-extrabold mb-10 text-text-primary">Welcome Back!</h1>

    <form method="POST" action="{{ route('login') }}" class="flex flex-col gap-6">
        @csrf
        <x-input label="Email Address" id="email" type="email" name="email" :value="old('email')" required autofocus placeholder="Enter your email" />

        <x-input label="Password" id="password" type="password" name="password" required placeholder="Enter your password" />

        <div class="flex items-center justify-between mt-2 px-2">
            <label class="flex items-center gap-2 text-xs text-text-secondary font-medium cursor-pointer group">
                <input type="checkbox" name="remember" class="w-4 h-4 accent-brand-primary text-brand-primary focus:ring-brand-primary border-subtle rounded transition-colors group-hover:border-brand-primary cursor-pointer">
                Remember Me
            </label>
            
            <a href="{{ route('password.request') }}" class="text-xs font-bold text-text-muted no-underline hover:text-brand-primary transition-colors tracking-widest uppercase">Forgot Password?</a>
        </div>

        <x-button type="submit" variant="primary" class="w-full mt-4">Sign In</x-button>
    </form>

    <div class="mt-8 text-center text-sm text-text-secondary">
        <p>Don't have an account? <a href="{{ route('register') }}" class="text-brand-primary underline font-semibold hover:text-brand-accent transition-colors">Sign Up</a></p>
    </div>
</x-layouts.auth>
