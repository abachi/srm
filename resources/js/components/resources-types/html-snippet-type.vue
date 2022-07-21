<template>
  <div>
    <Errors :errors="errors"/>
    <form @submit.prevent="saveResource">
      <div class="flex flex-col my-2">
        <label for="title">Title</label>
        <input id="title" class="border px-2 py-1 my-2" type="text" name="title" placeholder="Write a title..." v-model="form.title"/>
      </div>
      <div class="flex flex-col my-2">
        <label for="description">description</label>
        <textarea id="description" class="border px-2 py-1 my-2 rounded" name="description" cols="30" rows="3" placeholder="Description for this HTML snippet code..." v-model="form.description"></textarea>
      </div>
      <div class="flex flex-col my-2">
        <label for="code_snippet">Code Snippet</label>
        <textarea id="code_snippet" class="border px-2 py-1 my-2 rounded" name="code_snippet" cols="100" rows="10" placeholder="Write or paste your snippet here..." v-model="form.code_snippet"></textarea>
      </div>
      <button type="submit" class="bg-green-500 text-white px-2 py-1 my-2 rounded">
        Save
      </button>
    </form>
  </div>
</template>

<script>
import useResources from "../../composables/resources";
import {onMounted, reactive} from "vue";
import {HTML_SNIPPET_TYPE} from "../../constants";
import Errors from "../base/errors";

export default {
  components: {
    Errors
  },
  props: ['id', 'resource_type'],
  setup(props) {
    const {id, resource_type} = props;
    const {errors, storeResource, getResource, updateResource} = useResources();
    const form = reactive({
      resource_type: HTML_SNIPPET_TYPE,
      title: '',
      description: '',
      code_snippet: '',
    });

    if(id) {
      onMounted(async () => {
        const data = await getResource({id, resource_type});
        form.id = data.id;
        form.title = data.title;
        form.description = data.description;
        form.code_snippet = data.code_snippet;
      });
    }

    const saveResource = async () => {
      if(id) {
        await updateResource({ ...form });
      } else {
        await storeResource({...form});
      }
    }

    return {
      saveResource,
      form,
      errors,
    }
  }
}
</script>