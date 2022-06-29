<template>

   <v-navigation-drawer
clipped
app
v-model="navbar"
>

<v-list
dense
>

</v-list>

    </v-navigation-drawer>

</template>

<script>
export default {
data() {
    return{
        navLinks: [
            {
                title: 'dashboard',
                to: 'main',
                icon: 'mdi-view-dashboard-outline'
            }
        ]
    }
}
}
</script>
