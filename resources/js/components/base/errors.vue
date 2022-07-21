<template>
  <div v-if="errors">
    <div v-for="(v, k) in errors" :key="k" class="bg-red-500 text-white rounded font-bold mb-4 shadow-lg py-2 px-4 pr-0">
      <p v-for="error in v" :key="error" class="text-sm">
        {{ error }}
      </p>
    </div>
  </div>
</template>
<script>
export default {
  props: {
    errors: String|Object
  }
}
</script>