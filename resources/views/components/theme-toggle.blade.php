<button x-data="{ 
    darkMode: localStorage.getItem('theme') === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches),
    toggleTheme() {
      this.darkMode = !this.darkMode;
      localStorage.setItem('theme', this.darkMode ? 'dark' : 'light');
      if (this.darkMode) {
        document.documentElement.classList.add('dark');
      } else {
        document.documentElement.classList.remove('dark');
      }
    }
  }" 
  @click="toggleTheme()"
  {{ $attributes->merge(['class' => 'inline-flex items-center justify-center p-2 rounded-xl bg-gray-50 dark:bg-white/5 text-gray-950 dark:text-white hover:text-primary-600 dark:hover:text-primary-400 transition-all duration-300 focus:outline-none border border-gray-200 dark:border-white/10 shadow-sm']) }}
  title="Toggle dark mode"
  aria-label="Toggle Dark Mode">
  
  <div class="grid grid-cols-1 grid-rows-1 w-5 h-5">
    <!-- Sun Icon (visible in Dark Mode) -->
    <x-lucide-sun class="col-start-1 row-start-1 h-5 w-5 text-current" x-cloak x-show="darkMode" />

    <!-- Moon Icon (visible in Light Mode) -->
    <x-lucide-moon class="col-start-1 row-start-1 h-5 w-5 text-current" x-cloak x-show="!darkMode" />
  </div>
</button>