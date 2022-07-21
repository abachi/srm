<template>
  <div>
    <Errors :errors="errors"/>
    <form @submit.prevent="saveResource">
      <div class="flex flex-col my-2">
        <label for="title">Title</label>
        <input id="title" class="border px-2 py-1 my-2 rounded" type="text" name="title" placeholder="Write a title..." v-model="form.title" required/>
      </div>
      <div class="flex flex-col my-2">
        <label for="link">Link</label>
        <textarea id="link" class="border px-2 py-1 my-2 rounded" name="link" cols="30" rows="3" placeholder="Write or paste your link here..." v-model="form.link" required></textarea>
      </div>
      <div class="my-2">
        <input class="border px-2 py-1 rounded" id="new-tab" type="checkbox" name="open_new_tab" v-model="form.open_new_tab" :checked="form.open_new_tab"/>
        <label class="ml-2" for="new-tab">Open in a new tab</label>
      </div>
      <button type="submit" class="bg-green-500 text-white px-2 py-1 my-3 rounded">Save</button>
    </form>
  </div>
</template>
<script>
import useResources from "../../composables/resources";
import Errors from '../../components/base/errors';
import {reactive, onMounted} from "vue";
import {LINK_TYPE} from "../../constants";

export default {
  components: {
    Errors
  },
  props: ['id', 'resource_type'],
  setup(props) {
      const {id, resource_type} = props;
      const {errors, storeResource, getResource, updateResource} = useResources();
      const form = reactive({
        resource_type: LINK_TYPE,
        id: '',
        title: '',
        link: '',
        open_new_tab: false,
      });

      if(id) {
        onMounted(async () => {
          const data = await getResource({id, resource_type});
          form.id = data.id;
          form.title = data.title;
          form.link = data.link;
          form.open_new_tab = data.open_new_tab;
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
  },
}
</script>