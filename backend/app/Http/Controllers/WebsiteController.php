<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use App\Website;
use App\Http\Requests\WebsitesGetRequest;
use App\Http\Requests\WebsiteCreateRequest;
use App\Http\Requests\WebsitesSearchRequest;
use App\Traits\ApiRequestTrait;

class WebsiteController extends Controller
{
    use ApiRequestTrait;

    /**
     * Get a listing of the websites.
     *
     * @queryParam      limit     integer   Offset value.
     * @queryParam      offset    integer   Limit value.
     *
     * @responseFile 200 responses/websites/get/200.json
     * @responseFile 404 responses/websites/get/404.json
     * @responseFile 500 responses/websites/get/500.json
     *
     * @param  \App\Http\Requests\WebsitesGetRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function getWebsites(WebsitesGetRequest $request)
    {
        return $this->handleRequest(function () use ($request) {
            $websites = Website::offset($request->get('offset', Website::PAGINATION_OFFSET))
                                ->limit($request->get('limit', Website::PAGINATION_LIMIT))
                                ->get();

            if (count($websites) === 0) {
                return response()->json([
                    'message' => __('api.websites.get.notFound'),
                    'data' => [ 'total' => 0, 'websites' => [] ]
                ], JsonResponse::HTTP_NOT_FOUND);
            }

            $total = Website::count();

            return response()->json([
                'message' => __('api.websites.get.success'),
                'data' => [
                    'total' => $total,
                    'websites' => $websites
                ]
            ], JsonResponse::HTTP_OK);
        });
    }

    /**
     * Store a newly created website in the database.
     *
     * @bodyParam      name  string  required    Name of the website.
     * @bodyParam      url   string  required    The URL of the website.
     *
     * @responseFile 200 responses/websites/create/200.json
     * @responseFile 500 responses/websites/create/500.json
     *
     * @param  \App\Http\Requests\WebsitesCreateRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function postWebsite(WebsiteCreateRequest $request)
    {
        return $this->handleRequest(function () use ($request) {
            $website = Website::create($request->only(['name', 'url']));

            return response()->json([
                'message' => __('api.websites.create.success'),
                'data' => $website
            ], JsonResponse::HTTP_OK);
        });
    }

    /**
     * Search websites based on query string.
     *
     * @queryParam   query   string   required   Search query string.
     *
     * @responseFile 200 responses/websites/search/200.json
     * @responseFile 404 responses/websites/search/404.json
     * @responseFile 500 responses/websites/search/500.json
     *
     * @param  \App\Http\Requests\WebsitesSearchRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function getSearch(WebsitesSearchRequest $request)
    {
        return $this->handleRequest(function () use ($request) {
            $websites = Website::where('name', 'like', '%' . $request->get('query') . '%')
                                ->limit(Website::PAGINATION_LIMIT)
                                ->get();

            if (count($websites) === 0) {
                return response()->json([
                    'message' => __('api.websites.get.notFound'),
                    'data' => [ 'websites' => [] ]
                ], JsonResponse::HTTP_NOT_FOUND);
            }

            return response()->json([
                'message' => __('api.websites.get.success'),
                'data' => [ 'websites' => $websites ]
            ], JsonResponse::HTTP_OK);
        });
    }
}
