<template>
  <Tab
      :data="resources[HTML_SNIPPET_TYPE]"
      :keysValues="keysValues"
      :resource_type="resource_type"
      :is_admin="is_admin"
      :onDelete="onDelete">
    <template v-for="item in resources[HTML_SNIPPET_TYPE]" :key="item.id">
      <tr class="bg-white">
        <td class="px-6 py-4 text-sm leading-5 text-gray-900 whitespace-no-wrap">
          {{ item.title }}
        </td>
        <td class="px-6 py-4 text-sm leading-5 text-gray-900 whitespace-no-wrap">
          {{ item.description }}
        </td>
        <td class="px-6 py-4 text-sm leading-5 text-gray-900 whitespace-no-wrap">
          {{ item.code_snippet }}
        </td>
        <td class="px-6 py-4 text-sm leading-5 text-gray-900 whitespace-nowrap" v-if="!is_admin">
          <button @click="copyToClipboard(item.code_snippet)" class="mx-2 bg-indigo-500 text-white rounded px-2 py-1 focus:ring focus:ring-violet-300">Copy</button>
        </td>
        <td class="px-6 py-4 text-sm leading-5 text-gray-900 whitespace-nowrap" v-if="is_admin">
          <button @click="copyToClipboard(item.code_snippet)" class="bg-black text-white rounded px-2 py-1 mx-2 focus:ring focus:ring-violet-300">Copy</button>
          <button @click="onDelete(item.id, resource_type)" class="bg-black text-white rounded px-2 py-1 mx-2">Delete</button>
          <router-link :to="{ name: 'resources.edit', params: { id: item.id, resource_type: resource_type} }" class="mx-2 bg-black text-white rounded px-2 py-1">Edit</router-link>
        </td>
      </tr>
    </template>
  </Tab>

</template>

<script>
import Tab from '../base/tab';
import {HTML_SNIPPET_TYPE} from '../../constants';

export default {
  components: {Tab},
  props: ['resources', 'resource_type', 'onDelete', 'is_admin'],
  data() {
    return {
      HTML_SNIPPET_TYPE,
    }
  },
  methods: {
    copyToClipboard(text) {
      navigator.clipboard.writeText(text);
    }
  },
  computed: {
    keysValues() {
      return [
        {key: 'title', label: 'title'},
        {key: 'description', label: 'description'},
        {key: 'code_snippet', label: 'code snippet'},
      ];
    }
  }
}
</script>