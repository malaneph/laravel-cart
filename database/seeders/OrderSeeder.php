<?php
/**
 * OrderSeeder.php
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

namespace Database\Seeders;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    public function run(): void
    {
        $products = Product::all();

        Order::factory(10)->recycle($products)->create();
    }
}
