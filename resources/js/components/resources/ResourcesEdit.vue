<template>
  <Header page="Editing a resource"/>
  <div class="container mx-auto w-1/2">
    <component :is="includeComponent(resource_type)" :id="id" :resource_type="resource_type"/>
  </div>
</template>

<script>
import Header from '../base/header';

export default {
  components: {Header},
  props: {
    id: {
      required: true,
      type: String,
    },
    resource_type: {
      required: true,
      type: String,
    },
  },
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
}
</script>