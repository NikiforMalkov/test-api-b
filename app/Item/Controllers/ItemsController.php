<?php

namespace App\Item\Controllers;

use App\Http\Controllers\Controller;
use App\Item\Requests\SearchRequest;
use App\Item\Services\ItemService;

class ItemsController extends Controller
{

    /**
     * @OA\Get(
     *      path="/api/item/search",
     *      operationId="all",
     *      tags={"Item"},
     *      summary="Find items",
     *      description="Find items by given query",
     *
     *   @OA\Parameter(
     *      name="query",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     *   @OA\Parameter(
     *      name="orderBy",
     *      in="query",
     *      required=false,
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
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
    public function search (SearchRequest $request, ItemService $service){
        $searchRequestDto = $request->data();
        return $service->search($searchRequestDto);
    }

}
