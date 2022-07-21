<template>
  <Header page="Creating a resource"/>
  <div class="mx-auto w-1/2">
    <div class="flex flex-col">
      <h1 class="my-2">Select a type of resource:</h1>
      <select class="border px-2 mb-4 py-1 rounded" @change="handleResourceTypeChange">
        <option disabled selected>Select a type</option>
        <option
            v-for="resourceType in availableResourcesTypes" :value="resourceType">{{ resourceType }}</option>
      </select>
    </div>
    <component :is="includeComponent(selectedResource)" v-if="selectedResource"/>
  </div>
</template>

<script>
import {onMounted, ref} from "vue";
import useResources from "../../composables/resources";
import Header from "../base/header";

export default {
  components: {Header},
  data() {
    return {
      selectedResource: '',
    }
  },
  methods: {
    handleResourceTypeChange(e) {
      this.selectedResource = e.target.value;
    },
    includeComponent(name){
      return name.toLowerCase().replaceAll(' ', '-');
    }
  },

  setup() {
    const { availableResourcesTypes, getAvailableResourcesTypes } = useResources();

    onMounted(getAvailableResourcesTypes);

    return {
      availableResourcesTypes,
    }
  }
}
</script>