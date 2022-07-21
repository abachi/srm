<template>
  <div class="w-full h-80 flex justify-center items-center text-center border bg-gray-100" v-if="show">
    <h3 class="text-lg mx-auto">No data available</h3>
  </div>
</template>

<script>
export default  {
  props: ['show'],
}
</script>