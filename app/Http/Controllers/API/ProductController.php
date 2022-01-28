<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\CreateProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;
use App\Http\Resources\DataResource;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        $products = Product::all();
        return DataResource::collection($products);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateProductRequest $request
     * @return DataResource
     */
    public function store(CreateProductRequest $request): DataResource
    {
        $product = Product::create($request->validated());
        return new DataResource($product);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return DataResource
     */
    public function show(int $id): DataResource
    {
        $product = Product::findOrFail($id);
        return new DataResource($product);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateProductRequest $request
     * @param int $id
     * @return DataResource
     */
    public function update(UpdateProductRequest $request, int $id): DataResource
    {
        $product = Product::findOrFail($id);
        $product->update($request->validated());

        return new DataResource($product->refresh());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return bool
     */
    public function destroy(int $id): bool
    {
        $product = Product::findOrFail($id);
        return $product->delete();
    }
}
