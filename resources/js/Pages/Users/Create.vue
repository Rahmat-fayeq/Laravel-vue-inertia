<script setup>
import Layout from '@/Shared/Layout.vue';
import { useForm } from '@inertiajs/vue3';


    defineOptions({
        layout:Layout
    });
    defineProps({
        errors:{
            required:true,
            type:Object
        }
    });

    const form = useForm({
        name:'',
        email:'',
        password:'',
    });

    const submit =()=>{
        form.post('/users/create');
    }
</script>

<template>
    <Head title="Create User" />
    <h2 class="text-2xl font-semibold">Create New User</h2>

    <form @submit.prevent="submit" class="max-w-md mx-auto mt-8">
        <div class="mb-6">
            <label for="name" class="block mb-2 uppercase font-bold text-xs text-gray-700">
                name:
            </label>
            <input v-model="form.name" type="text" name="name" id="name" class="border border-gray-400 p-2 w-full rounded-md">
            <div class="text-rose-600 text-sm mt-1">{{ form.errors.name }}</div>
        </div>
        <div class="mb-6">
            <label for="name" class="block mb-2 uppercase font-bold text-xs text-gray-700">
                email:
            </label>
            <input v-model="form.email" type="email" name="name" id="name" class="border border-gray-400 p-2 w-full rounded-md">
            <div class="text-rose-600 text-sm mt-1">{{ form.errors.email }}</div>
        </div>
        <div class="mb-6">
            <label for="name" class="block mb-2 uppercase font-bold text-xs text-gray-700">
                password:
            </label>
            <input v-model="form.password" type="password" name="name" id="name" class="border border-gray-400 p-2 w-full rounded-md">
            <div class="text-rose-600 text-sm mt-1">{{ form.errors.password }}</div>
        </div>
        <div class="mb-6">
            <button :disabled="form.processing" type="submit" class=" bg-blue-400 text-white rounded py-2 px-4 hover:bg-blue-500" :class="form.processing? 'cursor-not-allowed bg-blue-300 hover:bg-blue-300':''">Submit</button>
        </div>
    </form>

</template>