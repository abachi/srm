<template>
  <div class="container mx-auto py-6 px-4 mb-5 flex justify-center">
    <ul class="flex mx-auto">
      <li class="mx-3 p-2 hover:text-indigo-500">
        <router-link :to="{name: 'resources.admin'}" class="hover:border-indigo-500">Admin</router-link>
      </li>
      <li class="mx-3 p-2 hover:text-indigo-500">
        <router-link :to="{name: 'resources.create'}" class="hover:border-indigo-500">Create resource</router-link>
      </li>
      <li class="mx-3 p-2 hover:text-indigo-500">
        <router-link :to="{name: 'resources.visitor'}" class="hover:border-indigo-500">Visitor</router-link>
      </li>
    </ul>
  </div>

</template>
<script>
export default {
  props: ['page']
}
</script>