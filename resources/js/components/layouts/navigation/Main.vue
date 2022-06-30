<template>
  <v-navigation-drawer
    clipped
    app
    v-model="navbar"
  >
    <v-list dense />
  </v-navigation-drawer>
</template>

<script>
export default {
  data () {
    return {
      navbar: null,
      navLinks: [
        {
          title: 'Dashboard',
          to: 'main.home',
          icon: 'mdi-view-dashboard-outline'
        }
      ]
    }
  }
}
</script>
