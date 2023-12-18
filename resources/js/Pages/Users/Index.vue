<script setup>
  import Pagination from '@/Shared/Pagination.vue';
  import Layout from '../../Shared/Layout.vue';
  import { ref } from 'vue';
  import { watch } from 'vue';
  import {router} from "@inertiajs/vue3"
  import debounce from "lodash/debounce"

  defineOptions({layout: Layout});

  const props = defineProps({
    users:{
      required: true,
      type: Object
    },
    filter:{
      required: true,
      type: Object
    },
    can:{
      required: true,
      type: Object
    },
    success:{
      required: true,
      type: String
    }
  });

  const search = ref(props.filter.search);

  watch(search,debounce(function(value){
    router.get('/users',{search:value},{
      preserveState:true,
      replace:true
    });
  },500));

  
  
</script>
<template>
    <div v-show="success" class="bg-green-500 text-white font-sans w-80 rounded-md p-3">{{ success }}</div>
    <div class="flex justify-between mb-5">
      <div class="flex items-center">
        <h2 class="text-2xl font-semibold">Users</h2>
        <Link v-if="can.createUser" href="/users/create" class="text-blue-500 text-sm ml-3 border-b">New User</Link>
      </div>

      <input v-model="search" type="text" placeholder="Search..." class="border px-2 rounded-lg" />
    </div>
    <!-- table start -->
    <div class="relative overflow-x-auto">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3">
                      Name
                    </th>
                    <th scope="col" class="px-6 py-3">
                      Email 
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr class="bg-white border-b" v-for="user in users.data" :key="user.id">
                    <td scope="row" class="px-6 py-4">
                        {{ user.name }}
                    </td>
                    <td class="px-6 py-4">
                        {{ user.email }}
                    </td>
                    <Link class="px-6 py-4 text-blue-500" v-if="user.can.edit" :href="`/users/${user.id}/edit`" type="button">
                        Edit
                    </Link>
                    <Link method="delete" class="px-6 py-4 text-red-500" v-if="user.can.edit" :href="`/users/${user.id}/delete`" type="button">
                        Delete
                    </Link>
                </tr>
            </tbody>
        </table>
    </div>
    <!-- table end -->
    <!-- paginator -->
    <Pagination :links="users.links" class="mt-6" />
   
</template>