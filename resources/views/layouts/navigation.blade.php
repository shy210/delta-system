<nav
    x-data="{ open: false }"
    class="relative"
>
    {{-- ============================================================
         SIDEBAR DESKTOP
    ============================================================= --}}
    <aside
        class="fixed inset-y-0 left-0 z-50 hidden w-72 flex-col border-r border-slate-200 bg-white transition-colors duration-300 lg:flex dark:border-slate-800 dark:bg-slate-900"
    >
        {{-- Logo --}}
        <div class="flex h-20 items-center border-b border-slate-200 px-6 dark:border-slate-800">
            <a href="{{ route('dashboard') }}" class="group flex items-center gap-3">
                <div
                    class="flex h-11 w-11 items-center justify-center rounded-xl bg-slate-900 text-xl font-extrabold text-white shadow-lg shadow-slate-900/20 transition duration-300 group-hover:scale-105 dark:bg-white dark:text-slate-900"
                >
                    Δ
                </div>

                <div>
                    <div class="text-lg font-extrabold tracking-tight text-slate-900 dark:text-white">
                        DELTA
                    </div>

                    <div class="text-[10px] font-semibold uppercase tracking-[0.25em] text-slate-400">
                        System
                    </div>
                </div>
            </a>
        </div>

        {{-- Usuario --}}
        <div class="border-b border-slate-200 px-5 py-5 dark:border-slate-800">
            <div class="flex items-center gap-3">
                <div
                    class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-slate-100 font-bold text-slate-700 dark:bg-slate-800 dark:text-slate-200"
                >
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                </div>

                <div class="min-w-0">
                    <p class="truncate text-sm font-semibold text-slate-900 dark:text-white">
                        {{ Auth::user()->name }}
                    </p>

                    <p class="truncate text-xs text-slate-500 dark:text-slate-400">
                        {{ ucfirst(Auth::user()->role) }}
                    </p>
                </div>
            </div>
        </div>

        {{-- Navegación --}}
        <div class="flex-1 overflow-y-auto px-4 py-6">

            <p class="mb-3 px-3 text-[10px] font-bold uppercase tracking-[0.2em] text-slate-400">
                Principal
            </p>

            <div class="space-y-1">

                {{-- Dashboard --}}
                <a
                    href="{{ route('dashboard') }}"
                    class="group flex items-center gap-3 rounded-xl px-3 py-3 text-sm font-medium transition-all duration-200
                    {{ request()->routeIs('dashboard')
                        ? 'bg-slate-900 text-white shadow-lg shadow-slate-900/10 dark:bg-white dark:text-slate-900'
                        : 'text-slate-600 hover:bg-slate-100 hover:text-slate-900 dark:text-slate-400 dark:hover:bg-slate-800 dark:hover:text-white' }}"
                >
                    <svg
                        class="h-5 w-5 shrink-0 transition-transform duration-200 group-hover:scale-110"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="1.8"
                            d="M3 13h8V3H3v10zm10 8h8V11h-8v10zM3 21h8v-6H3v6zm10-18v4h8V3h-8z"
                        />
                    </svg>

                    <span>Panel principal</span>
                </a>

                {{-- Sucursales --}}
                @if(in_array(auth()->user()->role, ['admin', 'employee']))
                    <a
                        href="{{ route('branches.index') }}"
                        class="group flex items-center gap-3 rounded-xl px-3 py-3 text-sm font-medium transition-all duration-200
                        {{ request()->routeIs('branches.*')
                            ? 'bg-slate-900 text-white shadow-lg shadow-slate-900/10 dark:bg-white dark:text-slate-900'
                            : 'text-slate-600 hover:bg-slate-100 hover:text-slate-900 dark:text-slate-400 dark:hover:bg-slate-800 dark:hover:text-white' }}"
                    >
                        <svg
                            class="h-5 w-5 shrink-0 transition-transform duration-200 group-hover:scale-110"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="1.8"
                                d="M3 21h18M5 21V5l7-3 7 3v16M9 21v-4h6v4M9 9h1m4 0h1m-6 4h1m4 0h1"
                            />
                        </svg>

                        <span>Sucursales</span>
                    </a>

                    {{-- Clientes --}}
                    <a
                        href="{{ route('customers.index') }}"
                        class="group flex items-center gap-3 rounded-xl px-3 py-3 text-sm font-medium transition-all duration-200
                        {{ request()->routeIs('customers.*')
                            ? 'bg-slate-900 text-white shadow-lg shadow-slate-900/10 dark:bg-white dark:text-slate-900'
                            : 'text-slate-600 hover:bg-slate-100 hover:text-slate-900 dark:text-slate-400 dark:hover:bg-slate-800 dark:hover:text-white' }}"
                    >
                        <svg
                            class="h-5 w-5 shrink-0 transition-transform duration-200 group-hover:scale-110"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="1.8"
                                d="M16 21v-2a4 4 0 00-4-4H6a4 4 0 00-4 4v2M9 11a4 4 0 100-8 4 4 0 000 8zm7-2a3 3 0 110-6 3 3 0 010 6zm0 4a4 4 0 014 4v2"
                            />
                        </svg>

                        <span>Clientes</span>
                    </a>
                @endif

            </div>

            {{-- Administración --}}
            @if(auth()->user()->role === 'admin')

                <p class="mb-3 mt-8 px-3 text-[10px] font-bold uppercase tracking-[0.2em] text-slate-400">
                    Administración
                </p>

                <div class="space-y-1">
                    <div
                        class="flex cursor-default items-center gap-3 rounded-xl px-3 py-3 text-sm font-medium text-slate-400 dark:text-slate-600"
                    >
                        <svg
                            class="h-5 w-5"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="1.8"
                                d="M12 6v6l4 2"
                            />

                            <circle
                                cx="12"
                                cy="12"
                                r="9"
                                stroke-width="1.8"
                            />
                        </svg>

                        <span>Más módulos</span>

                        <span class="ml-auto rounded-md bg-slate-100 px-2 py-1 text-[9px] font-bold uppercase dark:bg-slate-800">
                            Próximo
                        </span>
                    </div>
                </div>

            @endif

        </div>

        {{-- Parte inferior --}}
        <div class="border-t border-slate-200 p-4 dark:border-slate-800">

            {{-- Tema --}}
            <button
                type="button"
                onclick="window.toggleDeltaTheme()"
                class="mb-2 flex w-full items-center gap-3 rounded-xl px-3 py-3 text-sm font-medium text-slate-600 transition-all duration-200 hover:bg-slate-100 hover:text-slate-900 dark:text-slate-400 dark:hover:bg-slate-800 dark:hover:text-white"
            >
                <span class="flex h-8 w-8 items-center justify-center rounded-lg bg-slate-100 dark:bg-slate-800">

                    <svg
                        class="hidden h-4 w-4 dark:block"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="1.8"
                            d="M12 3v1m0 16v1m9-9h-1M4 12H3m16.364-6.364-.707.707M5.343 18.657l-.707.707m13.021 0-.707-.707M6.05 6.05l-.707-.707M12 16a4 4 0 100-8 4 4 4 0 000 8z"
                        />
                    </svg>

                    <svg
                        class="h-4 w-4 dark:hidden"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="1.8"
                            d="M21 12.79A9 9 0 1111.21 3 7 7 0 0021 12.79z"
                        />
                    </svg>

                </span>

                <span>
                    <span class="dark:hidden">
                        Modo oscuro
                    </span>

                    <span class="hidden dark:inline">
                        Modo claro
                    </span>
                </span>
            </button>

            {{-- Perfil --}}
            <a
                href="{{ route('profile.edit') }}"
                class="flex items-center gap-3 rounded-xl px-3 py-3 text-sm font-medium text-slate-600 transition-all duration-200 hover:bg-slate-100 hover:text-slate-900 dark:text-slate-400 dark:hover:bg-slate-800 dark:hover:text-white"
            >
                <svg
                    class="h-5 w-5"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="1.8"
                        d="M20 21a8 8 0 00-16 0M12 13a4 4 0 100-8 4 4 0 000 8z"
                    />
                </svg>

                <span>Mi perfil</span>
            </a>

            {{-- Cerrar sesión --}}
            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <button
                    type="submit"
                    class="group mt-1 flex w-full items-center gap-3 rounded-xl px-3 py-3 text-sm font-medium text-slate-500 transition-all duration-200 hover:bg-red-50 hover:text-red-600 dark:text-slate-500 dark:hover:bg-red-950/30 dark:hover:text-red-400"
                >
                    <svg
                        class="h-5 w-5 transition-transform duration-200 group-hover:translate-x-1"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="1.8"
                            d="M15 3h4a2 2 0 012 2v14a2 2 0 01-2 2h-4m-4-4l4-4m0 0l-4-4m4 4H3"
                        />
                    </svg>

                    <span>Cerrar sesión</span>
                </button>
            </form>

        </div>
    </aside>

    {{-- ============================================================
         BARRA MOBILE
    ============================================================= --}}
    <div
        class="sticky top-0 z-40 flex h-16 items-center justify-between border-b border-slate-200 bg-white/90 px-4 backdrop-blur-xl transition-colors duration-300 lg:hidden dark:border-slate-800 dark:bg-slate-900/90"
    >
        <a href="{{ route('dashboard') }}" class="flex items-center gap-2">

            <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-slate-900 text-lg font-extrabold text-white dark:bg-white dark:text-slate-900">
                Δ
            </div>

            <div>
                <span class="font-extrabold tracking-tight text-slate-900 dark:text-white">
                    DELTA
                </span>

                <span class="ml-1 text-[9px] font-bold uppercase tracking-widest text-slate-400">
                    System
                </span>
            </div>

        </a>

        <div class="flex items-center gap-2">

            <button
                type="button"
                onclick="window.toggleDeltaTheme()"
                class="flex h-10 w-10 items-center justify-center rounded-xl text-slate-600 transition hover:bg-slate-100 dark:text-slate-300 dark:hover:bg-slate-800"
            >
                <span class="dark:hidden">🌙</span>
                <span class="hidden dark:inline">☀️</span>
            </button>

            <button
                type="button"
                @click="open = !open"
                class="flex h-10 w-10 items-center justify-center rounded-xl text-slate-600 transition hover:bg-slate-100 dark:text-slate-300 dark:hover:bg-slate-800"
            >
                <svg
                    x-show="!open"
                    class="h-6 w-6"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M4 6h16M4 12h16M4 18h16"
                    />
                </svg>

                <svg
                    x-show="open"
                    class="h-6 w-6"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M6 18L18 6M6 6l12 12"
                    />
                </svg>
            </button>

        </div>
    </div>

    {{-- ============================================================
         MENU MOBILE
    ============================================================= --}}
    <div
        x-show="open"
        x-transition
        class="border-b border-slate-200 bg-white px-4 py-4 shadow-lg transition-colors duration-300 lg:hidden dark:border-slate-800 dark:bg-slate-900"
    >
        <div class="space-y-1">

            <a
                href="{{ route('dashboard') }}"
                class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium text-slate-700 hover:bg-slate-100 dark:text-slate-300 dark:hover:bg-slate-800"
            >
                Panel principal
            </a>

            @if(in_array(auth()->user()->role, ['admin', 'employee']))

                <a
                    href="{{ route('branches.index') }}"
                    class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium text-slate-700 hover:bg-slate-100 dark:text-slate-300 dark:hover:bg-slate-800"
                >
                    Sucursales
                </a>

                <a
                    href="{{ route('customers.index') }}"
                    class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium text-slate-700 hover:bg-slate-100 dark:text-slate-300 dark:hover:bg-slate-800"
                >
                    Clientes
                </a>

            @endif

            <a
                href="{{ route('profile.edit') }}"
                class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium text-slate-700 hover:bg-slate-100 dark:text-slate-300 dark:hover:bg-slate-800"
            >
                Mi perfil
            </a>

            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <button
                    type="submit"
                    class="w-full rounded-xl px-4 py-3 text-left text-sm font-medium text-red-600 hover:bg-red-50 dark:text-red-400 dark:hover:bg-red-950/30"
                >
                    Cerrar sesión
                </button>
            </form>

        </div>
    </div>

</nav>