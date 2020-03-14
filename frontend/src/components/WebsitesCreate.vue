<template>
<v-container>
  <v-row justify="center">
    <v-col cols="12" sm="6" md="6">
      <v-alert transition="scale-transition" :value="success" type="success" dismissible>
        Website successfuly created.
      </v-alert>
      <v-alert transition="scale-transition" :value="error" type="error" dismissible>
        {{errorMsg}}
      </v-alert>
      <v-card>
        <v-card-title>Website creation form</v-card-title>
        <v-card-text>
          <v-form ref="form" v-model="isValid">
            <v-text-field 
              label="Name"
              v-model="name"
              :rules="nameRules"
              required
            ></v-text-field>
            <v-text-field 
              label="URL"
              v-model="url"
              :rules="urlRules"
              required
            ></v-text-field>
          </v-form>
        </v-card-text>
        <v-card-actions>
          <v-btn @click="submit" :disabled="!isValid" color="primary">Save</v-btn>
        </v-card-actions>
      </v-card>
    </v-col>
  </v-row>
</v-container>
</template>

<script>
  import { createWebsite } from '../api/websites.api'

  export default {
    name: 'WebsitesCreate',
    data() {
      return {
        name: '',
        url: '',
        success: false,
        error: false,
        errorMsg: '',
        isValid: true,
        nameRules: [
          v => !!v || 'Name is required'
        ],
        urlRules: [
          v => !!v || 'URL is required',
          v => /^((http|https)?:\/\/)?([\da-z.-]+)\.([a-z.]{2,6})([/\w .-]*)*\/?$/.test(v) || 'URL is not valid'
        ],
      };
    },
    computed: {
      form () {
        return {
          name: this.name,
          address: this.url
        }
      },
    },
    methods: {
      submit () {
        if (this.$refs.form.validate()) {
          createWebsite(this.name, this.url)
          .then(() => {
            this.name = '';
            this.url = '';
            this.$refs.form.reset();
            this.success = true;

            setInterval(() => {
              this.success = false;
            }, 3000);
          })
          .catch(err => {
            console.warn('Error getting website data: ', err);
            this.error = true;

            let errorMsg = '';
            for (const error in err.response.data.errors) {
              errorMsg += err.response.data.errors[error];
            }

            this.errorMsg = errorMsg;

            setInterval(() => {
              this.error = false;
              this.errorMsg = '';
            }, 3000);
          })
        }
      },
    },
  }
</script>

<style>
</style>