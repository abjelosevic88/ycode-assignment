<template>
  <v-app id="inspire">
    <v-navigation-drawer
      v-model="drawer"
      app
    >
      <v-list dense>
        <v-list-item exact link to="/websites">
          <v-list-item-action>
            <v-icon>mdi-web</v-icon>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title>All Websites</v-list-item-title>
          </v-list-item-content>
        </v-list-item>
        <v-list-item exact link to="/websites/create">
          <v-list-item-action>
            <v-icon>mdi-bank-plus</v-icon>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title>Website Creation</v-list-item-title>
          </v-list-item-content>
        </v-list-item>
      </v-list>
    </v-navigation-drawer>

    <v-app-bar
      app
      color="indigo"
      dark
    >
      <v-app-bar-nav-icon @click.stop="drawer = !drawer" />
      <v-toolbar-title>YCode Application</v-toolbar-title>
    </v-app-bar>

    <v-content class="pa-0">
      <v-container
        fluid
      >
        <v-row
          align="start"
          justify="start"
        >
          <v-col class="text-center">
            <router-view/>
          </v-col>
        </v-row>
      </v-container>
    </v-content>
    <v-footer
      color="indigo"
      app
    >
      <span class="white--text">&copy; 2020</span>
    </v-footer>
  </v-app>
</template>

<script>
  export default {
    props: {
      source: String,
    },
    data: () => ({
      drawer: null,
    }),
  }
</script>

<style>
  a:hover {
    text-decoration: none;
  }
  .container {
    margin-top: 5rem;
  }
</style>