<?php
/**
 * OrderFactory.php
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

namespace Database\Factories;

use App\Enums\Order\StatusEnum;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class OrderFactory extends Factory
{
    protected $model = Order::class;

    public function definition(): array
    {
        return [
            'status' => $this->faker->randomElement(StatusEnum::cases()),
            'customer' => $this->faker->name(),
            'customer_comment' => $this->faker->word(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }

    public function configure()
    {
        $products = Product::all() ?? Product::factory(10);

        return $this->afterCreating(function (Order $order) use ($products) {
            $order->items()->create([
                'order_id' => $order->id,
                'product_id' => $products->random()->id,
                'amount' => $this->faker->numberBetween(1, 10),
            ]);
        });
    }
}
