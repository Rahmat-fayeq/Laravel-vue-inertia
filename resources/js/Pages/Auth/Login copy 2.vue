<script setup>
import { useForm } from '@inertiajs/vue3';

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
        form.post('/login');
    }
</script>

<template>
    <Head title="Login" />
   <main class="grid place-content-center min-h-screen">
    <section class="bg-white p-8 rounded max-w-md mx-auto border shadow-md ">
        <h2 class="text-2xl font-semibold text-center justify-center">Login</h2>

        <form @submit.prevent="submit" class="max-w-md mx-auto mt-8">
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
                <button :disabled="form.processing" type="submit" class=" bg-blue-400 text-white rounded py-2 px-4 hover:bg-blue-500" :class="form.processing? 'cursor-not-allowed bg-blue-300 hover:bg-blue-300':''">Login</button>
            </div>
        </form>
    </section>
   </main>

</template>