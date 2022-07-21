<template>
  <Tab
      id="links"
      :data="resources[LINK_TYPE]"
      :keysValues="keysValues"
      :resource_type="resource_type"
      :is_admin="is_admin"
      :onDelete="onDelete">
    <template v-for="item in resources[LINK_TYPE]" :key="item.id">
      <tr class="bg-white">
        <td class="px-6 py-4 text-sm leading-5 text-gray-900">
          {{ item.title }}
        </td>
        <td class="px-6 py-4 text-sm leading-5 text-gray-900">
          <a class="hover:underline" :href="item.link" :target="item.open_new_tab ? '_blank' : ''">{{ item.link }}</a>
        </td>
        <td class="px-6 py-4 text-sm leading-5 text-gray-900">
          <input type="checkbox" disabled :checked="item.open_new_tab"/>
        </td>
        <td class="px-6 py-4 text-sm leading-5 text-gray-900 whitespace-nowrap" v-if="is_admin">
          <button @click="onDelete(item.id, resource_type)" class="bg-black text-white rounded px-2 py-1 m-2">Delete</button>
          <router-link :to="{ name: 'resources.edit', params: { id: item.id, resource_type: resource_type} }" class="m-2 bg-black text-white rounded px-2 py-1">Edit</router-link>
        </td>
      </tr>
    </template>
  </Tab>

</template>

<script>
import Tab from '../base/tab';
import {LINK_TYPE} from '../../constants';
export default {
  components: {Tab},
  props: ['resources', 'resource_type', 'onDelete', 'is_admin'],
  data() {
    return {
      LINK_TYPE
    }
  },
  computed: {
    keysValues() {
      return [
        {key: 'title', label: 'title'},
        {key: 'link', label: 'link'},
        {key: 'open_new_tab', label: 'New tab'},
      ];
    }
  }
}
</script>