<?php

namespace App\Category\Controllers;

use App\Http\Controllers\Controller;
use App\Category\Services\CategoryServiceInterface;
use App\Category\Requests\UpdateCategoryRequest;

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
    public function all(CategoryServiceInterface $categoryService)
    {
        return $categoryService->all();
    }

    /**
     * @OA\Put(
     *      path="/api/category/{id}",
     *      operationId="updateCategory",
     *      tags={"Category"},
     *      summary="update category",
     *      description="update category",
     *
     *   @OA\Parameter(
     *      name="id",
     *      in="path",
     *      required=true,
     *      @OA\Schema(
     *           type="integer"
     *      )
     *   ),
     *
     *   @OA\RequestBody(
     *      required=true,
     *      description="Pass user credentials",
     *      @OA\JsonContent(
     *         required={"name"},
     *         @OA\Property(property="name", type="string", example="CategoryName"),
     *         @OA\Property(property="parent_id", type="integer", example="1"),
     *         @OA\Property(property="index", type="integer", example="1"),
     *      ),
     *   ),
     *
     *   @OA\Response(
     *       response=200,
     *       description="Successful operation",
     *       @OA\JsonContent(ref="#/components/schemas/Category"),
     *   ),
     *   @OA\Response(
     *       response=422,
     *       description="Bad Request"
     *   ),
     *   @OA\Response(
     *       response=404,
     *       description="Not found"
     *   )
     * )
     */
    public function update(UpdateCategoryRequest $request, CategoryServiceInterface $service) {
        $updateCategoryDto = $request->data();
        return $service->update($updateCategoryDto);
    }

}
