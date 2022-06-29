<template>
<div>
<v-app>
<v-dialog
        transition="dialog-bottom-transition"
        max-width="600"
      >
        <template v-slot:activator="{ on, attrs }">
          <v-btn
            color="primary"
            v-bind="attrs"
            v-on="on"
            dark
          >From the bottom</v-btn>
        </template>
        <template v-slot:default="dialog">
          <v-card>
            <v-toolbar
              color="primary"
              dark
            >Opening from the bottom</v-toolbar>
            <v-card-text>
              <div class="text-h2 pa-12">Hello world!</div>
            </v-card-text>
            <v-card-actions class="justify-end">
              <v-btn
                text
                @click="dialog.value = false"
              >Close</v-btn>
            </v-card-actions>
          </v-card>
        </template>
      </v-dialog>
</v-app>
  <v-data-table
    dense
    :headers="headers"
    :items="sodas"
    class="elevation-1">
    </v-data-table>

</div>
</template>

<script>
import { mapGetters, mapActions} from 'vuex'
export default {

    data () {
        return {

            loading: false,
            saving: false,
            deleting: false,

            headers: [
        {
          text: 'Soda Name',
          align: 'center',
          sortable: false,
          value: 'name',
        },
        { text: 'Flavor',
         value: 'flavor' },
      ],
    }
},
created () {
    this.getSoda()
},
computed: {
    ...mapGetters({
        sodas: 'sodas/LIST'
    })
},
methods: {
    ...mapActions ({
        _getSoda: 'sodas/GET'
    }),
    getSoda(){
    this.loading = true
    this._getSoda()
    .finally(
        () => {
            this.loading = false
        }
        )
    }

}
}
</script>
