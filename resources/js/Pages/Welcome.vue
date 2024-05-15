<script setup>
import { Head, Link } from '@inertiajs/vue3';

defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
});
</script>

<template>
    <Head title="Welcome" />
    <div class="bg-gray-50 text-black/50 dark:bg-black dark:text-white/50">
        <div
            class="relative min-h-screen flex flex-col items-center justify-center selection:bg-[#FF2D20] selection:text-white"
        >
            <div class="relative w-full max-w-2xl px-6 lg:max-w-7xl">
                <header class="items-center">
                    <div class="flex justify-center ">
                      <svg width="100" height="100" viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <rect width="100" height="100" fill="none" stroke="currentColor" stroke-width="2"/>
                        <path d="M30 70L50 30L70 70" stroke="currentColor" stroke-width="3"/>
                      </svg>

                    </div>

                </header>

                <main class="mt-6">
                  <div class="flex justify-center">
                    <Link
                        v-if="$page.props.auth.user"
                        :href="route('dashboard')"
                        class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                    >
                      Dashboard
                    </Link>

                  <Link
                      v-if="!$page.props.auth.user"
                      :href="route('login')"
                      class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                  >
                    Log in
                  </Link>

                  <Link
                      v-if="!$page.props.auth.user"
                      :href="route('register')"
                      class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                  >
                    Register
                  </Link>
                  </div>
                </main>

                <footer class="py-16 text-center text-sm text-black dark:text-white/70">
                    Votes v0.1
                </footer>
            </div>
        </div>
    </div>
</template>
