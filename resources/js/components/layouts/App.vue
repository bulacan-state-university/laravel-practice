<template>
  <v-app>
    <v-dialog
      transition="dialog-bottom-transition"
      v-model="formDialog"
      max-width="600"
    >
      <template #activator="{ on, attrs }">
        <v-btn
          color="primary"
          v-bind="attrs"
          v-on="on"
        >
          Add New Soda
        </v-btn>
      </template>
      <template #default="dialog">
        <v-form
          @submit.prevent="submitForm"
          ref="addForm"
          v-model="addForm"
        >
          <v-card>
            <v-toolbar
              color="primary"
              dark
            >
              <v-toolbar-title>
                {{ hasSelectedSoda ? 'Edit Soda' : 'New Soda' }}
              </v-toolbar-title>
            </v-toolbar>
            <v-card-text class="mt-3">
              <v-text-field
                v-model="sodaName"
                label="Soda Name"
                :error="hasNameError"
                :error-messages="nameError"
                :rules="[rules.required]"
                outlined
              />
              <v-text-field
                v-model="sodaFlavor"
                label="Flavor"
                outlined
              />
            </v-card-text>
            <v-card-actions class="justify-end">
              <v-btn
                type="submit"
                :loading="saving"
                text
              >
                Save
              </v-btn>
              <v-btn
                text
                :disabled="saving"
                @click="dialog.value = false"
              >
                Close
              </v-btn>
            </v-card-actions>
          </v-card>
        </v-form>
      </template>
    </v-dialog>

    <v-data-table
      dense
      :headers="headers"
      :items="sodas"
    >
      <template #[`item.actions`]="{item}">
        <v-tooltip bottom>
          <template #activator="{on: editTooltip}">
            <v-btn
              icon
              small
              @click="editSoda(item)"
              v-on="editTooltip"
            >
              <v-icon>
                mdi-pencil
              </v-icon>
            </v-btn>
          </template>
          <span>Edit Soda</span>
        </v-tooltip>

        <v-tooltip bottom>
          <template #activator="{on: deleteTooltip}">
            <v-btn
              icon
              small
              @click="deleteSoda(item)"
              v-on="deleteTooltip"
            >
              <v-icon>
                mdi-delete
              </v-icon>
            </v-btn>
          </template>
          <span>Delete Soda</span>
        </v-tooltip>
      </template>
    </v-data-table>

    <v-dialog
      v-model="deleteDialog"
      persistent
      max-width="290"
    >
      <v-card>
        <v-card-title class="text-h5">
          Use Google's location service?
        </v-card-title>
        <v-card-text>
          Let Google help apps determine location. This means sending anonymous location data to Google, even when no apps are running.
        </v-card-text>
        <v-card-actions>
          <v-spacer />
          <v-btn
            color="green darken-1"
            text
            @click="closeDeleteDialog()"
          >
            Disagree
          </v-btn>
          <v-btn
            color="green darken-1"
            text
            @click="confirmDelete()"
            :loading="deleting"
          >
            Agree
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </v-app>
</template>

<script>
import { mapGetters, mapActions } from 'vuex'
export default {

  data () {
    return {

      rules: {
        required: (v) => !!v || 'This is a required filed'
      },
      sodaId: null,
      sodaName: null,
      sodaFlavor: null,
      sodaErrors: null,
      addForm: null,
      formDialog: false,
      deleteDialog: false,

      loading: false,
      saving: false,
      deleting: false,

      headers: [
        {
          text: 'Soda Name',
          align: 'center',
          sortable: false,
          value: 'name'
        },
        {
          text: 'Flavor',
          value: 'flavor'
        },
        {
          value: 'actions',
          text: ' ',
          sortable: false,
          filterable: false
        }
      ]
    }
  },
  created () {
    this.getSoda()
  },
  computed: {
    ...mapGetters({
      sodas: 'sodas/LIST'
    }),
    nameError () {
      return this.sodaErrors?.name
    },
    hasNameError () {
      return !!this.nameError
    },
    hasSelectedSoda () {
      return !!this.sodaId
    }
  },
  methods: {
    ...mapActions({
      _getSoda: 'sodas/GET',
      _saveSoda: 'sodas/SAVE',
      _updateSoda: 'sodas/UPDATE',
      _deleteSoda: 'sodas/DELETE'
    }),
    getSoda () {
      this.loading = true
      this._getSoda()
        .finally(
          () => {
            this.loading = false
          }
        )
    },
    closeDialog () {
      this.formDialog = false
      setTimeout(() => {
        this.sodaName = null
        this.sodaFlavor = null
        this.sodaErrors = null
        this.$refs.addForm.resetValidation()
      }, 500)
    },
    submitForm () {
      if (this.hasSelectedSoda) {
        this.updateSoda()
      } else {
        this.saveSoda()
      }
    },
    saveSoda () {
      if (this.$refs.addForm.validate()) {
        this.saving = true
        this._saveSoda({
          name: this.sodaName,
          flavor: this.sodaFlavor
        })
          .then((response) => {
            if (response.created) {
              this.getSoda()
              this.closeDialog()
            }
          })
          .catch((e) => {
            this.sodaErrors = e.errors
          })
          .finally(() => {
            this.saving = false
          })
      }
    },

    editSoda (item) {
      this.formDialog = true
      this.sodaName = item?.name
      this.sodaFlavor = item?.flavor
      this.sodaId = item?.id
    },

    updateSoda () {
      if (this.$refs.addForm.validate()) {
        this.saving = true
        this._updateSoda({
          id: this.sodaId,
          data: {
            id: this.sodaId,
            name: this.sodaName,
            flavor: this.sodaFlavor
          }
        })
          .then((response) => {
            if (response.updated) { this.getSoda() }
            this.closeDialog()
          })
          .catch((e) => {
            this.sodaErrors = e.errors
          })
          .finally(() => {
            this.saving = false
          })
      }
    },

    deleteSoda (item) {
      this.sodaId = item?.id
      this.deleteDialog = true
    },
    closeDeleteDialog () {
      this.deleteDialog = false
      this.sodaId = null
    },
    confirmDelete () {
      this.deleting = true
      this._deleteSoda({
        id: this.sodaId
      })
        .then((response) => {
          if (response.deleted) {
            this.getSoda()
            this.closeDeleteDialog()
          }
        })
        .finally(() => {
          this.deleting = false
        })
    }
  }
}
</script>
