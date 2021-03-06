import Vue from 'vue';
import VueRouter from 'vue-router';
import App from './App.vue';
import routes from './routes';
import vuetify from './plugins/vuetify';

Vue.config.productionTip = false;

Vue.use(VueRouter);
const router = new VueRouter({mode: 'history', routes});

new Vue({
  router,
  vuetify,
  render: h => h(App)
}).$mount('#app')
