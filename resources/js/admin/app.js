import { createApp } from 'vue';

import LinkType from "../components/resources-types/link-type";
import HTMLSnippetType from "../components/resources-types/html-snippet-type";
import PDFDownloadType from "../components/resources-types/pdf-download-type";
import ResourcesIndex from "../components/resources/ResourcesIndex";
import router from '../router';
import '../../css/app.css';

createApp({
    components: {
        ResourcesIndex,
    },
}).use(router)
    .component("link-type", LinkType)
    .component("html-snippet-type", HTMLSnippetType)
    .component("pdf-download-type", PDFDownloadType)
    .mount('#admin-app');
