<script setup>
    import { Head } from '@inertiajs/vue3';
    import Nav from "./Nav.vue"
</script>
<template>
    <Head>
        <title>MyApp</title>
        <meta type="description" content="layout description" head-key="description" >
    </Head>
    <section class="p-6 bg-gray-200">
        <header class="flex justify-between">
            <div class="flex items-center">
                <h1 class="font-bold text-lg">My App</h1>
                <p class="text-sm ml-4">Welcome Back, {{ $page.props.auth.user.name }}</p>
            </div>
            <Nav />
        </header>
    </section>
    <section class="p-6">
        <div class="max-w-3xl mx-auto">
            <slot />
        </div>
    </section>
</template>