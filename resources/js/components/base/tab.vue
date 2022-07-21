<template>
  <NoDataAvailable :show="data && data.length === 0"/>
  <table :id='id' class="min-w-full border divide-y divide-gray-200" v-if="data && data.length > 0">
    <thead>
    <tr>
      <th class="px-6 py-3 bg-gray-50" v-for="(item) in keysValues">
        <span class="text-xs font-medium tracking-wider leading-4 text-left text-gray-500 uppercase">{{ item.label }}</span>
      </th>
      <th class="px-6 py-3 bg-gray-50">
        <span class="text-xs font-medium tracking-wider leading-4 text-left text-gray-500 uppercase" v-if="is_admin">actions</span>
      </th>
    </tr>
    </thead>
    <tbody class="bg-white divide-y divide-gray-200 divide-solid">
    <slot></slot>
    </tbody>
  </table>

</template>

<script>
import NoDataAvailable from '../base/no-data-available';

export default {
  components: {NoDataAvailable},
  props: ['data', 'resource_type', 'onDelete','is_admin', 'keysValues'],
}

</script>