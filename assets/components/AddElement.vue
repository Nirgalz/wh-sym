<template>
  <div>
    <v-form
        ref="form"
        v-model="valid"
        lazy-validation
    >
      <v-card>
        <v-card-title>Add an element</v-card-title>
      </v-card>
      <v-card>
        <v-card-title>What ?</v-card-title>
        <v-card-actions>
          <v-text-field
              v-model="name"
              :counter="25"
              :rules="nameRules"
              label="Name"
              required
          ></v-text-field>
        </v-card-actions>
      </v-card>
      <v-card>
        <v-card-title>When ?</v-card-title>
        <v-card-actions>
          <v-datetime-picker
              label="Date and time of the beginning of the event"
              v-model="startDate"
          >
          </v-datetime-picker>
          <v-datetime-picker label="Date and time of the end of the event" v-model="endDate"></v-datetime-picker>
        </v-card-actions>
      </v-card>
      <v-card>
        <v-card-title>Where ?</v-card-title>
        <v-card-actions>
          <LeafletMap></LeafletMap>
        </v-card-actions>
      </v-card>
      <v-btn
          :disabled="!valid"
          color="success"
          class="mr-4"
          @click="validate"
      >
        Validate
      </v-btn>

      <v-btn
          color="error"
          class="mr-4"
          @click="reset"
      >
        Reset Form
      </v-btn>
    </v-form>
  </div>
</template>

<script>
import axios from 'axios';
import LeafletMap from "./LeafletMap";

export default {
  name: "AddElement",
  components: {
    LeafletMap
  },
  data: () => ({
    valid: true,
    name: '',
    startDate: '',
    endDate: '',
    nameRules: [
      v => !!v || 'Name is required',
      v => (v && v.length <= 10) || 'Name must be less than 10 characters',
    ],
    email: '',
    emailRules: [
      v => !!v || 'E-mail is required',
      v => /.+@.+\..+/.test(v) || 'E-mail must be valid',
    ],
    select: null,
    items: [
      'Item 1',
      'Item 2',
      'Item 3',
      'Item 4',
    ],
    checkbox: false,
  }),
  methods: {
    validate() {
      if (this.$refs.form.validate()) {
        let data = {
          name: this.name,
          startDate: this.startDate,
          endDate: this.endDate
        }
        axios.post('/elements/create', data)
            .then((res) => {
              console.log(res)
            })
            .catch((error) => {
              console.log(error)
            }).finally(() => {
          //Perform action in always
        });
      }

    },
    reset() {
      this.$refs.form.reset()
    },
    resetValidation() {
      this.$refs.form.resetValidation()
    },
  },
}
</script>

<style scoped>

</style>