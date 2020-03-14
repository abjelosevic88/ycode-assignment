<template>
<v-card>
    <v-alert transition="scale-transition" :value="error" type="error" dismissible>
      {{errorMsg}}
    </v-alert>
    <v-card-title>
      Websites
      <v-spacer></v-spacer>
      <v-text-field
        v-model="searchQuery"
        append-icon="mdi-magnify"
        label="Search"
        single-line
        hide-details
        @keyup="searchKeyUp"
      ></v-text-field>
    </v-card-title>
    <v-data-table
      :headers="headers"
      :items="websites"
      :items-per-page="itemsLimit"
      :items-per-page-options="[itemsLimit]"
      multi-sort
      class="elevation-1"
      :loading="loading" 
      :hide-default-footer="true"
      loading-text="Loading... Please wait"
    >
      <template v-slot:item.created_at="{ item }">
        {{ item | moment }}
      </template>
    </v-data-table>
    <div class="text-center">
      <v-pagination
        class="results__pagination"
        v-model="page"
        :length="pages"
        :hidden="hidePagination"
        @input="paginationChange"
      ></v-pagination>
    </div>
  </v-card>
</template>

<script>
  import { getAllWebsites, searchWebsites } from '../api/websites.api'
  import moment from 'moment'
  import _ from 'lodash'
  import statusCodes from 'http-status-codes'

  export default {
    name: 'Websites',
    data() {
      return {
        itemsLimit: 10,
        searchQuery: '',
        page: 1,
        pages: 0,
        loading: true,
        error: false,
        hidePagination: false,
        errorMsg: '',
        headers: [
          { text: 'ID', sortable: false, value: 'id' },
          { text: 'Name', value: 'name' },
          { text: 'URL', sortable: false, value: 'url' },
          { text: 'Created At', value: 'created_at' }
        ],
        websites: []
      };
    },
    created: function() {
      this.getWebsites();
    },
    filters: {
      moment: function (date) {
        return moment(date).format('MMMM Do YYYY');
      }
    },
    methods: {
      processResError (err, errorMsg) {
        console.warn('Error getting search results: ', err);

        this.loading = false;
        this.websites = [];
        this.error = true;
        this.hidePagination = true;
        this.errorMsg = err.response.data.message || errorMsg;

        setTimeout(() => {
          this.error = false;
          this.errorMsg = '';
        }, 3000);
      },
      getWebsites () {
        const offset = (this.page - 1) * this.itemsLimit
        getAllWebsites(offset, this.itemsLimit)
          .then(res => {
            this.websites = res.data.data.websites;
            this.pages = Math.ceil(res.data.data.total / this.itemsLimit);
            this.loading = false;
            this.hidePagination = false;
          })
          .catch(err => this.processResError(err))
      },
      paginationChange () {
        this.getWebsites();
      },
      searchKeyUp: _.debounce(function () {
        if (this.searchQuery.length >= 3) {
          this.loading = true;
          searchWebsites(this.searchQuery)
          .then(res => {
            this.loading = false;
            this.websites = res.data.data.websites;
            this.hidePagination = true;
          })
          .catch(err => {
            if (err.response.status === statusCodes.NOT_FOUND) { // We will process 404 as valid response with no data
              this.websites = [];
              this.loading = false;
              this.hidePagination = true;
            } else {
              this.processResError(err)
            }
          })
        } else if (this.searchQuery.length === 0) {
          this.getWebsites();
        } 
      }, 200)
    }
  }
</script>

<style>
h3 {
  margin-bottom: 5%;
}
.results__pagination {
  margin: 1rem 0 !important;
}
</style>