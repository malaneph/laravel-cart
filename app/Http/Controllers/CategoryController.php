<?php

namespace App\Http\Controllers;

use App\Http\Requests\Category\BaseRequest;
use App\Http\Requests\Category\DeleteRequest;
use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

class CategoryController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('Category/Index', [
            'categories' => Category::all()
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('Category/Create');
    }

    public function store(BaseRequest $request): RedirectResponse
    {
        Category::create($request->validated());

        return to_route('categories.index')->with('success', 'Категория создана успешно');
    }

    public function delete(DeleteRequest $request): RedirectResponse
    {
        Category::where('id', $request->validated(['id']))->delete();

        return to_route('categories.index')->with('success', 'Категория удалена успешно');
    }
}
