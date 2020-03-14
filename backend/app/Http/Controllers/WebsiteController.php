<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use App\Website;
use App\Http\Requests\WebsitesGetRequest;
use App\Http\Requests\WebsiteCreateRequest;
use App\Http\Requests\WebsitesSearchRequest;

class WebsiteController extends Controller
{
    /**
     * Get a listing of the resource.
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
        try {
            $total = Website::count();

            if ($total === 0) {
                return response()->json([
                    'message' => __('api.websites.get.notFound'),
                    'data' => [ 'total' => 0, 'websites' => [] ]
                ], JsonResponse::HTTP_NOT_FOUND);
            }

            $websites = Website::offset($request->get('offset'))
                                ->limit($request->get('limit'))
                                ->get();

            return response()->json([
                'message' => __('api.websites.get.success'),
                'data' => [
                    'total' => $total,
                    'websites' => $websites
                ]
            ], JsonResponse::HTTP_OK);
        } catch (Exception $e) {
            Log::error($e);
            return response()->json([
                'message' => __('api.generic.errors.500'),
                'data' => [ 'total' => 0, 'websites' => [] ]
            ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Store a newly created resource in the batabase.
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
        try {
            $website = Website::create($request->only(['name', 'url']));

            return response()->json([
                'message' => __('api.websites.create.success'),
                'data' => $website
            ], JsonResponse::HTTP_OK);
        } catch (Exception $e) {
            Log::error($e);
            return response()->json([
                'message' => __('api.generic.errors.500'),
                'data' => null
            ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
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
    public function getSearch(WebsitesSearchRequest $request) {
        try {
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
        } catch (Exception $e) {
            Log::error($e);
            return response()->json([
                'message' => __('api.generic.errors.500'),
                'data' => [ 'websites' => [] ]
            ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
