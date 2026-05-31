<x-layouts.auth>
    <x-slot:title>Sign In | Hailerz</x-slot>
    <x-slot:image>images/auth/sign-in.svg</x-slot>

    <h1 class="text-center text-3xl font-extrabold mb-10 text-text-primary">Welcome Back!</h1>

    <form method="POST" action="{{ route('login') }}" class="flex flex-col gap-6">
        @csrf
        <div class="flex flex-col relative">
            <label for="email" class="text-xs font-semibold text-text-secondary mb-1 uppercase tracking-wider">Email Address</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus placeholder="Enter your email" class="w-full py-2 bg-transparent border-0 border-b-2 border-text-muted text-base text-text-primary transition-colors duration-200 focus:outline-none focus:ring-0 focus:shadow-none! focus:border-t-transparent! focus:border-l-transparent! focus:border-r-transparent! focus:border-b-brand-primary!">
        </div>

        <div class="flex flex-col relative">
            <label for="password" class="text-xs font-semibold text-text-secondary mb-1 uppercase tracking-wider">Password</label>
            <input id="password" type="password" name="password" required placeholder="Enter your password" class="w-full py-2 bg-transparent border-0 border-b-2 border-text-muted text-base text-text-primary transition-colors duration-200 focus:outline-none focus:ring-0 focus:shadow-none! focus:border-t-transparent! focus:border-l-transparent! focus:border-r-transparent! focus:border-b-brand-primary!">
        </div>

        <div class="flex items-center justify-between mt-2">
            <label class="flex items-center gap-2 text-xs text-text-secondary font-medium">
                <input type="checkbox" name="remember" class="w-auto accent-brand-primary text-brand-primary focus:ring-brand-primary border-gray-300 rounded">
                Remember Me
            </label>
            
            <a href="{{ route('password.request') }}" class="text-xs text-text-muted no-underline hover:text-text-primary transition-colors">Forgot Your Password?</a>
        </div>

        <button type="submit" class="w-full mt-4 bg-brand-primary text-text-inverse p-4 rounded-full font-semibold text-base border-0 cursor-pointer transition-all duration-200 text-center hover:bg-brand-accent hover:-translate-y-px">Sign In</button>
    </form>

    <div class="mt-8 text-center text-sm text-text-secondary">
        <p>Don't have an account? <a href="{{ route('register') }}" class="text-brand-primary underline font-semibold hover:text-brand-accent transition-colors">Sign Up</a></p>
    </div>
</x-layouts.auth>
