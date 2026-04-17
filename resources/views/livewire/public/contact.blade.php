<div class="bg-white dark:bg-zinc-900 py-16 sm:py-24">
    <div class="mx-auto max-w-7xl px-6 lg:px-8">
        <div class="mx-auto max-w-2xl space-y-16 divide-y divide-gray-100 dark:divide-white/10 lg:mx-0 lg:max-w-none">
            <div class="grid grid-cols-1 gap-x-8 gap-y-10 lg:grid-cols-3">
                <div>
                    <h2 class="text-3xl font-bold tracking-tight text-gray-900 dark:text-white">Get in touch</h2>
                    <p class="mt-4 leading-6 text-gray-600 dark:text-gray-400">
                        Whether you're looking to book talent, discuss a partnership, or have a general inquiry, our team is here to help. Reach out to us using the form.
                    </p>
                </div>
                <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:col-span-2 lg:gap-8">
                    <div class="rounded-2xl bg-gray-50 dark:bg-white/5 p-10">
                        <h3 class="text-base font-semibold leading-7 text-gray-900 dark:text-white">Headquarters</h3>
                        <dl class="mt-3 space-y-1 text-sm leading-6 text-gray-600 dark:text-gray-400">
                            <div>
                                <dt class="sr-only">Address</dt>
                                <dd>123 Agency Suite<br>Creative District, NY 10001</dd>
                            </div>
                            <div class="mt-4">
                                <dt class="sr-only">Email</dt>
                                <dd><a class="font-semibold text-indigo-600 dark:text-indigo-400" href="mailto:hello@example.com">hello@example.com</a></dd>
                            </div>
                        </dl>
                    </div>
                </div>
            </div>

            <div class="pt-16 lg:grid lg:grid-cols-3 lg:gap-8">
                <h2 class="text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Send us a message</h2>
                <div class="lg:col-span-2">
                    @if (session('success'))
                        <div class="rounded-md bg-green-50 dark:bg-green-500/10 p-4 mb-6">
                            <div class="flex">
                                <div class="shrink-0">
                                    <svg class="h-5 w-5 text-green-400" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm font-medium text-green-800 dark:text-green-400">{{ session('success') }}</p>
                                </div>
                            </div>
                        </div>
                    @endif

                    <form wire:submit="submit" class="grid grid-cols-1 gap-y-6 sm:grid-cols-2 sm:gap-x-8">
                        <div>
                            <label for="name" class="block text-sm font-medium leading-6 text-gray-900 dark:text-white">Your name</label>
                            <div class="mt-2.5">
                                <input wire:model="name" type="text" id="name" class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 dark:bg-white/5 dark:text-white dark:ring-white/10 dark:focus:ring-indigo-500">
                            </div>
                            @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label for="email" class="block text-sm font-medium leading-6 text-gray-900 dark:text-white">Email</label>
                            <div class="mt-2.5">
                                <input wire:model="email" type="email" id="email" class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 dark:bg-white/5 dark:text-white dark:ring-white/10 dark:focus:ring-indigo-500">
                            </div>
                            @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
                        <div class="sm:col-span-2">
                            <label for="subject" class="block text-sm font-medium leading-6 text-gray-900 dark:text-white">Subject</label>
                            <div class="mt-2.5">
                                <input wire:model="subject" type="text" id="subject" class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 dark:bg-white/5 dark:text-white dark:ring-white/10 dark:focus:ring-indigo-500">
                            </div>
                            @error('subject') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
                        <div class="sm:col-span-2">
                            <label for="message" class="block text-sm font-medium leading-6 text-gray-900 dark:text-white">Message</label>
                            <div class="mt-2.5">
                                <textarea wire:model="message" id="message" rows="4" class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 dark:bg-white/5 dark:text-white dark:ring-white/10 dark:focus:ring-indigo-500"></textarea>
                            </div>
                            @error('message') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
                        <div class="sm:col-span-2 flex justify-end">
                            <button type="submit" class="rounded-md bg-indigo-600 px-3.5 py-2.5 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-offset-2 focus-visible:outline-indigo-600 dark:bg-indigo-500 dark:hover:bg-indigo-400">Send message</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
