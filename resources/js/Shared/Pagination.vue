<script setup>
    defineProps({
        links:{
            required: true,
            type: Array
        }
    });
</script>
<template>
    <div>
      <!-- one way -->
      <!-- <template v-for="link in users.links">
        <Link v-if="link.url" :href="link.url" v-html="link.label" />
        <span v-else v-html="link.label"></span>
      </template> -->
       <!-- second way using vue component -->
        <Component 
          :is="link.url?'Link':'span'"
          v-for="link in links"
          :href="link.url"
          v-html="link.label"
          class="px-1"
          :class="{'text-gray-100':!link.url,'font-bold':link.active}"
        />
    </div>
</template>