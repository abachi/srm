<template>
  <div>
    <Errors :errors="errors"/>
    <form enctype="multipart/form-data"  @submit.prevent="saveResource">
      <div class="flex flex-col my-2">
        <label for="title">Title</label>
        <input id="title" class="border px-2 py-1 my-2 rounded" type="text" name="title" placeholder="Write a title..." v-model="form.title"/>
      </div>
      <div class="italic text-green-800 my-4" v-if="form.path">
        <p > The current file path is: {{ form.path }}</p>
        <p> Upload a new one to replace it.</p>
      </div>
      <div class="flex flex-col my-2">
        <input type="file" name="file" @change="handleFileChange($event)" />
      </div>
      <button type="submit" class="bg-green-500 text-white px-2 py-1 my-2 rounded">Save</button>
    </form>
  </div>
</template>
<script>
import useResources from "../../composables/resources";
import {onMounted, reactive, ref} from "vue";
import {PDF_FILE_TYPE} from "../../constants";
import Errors from "../base/errors";

export default {
  components: {Errors},
  props: ['id', 'resource_type'],
  setup(props) {
    const {id, resource_type} = props;
    const {errors, storeResource, getResource, updateResource} = useResources();
    const file = ref(null);
    const form = reactive({
      resource_type: PDF_FILE_TYPE,
      id: '',
      title: '',
      path: '',
    });
    const handleFileChange = (e) => {
      if(e.target && e.target.files) {
        file.value = e.target.files[0];
      }
    }
    if(id) {
      onMounted(async () => {
        const data = await getResource({id, resource_type});
        form.id = data.id;
        form.title = data.title;
        form.path = data.path;
      });
    }
    const saveResource = async () => {
      const data = new FormData();
      data.append('resource_type', form.resource_type);
      data.append('id', form.id);
      data.append('title', form.title);
      if(file.value) {
        data.append('file', file.value);
      }

      if(id) {
        await updateResource(data, { 'Content-Type': 'multipart/form-data' });
      }else {
        await storeResource(data, { 'Content-Type': 'multipart/form-data' });
      }
    }
    return {
      saveResource,
      form,
      file,
      errors,
      handleFileChange
    }
  }
}
</script>
