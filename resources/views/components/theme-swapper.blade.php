<div>
    <label class="swap swap-rotate">
        <!-- this hidden checkbox controls the state -->
        <input id="theme-toggle" class="theme-controller" type="checkbox" value="night" />

        <!-- sun icon -->
        <x-lucide-sun class="swap-off h-8 w-8 fill-warning text-orange-300" />

        <!-- moon icon -->
        <x-lucide-moon class="swap-on h-8 w-8 fill-warning text-warning/75" />

    </label>

    <script>
        const themeToggle = document.getElementById('theme-toggle');
        const html = document.documentElement;

        // Load saved theme
        const savedTheme = localStorage.getItem('theme') || 'corporate';
        html.setAttribute('data-theme', savedTheme);
        themeToggle.checked = savedTheme === 'night';

        // Handle theme change
        themeToggle.addEventListener('change', () => {
            const newTheme = themeToggle.checked ? 'night' : 'corporate';
            html.setAttribute('data-theme', newTheme);
            localStorage.setItem('theme', newTheme);
        });
    </script>
</div>
