<?php
/**
 * OrderController.php
 *
 * PHP Version 8.3
 *
 * @category  File
 * @package   laravel-cart
 * @author    Sandal <sandalkaigorodov@gmail.com>
 * @copyright 2025 laravel-cart
 * @license   MIT License
 * @link      https://github.com/malaneph/laravel-cart
 */

namespace App\Http\Controllers;

use App\Enums\Order\StatusEnum;
use App\Http\Requests\Order\BaseRequest;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use Inertia\Response;
use Throwable;

class OrderController extends Controller
{
    /**
     * @throws Throwable
     */
    public function index()
    {
        return Inertia::render('Order/Index', [
            'orders' => Order::all()->toResourceCollection()->jsonSerialize()
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('Order/Create', [
            'products' => Product::all()->toResourceCollection()->jsonSerialize(),
            'statuses' => StatusEnum::values()
        ]);
    }

    public function store(BaseRequest $request)
    {
        $data = $request->validated();

        DB::transaction(function () use ($data) {
            $order = Order::create([
                'customer' => $data['customer'],
                'status' => $data['status'],
                'customer_comment' => $data['customer_comment'],
            ]);

            $order->items()->insert(
                collect($data['items'])->map(function ($item) use ($order) {
                    $item['order_id'] = $order->id;
                    return $item;
                })->toArray()
            );
        });

        return to_route('orders.index')->with('success', 'Товар создан успешно');
    }

    public function edit(Order $order)
    {
        return Inertia::render('Order/Edit', [
            'order' => $order
        ]);
    }

    public function update(BaseRequest $request, Order $order)
    {
        $order->update($request->validated());

        return to_route('orders.index')->with('success', 'Товар обновлен успешно');
    }

    public function delete(Order $order)
    {
        $order->delete();

        return to_route('orders.index')->with('success', 'Товар удален успешно');
    }
}
