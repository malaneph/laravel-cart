<?php
/**
 * Order.php
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

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';
    protected $fillable = ['customer', 'status', 'customer_comment'];

    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class, 'product_id');
    }

    public static function getTotalPrice(Order $order): float
    {
        $sum = 0;

        foreach ($order->items as $item) {
            $sum += $item->product->price * $item->amount;
        }

        return $sum;
    }
}
