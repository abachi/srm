import {reactive, ref, toRef} from 'vue';
import axios from "axios";
import {useRouter} from "vue-router";
export default function useResources() {

    const resources = ref([]);
    let resource = ref({});
    const availableResourcesTypes = ref([]);
    const errors = ref();
    const router = useRouter();

    const getAvailableResourcesTypes = async () => {
     const response = await axios.get('/api/resources-types');
     availableResourcesTypes.value =  response.data;
    }
    const getResources = async () => {
        const response = await axios.get('/api/resources');
        resources.value = response.data;
    }

    const getResource = async ({ id, resource_type }) => {
        const response = await axios.get(`/api/resources/${resource_type}/${id}`);
        resource.value = response.data;
        return response.data;
    }
    const updateResource = async (data, headers = {}) => {
        let id, resource_type;
        /* TODO: pass id and resource_type as params
             and remove this dirt check */
        if(data instanceof FormData) {
            id = data.get('id');
            resource_type = data.get('resource_type');
        } else {
            id = data.id;
            resource_type = data.resource_type;
        }
        errors.value = ''
        try {
            await axios.post(`/api/resources/${resource_type}/${id}`, data, headers)
            await router.push({name: 'resources.admin'})
        } catch (e) {
            if (e.response.status === 422) {
                errors.value = e.response.data.errors
            }
        }
    }
    const storeResource = async (data, headers = {}) => {
        errors.value = '';
        try {
            await axios.post('/api/resources', data, headers);
            await router.push({ name: 'resources.admin' });
        }catch (e) {
            if(e.response.status === 422) {
                errors.value = e.response.data.errors;
            }
        }
    }
    const destroyResource = async (data) => {
        await axios.post('/api/resources/' + data.id + '/delete', data);
    }
    return {
        getResources,
        getResource,
        getAvailableResourcesTypes,
        storeResource,
        updateResource,
        destroyResource,
        availableResourcesTypes,
        resources,
        resource: toRef(resource),
        errors,
    };
}