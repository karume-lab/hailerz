<x-layouts.auth>
    <x-slot:title>Reset Password | Hailerz</x-slot>
    <x-slot:image>images/auth/sign-in.svg</x-slot>

    <h1 class="text-center text-3xl font-extrabold mb-10 text-text-primary">Choose New Password</h1>

    <form method="POST" action="{{ route('password.update') }}" class="flex flex-col gap-6">
        @csrf
        <input type="hidden" name="token" value="{{ $token }}">

        <x-input label="Email Address" id="email" type="email" name="email" :value="$email ?? old('email')" required autofocus />

        <x-input label="New Password" id="password" type="password" name="password" required placeholder="Enter new password" />

        <x-input label="Confirm New Password" id="password_confirmation" type="password" name="password_confirmation" required placeholder="Confirm new password" />

        <x-button type="submit" variant="primary" class="w-full mt-4">Reset Password</x-button>
    </form>
</x-layouts.auth>
