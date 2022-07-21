import { createRouter, createWebHistory} from 'vue-router';

import ResourcesIndex from '../components/resources/ResourcesIndex';
import ResourcesCreate from '../components/resources/ResourcesCreate';
import ResourcesEdit from '../components/resources/ResourcesEdit';
import ResourcesVisitor from '../components/resources/ResourcesVisitor';

const routes = [
    {
        path: '/admin',
        name: 'resources.admin',
        component: ResourcesIndex
    },
    {
        path: '/',
        name: 'resources.visitor',
        component: ResourcesVisitor
    },
    {
        path: '/admin/resources/create',
        name: 'resources.create',
        component: ResourcesCreate
    },
    {
        path: '/admin/resources/:id/edit/:resource_type',
        name: 'resources.edit',
        component: ResourcesEdit,
        props: true
    }
];

export default createRouter({
    history: createWebHistory(),
    routes
})