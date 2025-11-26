<div x-data="themeSwapper()" x-init="init()">
    <label class="swap swap-rotate">
        <!-- this hidden checkbox controls the state -->
        <input class="theme-controller" type="checkbox" x-bind:checked="isDark" @change="toggleTheme()" />

        <!-- sun icon -->

        <x-lucide-sun class="swap-off h-10 w-10 fill-warning text-orange-300" />

        <!-- moon icon -->
        <x-lucide-moon class="swap-on h-10 w-10 fill-warning text-transparent" />

    </label>
</div>

<script>
function themeSwapper() {
    return {
        isDark: false,
        init() {
            this.isDark = localStorage.getItem('theme') === 'night';
            this.applyTheme();
        },
        toggleTheme() {
            this.isDark = !this.isDark;
            this.applyTheme();
            localStorage.setItem('theme', this.isDark ? 'night' : 'corporate');
        },
        applyTheme() {
            document.documentElement.setAttribute('data-theme', this.isDark ? 'night' : 'corporate');
        }
    }
}
</script>
