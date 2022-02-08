<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Resources\Product as ProductResource;
use App\Http\Controllers\BaseController as BaseController;

class ProductController extends BaseController
{
    /**
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $products = Product::all();

        return $this->sendResponse(ProductResource::collection($products), 'Todos Products retornados com sucesso.');
    }
    /**
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'name' => 'required'
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', [
                'name' => 'required'
            ]);
        }

        $product = Product::create($input);

        return $this->sendResponse(new ProductResource($product), 'Product criado com sucesso.');
    }

    /**
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        $product = Product::find($id);

        if (is_null($product)) {
            return $this->sendError('Product não encontrado.');
        }

        return $this->sendResponse(new ProductResource($product), 'Product de ID ' . $id . ' retornado com sucesso.');
    }

    /**
     *
     * @param Request $request
     * @param Product $product
     * @return JsonResponse
     */
    public function update(Request $request, Product $product): JsonResponse
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'name' => 'required'
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', [
                'name' => 'required'
            ]);
        }

        $product->name = $input['name'];
        $product->save();

        return $this->sendResponse(new ProductResource($product), 'Product atualizado com sucesso.');
    }

    /**
     *
     * @param Product $product
     * @return JsonResponse
     */
    public function destroy(Product $product): JsonResponse
    {
        $product->delete();

        return $this->sendResponse([], 'Product excluido com sucesso.');
    }
}
