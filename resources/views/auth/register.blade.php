<x-layouts.auth>
    <x-slot:title>Register Account | Hailerz</x-slot>
    <x-slot:image>images/auth/sign-up.svg</x-slot>

    <h1 class="text-center text-3xl font-extrabold mb-10 text-text-primary">Create an Account</h1>

    <form method="POST" action="{{ route('register') }}" class="flex flex-col gap-6">
        @csrf
        <x-input label="Full Name" id="name" type="text" name="name" :value="old('name')" required autofocus placeholder="Enter your full name" />

        <x-input label="Email Address" id="email" type="email" name="email" :value="old('email')" required placeholder="Enter your email" />

        <x-select label="Select Your Core Platform Role" id="role" name="role" required>
            <option value="getting_talent" {{ old('role') === 'getting_talent' ? 'selected' : '' }}>Getting Talent (Client / Brand) - Hire creatives & organizers</option>
            <option value="actual_talent" {{ old('role') === 'actual_talent' ? 'selected' : '' }}>Actual Talent (Creator / Pro) - Set up your portfolio & rates</option>
            <option value="student_creative" {{ old('role') === 'student_creative' ? 'selected' : '' }}>Student / Aspiring Creative - Learn, practice, & build your portfolio</option>
        </x-select>

        <x-input label="Password" id="password" type="password" name="password" required placeholder="Create a password" />

        <x-input label="Confirm Password" id="password_confirmation" type="password" name="password_confirmation" required placeholder="Confirm your password" />

        <x-button type="submit" variant="primary" class="w-full mt-4">Sign Up</x-button>
    </form>

    <div class="mt-8 text-center text-sm text-text-secondary">
        <p>Already have an account? <a href="{{ route('login') }}" class="text-brand-primary underline font-semibold hover:text-brand-accent transition-colors">Sign In</a></p>
    </div>
</x-layouts.auth>
