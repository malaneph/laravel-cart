<?php
/**
 * 2025_05_28_152146_create_orders_table.php
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

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('customer');
            $table->integer('status');
            $table->text('customer_comment');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
