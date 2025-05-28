<?php
/**
 * 2025_05_28_150735_create_order_items_table.php
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

use App\Models\Order;
use App\Models\Product;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->integer('amount');
            $table->foreignIdFor(Product::class);
            $table->foreignIdFor(Order::class);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};
