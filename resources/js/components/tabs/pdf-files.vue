<template>
  <Tab
      :data="resources[PDF_FILE_TYPE]"
      :keysValues="keysValues"
      :resource_type="resource_type"
      :is_admin="is_admin"
      :onDelete="onDelete">
    <template v-for="item in resources[PDF_FILE_TYPE]" :key="item.id">
      <tr class="bg-white">
        <td class="px-6 py-4 text-sm leading-5 text-gray-900 whitespace-no-wrap">
          {{ item.title }}
        </td>
        <td class="px-6 py-4 text-sm leading-5 text-gray-900 whitespace-no-wrap">
          <a :href="`/api/resources/${item.id}/download`" class="text-white font-medium bg-green-500 px-2 py-1 rounded">Download</a>
        </td>
        <td class="px-6 py-4 text-sm leading-5 text-gray-900 whitespace-nowrap" v-if="is_admin">
          <button @click="onDelete(item.id, resource_type)" class="px-2 bg-black text-white rounded px-2 py-1">Delete</button>
          <router-link :to="{ name: 'resources.edit', params: { id: item.id, resource_type: resource_type} }" class="mx-2 bg-black text-white rounded px-2 py-1">Edit</router-link>
        </td>
      </tr>
    </template>
  </Tab>

</template>

<script>
import Tab from '../base/tab';
import {PDF_FILE_TYPE} from "../../constants";

export default {
  components: {Tab},
  props: ['resources', 'resource_type', 'onDelete', 'is_admin'],
  data(){
    return {
      PDF_FILE_TYPE
    }
  },
  computed: {
    keysValues() {
      return [
        {key: 'title', label: 'title'},
        {key: 'file', label: 'file'},
      ];
    }
  }
}
</script>