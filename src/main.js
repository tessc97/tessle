import Vue from 'vue'
import VueRouter from 'vue-router'
import App from './App.vue'

Vue.config.productionTip = false

Vue.use(VueRouter)

const router = new VueRouter({
  mode: 'history',
  base: __dirname,
  routes: [
    {
      path: '',
      component: () => import("./components/Modes/Classic.vue"),
      name: "Classic"
    },
    {
      path: '/daily',
      component: () => import("./components/Modes/Daily.vue"),
      name: "Daily"
    },
    {
      path: '/notes',
      component: () => import("./components/Notes.vue"),
    }
  ]
})

new Vue({
  router,
  render: h => h(App),
  data: () => {
    return {
      title: "Tessle"
    }
  }
}).$mount('#app')
