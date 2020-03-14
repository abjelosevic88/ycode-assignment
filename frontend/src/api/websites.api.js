import httpClient from './httpClient';

const END_POINT = '/websites';

/**
 * Get all websites endpooint call.
 * 
 * @param {Number}  offset  Offset number value.
 * @param {Number}  limit   Limit number value. This will be 10 buy default. 
 */
const getAllWebsites = (offset, limit) => httpClient.get(`${END_POINT}?limit=${limit}&offset=${offset}`);

/**
 * Create the new website endpoint call.
 * 
 * @param {String} name Name of the website.
 * @param {String} url Website URL value.
 */
const createWebsite = (name, url) => httpClient.post(END_POINT, { name, url });

/**
 * Search websites endpoint call.
 * 
 * @param {String} query Search websites query.
 */
const searchWebsites = query => httpClient.get(`${END_POINT}/search?query=${query}`);

export {
  getAllWebsites,
  createWebsite,
  searchWebsites
}