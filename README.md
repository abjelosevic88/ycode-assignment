# YCode Test Assignment

## Backed REST API server

Rest Api server was built using latest Laravel 7 framework. 

For database MySQL was used and this could easly replace with any other data store.

Website `factory` and `seeder` was created.

The following routes was added:
* `GET /api/websites` - returns all stored websites. This endpoint received limit and offset as optional params. Default `limit` is 10 and `offset` 0.
* `POST /api/websites` - stores the new website. Requires `name` and `url` to be passed. Url is unique. 
* `GET /api/websites/search` - return results by passed `query` params. `query` param is required.

The project was buit using standard Laravel function and coding standards.

API route end to end tests can be found inside: `backend/tests/Feature/WebsitesApiTest.php`.

Before the application can be run `.env` file must be created based on the `.env.example` file provided in the `backend/` root directory.

## Fronted

For the fromtend par Vue.js was used.

For the template design `Vuetify` was used.

As per request the following pages has been created:
* `/websites` - this page show full website results in a table preview. Sorting is enabled by `name` and `created date`. Sorting is done on the `frontend`. Filtering is enabled by `name` field. Filtering is being perfomed on the `backend` side by entering website name inside search input box. This search is triggered only after 3 letter was typed inside the input box with debounce timeout of `200` milliseconds. Also, pagination is enabled with lazy loading only data that is being shown to the user (in this case only 10 results per page).
* `/website/create` - the page for entering and creating new website. `name` and `url` fields are required. Both fields hace JS validation for availability and type (URL is being validated with the same Regex as on the server side for consistenci base). The form will show success/error alert based on the validity of the stored data.

Only screenshot test are added for all three components: `Layout.vue`, `Websites.vue` and `WebsitesCreate.vue`.

`axios` was used for the HTTP client.

Before the application can be run it is necessary to create `.env.local` file based on `.env.example` file provided in the root `frontend/` directory.