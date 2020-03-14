---
title: API Reference

language_tabs:
- bash
- javascript

includes:

search: true

toc_footers:
- <a href='http://github.com/mpociot/documentarian'>Documentation Powered by Documentarian</a>
---
<!-- START_INFO -->
# Info

Welcome to the generated API reference.
[Get Postman Collection](http://localhost/docs/collection.json)

<!-- END_INFO -->

#general


<!-- START_34850cc1045e37f27d82addd0a7c671e -->
## Get a listing of the resource.

> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/websites?limit=accusamus&offset=corrupti" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/websites"
);

let params = {
    "limit": "accusamus",
    "offset": "corrupti",
};
Object.keys(params)
    .forEach(key => url.searchParams.append(key, params[key]));

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "message": "Websites successfully found.",
    "data": {
        "total": 3,
        "websites": [
            {
                "id": 1,
                "name": "Prof. Yessenia Stark",
                "url": "https:\/\/www.mueller.comipsam-cupiditate-voluptatibus-ducimus-unde-id",
                "created_at": "2020-03-13T23:18:41.000000Z",
                "updated_at": "2020-03-13T23:18:41.000000Z"
            },
            {
                "id": 2,
                "name": "Royal DuBuque",
                "url": "https:\/\/torp.org\/recusandae-rem-et-cum-error-sit-temporibus-amet-eum.html",
                "created_at": "2020-03-13T23:18:41.000000Z",
                "updated_at": "2020-03-13T23:18:41.000000Z"
            },
            {
                "id": 3,
                "name": "Miss Katelin Simonis III",
                "url": "http:\/\/schultz.com\/id-dolore-nulla-quia-quia",
                "created_at": "2020-03-13T23:18:41.000000Z",
                "updated_at": "2020-03-13T23:18:41.000000Z"
            }
        ]
    }
}
```
> Example response (404):

```json
{
    "message": "Websites not found.",
    "data": {
        "total": 0,
        "websites": []
    }
}
```
> Example response (500):

```json
{
    "message": "Internal Server Error."
}
```

### HTTP Request
`GET api/websites`

#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    `limit` |  optional  | integer   Offset value.
    `offset` |  optional  | integer   Limit value.

<!-- END_34850cc1045e37f27d82addd0a7c671e -->

<!-- START_1328ad48f88e46e14588179b263d7673 -->
## Store a newly created resource in the batabase.

> Example request:

```bash
curl -X POST \
    "http://localhost/api/websites" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"name":"ut","url":"a"}'

```

```javascript
const url = new URL(
    "http://localhost/api/websites"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "name": "ut",
    "url": "a"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "message": "Website successfully created.",
    "data": {
        "name": "TEST NAME",
        "url": "http:\/\/www.effertz.co\/sss",
        "updated_at": "2020-03-14T13:34:26.000000Z",
        "created_at": "2020-03-14T13:34:26.000000Z",
        "id": 93
    }
}
```
> Example response (500):

```json
{
    "message": "Internal Server Error."
}
```

### HTTP Request
`POST api/websites`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `name` | string |  required  | Name of the website.
        `url` | string |  required  | The URL of the website.
    
<!-- END_1328ad48f88e46e14588179b263d7673 -->

<!-- START_dfc87a92f8947770bee88b3cd4c30a19 -->
## Search websites based on query string.

> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/websites/search?query=nihil" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/websites/search"
);

let params = {
    "query": "nihil",
};
Object.keys(params)
    .forEach(key => url.searchParams.append(key, params[key]));

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "message": "Websites successfully found.",
    "data": {
        "websites": [
            {
                "id": 1,
                "name": "Prof. Yessenia Stark",
                "url": "https:\/\/www.mueller.com\/ipsam-cupiditate-voluptatibus-ducimus-unde-id",
                "created_at": "2020-03-13T23:18:41.000000Z",
                "updated_at": "2020-03-13T23:18:41.000000Z"
            },
            {
                "id": 7,
                "name": "Prof. Giovanni Grimes",
                "url": "http:\/\/www.mckenzie.biz\/itaque-quo-tempore-consectetur-nisi.html",
                "created_at": "2020-03-13T23:18:41.000000Z",
                "updated_at": "2020-03-13T23:18:41.000000Z"
            },
            {
                "id": 26,
                "name": "Prof. Shana Rolfson",
                "url": "http:\/\/www.ruecker.net\/ut-et-odit-vel.html",
                "created_at": "2020-03-14T10:11:52.000000Z",
                "updated_at": "2020-03-14T10:11:52.000000Z"
            },
            {
                "id": 31,
                "name": "Prof. Rickey Senger Sr.",
                "url": "http:\/\/baumbach.com\/ea-sed-cupiditate-repudiandae-sit-quidem-nisi.html",
                "created_at": "2020-03-14T10:11:53.000000Z",
                "updated_at": "2020-03-14T10:11:53.000000Z"
            },
            {
                "id": 39,
                "name": "Prof. Nicola Jacobi",
                "url": "http:\/\/www.leannon.net\/hic-nemo-minus-quis-sunt-quidem-non-et-tempora",
                "created_at": "2020-03-14T10:11:53.000000Z",
                "updated_at": "2020-03-14T10:11:53.000000Z"
            },
            {
                "id": 54,
                "name": "Prof. Bryana Gleason IV",
                "url": "https:\/\/barrows.com\/et-laborum-mollitia-aliquid-aliquam-et-nulla.html",
                "created_at": "2020-03-14T10:12:14.000000Z",
                "updated_at": "2020-03-14T10:12:14.000000Z"
            },
            {
                "id": 57,
                "name": "Prof. Odie Berge",
                "url": "https:\/\/www.wilkinson.com\/ipsum-expedita-et-accusamus-corrupti-dolor",
                "created_at": "2020-03-14T10:12:14.000000Z",
                "updated_at": "2020-03-14T10:12:14.000000Z"
            }
        ]
    }
}
```
> Example response (404):

```json
{
    "message": "Websites not found.",
    "data": {
        "websites": []
    }
}
```
> Example response (500):

```json
{
    "message": "Internal Server Error."
}
```

### HTTP Request
`GET api/websites/search`

#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    `query` |  optional  | string   required   Search query string.

<!-- END_dfc87a92f8947770bee88b3cd4c30a19 -->


