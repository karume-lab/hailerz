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
    <svg x-cloak x-show="darkMode" 
       class="col-start-1 row-start-1 h-5 w-5 text-current" 
       fill="none" stroke="currentColor" viewBox="0 0 24 24">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 9H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path>
    </svg>

    <!-- Moon Icon (visible in Light Mode) -->
    <svg x-cloak x-show="!darkMode" 
       class="col-start-1 row-start-1 h-5 w-5 text-current" 
       fill="none" stroke="currentColor" viewBox="0 0 24 24">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path>
    </svg>
  </div>
</button>