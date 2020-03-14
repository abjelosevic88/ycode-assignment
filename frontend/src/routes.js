import Websites from './components/Websites.vue';
import WebsitesCreate from './components/WebsitesCreate.vue';

const routes = [
  { path: '/websites', component: Websites, name: 'websites' },
  { path: '/websites/create', component: WebsitesCreate, name: 'websites-create' },
];

export default routes;