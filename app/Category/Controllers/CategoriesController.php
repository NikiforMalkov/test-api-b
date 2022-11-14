<?php

namespace App\Category\Controllers;

use App\Http\Controllers\Controller;
use App\Category\Services\CategoryService;

/**
 * @OA\Info(
 *      version="1.0.0",
 *      title="L5 OpenApi",
 *      description="L5 Swagger OpenApi description"
 * )
 * @OA\Get(
 *     path="/",
 *     description="Home page",
 *     @OA\Response(response="default", description="Welcome page")
 * )
 */
class CategoriesController extends Controller
{

    /**
     * @OA\Get(
     *      path="/api/category/all",
     *      operationId="categoryAll",
     *      tags={"Category"},
     *      summary="Get all categories",
     *      description="Get all categories",
     *
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\MediaType(
     *              mediaType="application/json",
     *          )
     *      ),
     *      @OA\Response(
     *          response=422,
     *          description="Bad Request"
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     * )
     */
    public function all(CategoryService $categoryService)
    {
        return $categoryService->all();
    }

}
