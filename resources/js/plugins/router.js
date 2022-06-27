import Vue from 'vue'
import VueRouter from 'vue-router'

// =======================================================================
// IMPORT ROUTER COMPONENTS HERE
// =======================================================================
// Home
import Home from '../components/pages/Home.vue'

// =======================================================================
// Make Vue use VueRouter
// =======================================================================
Vue.use(VueRouter)

// =======================================================================
// VueRouter Settings
// =======================================================================
const AppName = 'Tutorial'

const router = new VueRouter({
  mode: 'history', // Navigation Mode
  base: '/', // Base Route
  scrollBehavior (to, from, savedPosition) {
    return { x: 0, y: 0 } // Scroll Behavior on each navigation change
  },

  // Routes Declaration
  routes: [
    // Home
    {
      path: '/',
      name: 'home',
      components: {
        default: Home
      },
      meta: {
        title: 'Dashboard',
        auth: true
      }
    }

  ]
})

router.beforeEach((to, from, next) => {
  // Change Title on route change
  document.title = `${to.meta?.title} | ${AppName}`

  next()
})

// =======================================================================
// Export Settings
// =======================================================================
export default router
