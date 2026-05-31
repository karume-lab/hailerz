<x-layouts.auth>
    <x-slot:title>Register Account | Hailerz</x-slot>
    <x-slot:image>images/auth/sign-up.svg</x-slot>

    <h1 class="text-center text-3xl font-extrabold mb-10 text-text-primary">Create an Account</h1>

    <form method="POST" action="{{ route('register') }}" class="flex flex-col gap-6">
        @csrf
        <div class="flex flex-col relative">
            <label for="name" class="text-xs font-semibold text-text-secondary mb-1 uppercase tracking-wider">Full Name</label>
            <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus placeholder="Enter your full name" class="w-full py-2 bg-transparent border-0 border-b-2 border-text-muted text-base text-text-primary transition-colors duration-200 focus:outline-none focus:ring-0 focus:shadow-none! focus:border-t-transparent! focus:border-l-transparent! focus:border-r-transparent! focus:border-b-brand-primary!">
        </div>

        <div class="flex flex-col relative">
            <label for="email" class="text-xs font-semibold text-text-secondary mb-1 uppercase tracking-wider">Email Address</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required placeholder="Enter your email" class="w-full py-2 bg-transparent border-0 border-b-2 border-text-muted text-base text-text-primary transition-colors duration-200 focus:outline-none focus:ring-0 focus:shadow-none! focus:border-t-transparent! focus:border-l-transparent! focus:border-r-transparent! focus:border-b-brand-primary!">
        </div>

        <div class="flex flex-col relative">
            <label for="role" class="text-xs font-semibold text-text-secondary mb-1 uppercase tracking-wider">Select Your Core Platform Role</label>
            <select id="role" name="role" required class="w-full py-2 bg-transparent border-0 border-b-2 border-text-muted text-base text-text-primary transition-colors duration-200 focus:outline-none focus:ring-0 focus:shadow-none! focus:border-t-transparent! focus:border-l-transparent! focus:border-r-transparent! focus:border-b-brand-primary!">
                <option value="getting_talent" {{ old('role') === 'getting_talent' ? 'selected' : '' }}>Getting Talent (Client / Brand) - Hire creatives & organizers</option>
                <option value="actual_talent" {{ old('role') === 'actual_talent' ? 'selected' : '' }}>Actual Talent (Creator / Pro) - Set up your portfolio & rates</option>
                <option value="student_creative" {{ old('role') === 'student_creative' ? 'selected' : '' }}>Student / Aspiring Creative - Learn, practice, & build your portfolio</option>
            </select>
        </div>

        <div class="flex flex-col relative">
            <label for="password" class="text-xs font-semibold text-text-secondary mb-1 uppercase tracking-wider">Password</label>
            <input id="password" type="password" name="password" required placeholder="Create a password" class="w-full py-2 bg-transparent border-0 border-b-2 border-text-muted text-base text-text-primary transition-colors duration-200 focus:outline-none focus:ring-0 focus:shadow-none! focus:border-t-transparent! focus:border-l-transparent! focus:border-r-transparent! focus:border-b-brand-primary!">
        </div>

        <div class="flex flex-col relative">
            <label for="password_confirmation" class="text-xs font-semibold text-text-secondary mb-1 uppercase tracking-wider">Confirm Password</label>
            <input id="password_confirmation" type="password" name="password_confirmation" required placeholder="Confirm your password" class="w-full py-2 bg-transparent border-0 border-b-2 border-text-muted text-base text-text-primary transition-colors duration-200 focus:outline-none focus:ring-0 focus:shadow-none! focus:border-t-transparent! focus:border-l-transparent! focus:border-r-transparent! focus:border-b-brand-primary!">
        </div>

        <button type="submit" class="w-full mt-4 bg-brand-primary text-text-inverse p-4 rounded-full font-semibold text-base border-0 cursor-pointer transition-all duration-200 text-center hover:bg-brand-accent hover:-translate-y-px">Sign Up</button>
    </form>

    <div class="mt-8 text-center text-sm text-text-secondary">
        <p>Already have an account? <a href="{{ route('login') }}" class="text-brand-primary underline font-semibold hover:text-brand-accent transition-colors">Sign In</a></p>
    </div>
</x-layouts.auth>
