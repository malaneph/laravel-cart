<?php

namespace App\Http\Controllers;

use App\Http\Requests\Product\BaseRequest;
use App\Http\Resources\ProductResource;
use App\Models\Category;
use App\Models\Product;
use Inertia\Inertia;
use Inertia\Response;
use Throwable;

class ProductController extends Controller
{
    /**
     * @throws Throwable
     */
    public function index()
    {
        return Inertia::render('Product/Index', [
            'products' => Product::all()->toResourceCollection()->jsonSerialize()
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('Product/Create', [
            'categories' => Category::all()
        ]);
    }

    public function store(BaseRequest $request)
    {
        Product::create($request->validated());

        return to_route('products.index')->with('success', 'Товар создан успешно');
    }

    public function edit(Product $product)
    {
        return Inertia::render('Product/Edit', [
            'product' => $product,
            'categories' => Category::all()
        ]);
    }

    public function update(BaseRequest $request, Product $product)
    {
        $product->update($request->validated());

        return to_route('products.index')->with('success', 'Товар обновлен успешно');
    }

    public function delete(Product $product)
    {
        $product->delete();

        return to_route('products.index')->with('success', 'Товар удален успешно');
    }
}
