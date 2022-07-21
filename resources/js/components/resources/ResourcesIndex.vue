<template>
  <Header page="Admin" />
  <div class="container mx-auto p-6">
    <div class="overflow-hidden overflow-x-auto min-w-full align-middle sm:rounded-md">
      <div class="flex place-content-end mb-4">
        <router-link class="text-sm font-medium px-2 py-2 text-white bg-indigo-600 hover:bg-indigo-700 cursor-pointer rounded" :to="{ name: 'resources.create' }">Create resource</router-link>
      </div>
      <ul class="flex flex-wrap text-sm font-medium text-center text-gray-500 border-b border-gray-200 dark:border-gray-700 dark:text-gray-400">
        <li class="mr-2">
          <a
              @click.prevent="setCurrentTab(LINK_TYPE)"
              href="#"
              class="inline-block p-4 rounded-t-lg hover:text-gray-600 hover:bg-gray-50"
              :class="currentTab === LINK_TYPE ? 'text-blue-600 bg-gray-100' : ''"
          >Links</a>
        </li>
        <li class="mr-2">
          <a
              @click.prevent="setCurrentTab(PDF_FILE_TYPE)"
              href="#"
              class="inline-block p-4 rounded-t-lg hover:text-gray-600 hover:bg-gray-50"
              :class="currentTab === PDF_FILE_TYPE ? 'text-blue-600 bg-gray-100' : ''"
          >PDF files</a>
        </li>
        <li class="mr-2">
          <a
              @click.prevent="setCurrentTab(HTML_SNIPPET_TYPE)"
              href="#"
              class="inline-block p-4 rounded-t-lg hover:text-gray-600 hover:bg-gray-50"
              :class="currentTab === HTML_SNIPPET_TYPE ? 'text-blue-600 bg-gray-100' : ''"
          >HTML code snippets</a>
        </li>
      </ul>
      <LinksTab
          :onDelete="deleteResource"
          :resource_type="LINK_TYPE"
          :resources="resources"
          :is_admin="true"
          v-if="resources && resources[LINK_TYPE] && currentTab === LINK_TYPE"/>
      <PdfFilesTab
          :onDelete="deleteResource"
          :resource_type="PDF_FILE_TYPE"
          :resources="resources"
          :is_admin="true"
          v-if="resources && resources[PDF_FILE_TYPE] && currentTab === PDF_FILE_TYPE"/>
      <HTMLSnippetTab
          :onDelete="deleteResource"
          :resource_type="HTML_SNIPPET_TYPE"
          :resources="resources"
          :is_admin="true"
          v-if="resources && resources[HTML_SNIPPET_TYPE] && currentTab === HTML_SNIPPET_TYPE"/>
    </div>
  </div>
</template>
<script>
import Header from "../../components/base/header";
import LinksTab from "../tabs/links";
import useResources from "../../composables/resources";
import { onMounted } from "vue";
import {LINK_TYPE, PDF_FILE_TYPE, HTML_SNIPPET_TYPE} from "../../constants";
import PdfFilesTab from "../tabs/pdf-files";
import HTMLSnippetTab from "../tabs/html-snippet";

export default {
  components: {HTMLSnippetTab, PdfFilesTab, LinksTab, Header},
  data() {
    return {
      currentTab: LINK_TYPE,
    }
  },
  methods: {
    setCurrentTab(tab) {
      this.currentTab = tab;
    }
  },
  setup() {
    const { resources, getResources, destroyResource } = useResources();

    onMounted(getResources);
    const deleteResource = async (id, resource_type) => {
      if(!window.confirm('Are you sure you want delete this resource?')) {
        return;
      }
      const data = {
        id: id,
        resource_type: resource_type
      };

      await destroyResource(data);
      await getResources();
    }

    return {
      resources,
      deleteResource,
      LINK_TYPE,
      PDF_FILE_TYPE,
      HTML_SNIPPET_TYPE
    };
  }
}
</script>