<script setup>
  import { Head } from '@inertiajs/vue3'; 
  import Layout from '../Shared/Layout.vue';
  defineOptions({layout: Layout})
</script>
<template>
    <Head>
        <title>Home</title>
        <meta type="description" content="Home description" head-key="description" >
    </Head>
    <h2 class="text-2xl font-semibold">Home</h2>
</template>