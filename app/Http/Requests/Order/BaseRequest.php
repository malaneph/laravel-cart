<?php
/**
 * BaseRequest.php
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

namespace App\Http\Requests\Order;

use App\Enums\Order\StatusEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BaseRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'customer' => ['required', 'string', 'max:255'],
            'status' => ['required', 'integer', Rule::in(array_column(StatusEnum::values(), 'value'))],
            'customer_comment' => ['required', 'string', 'max:255'],
            'items' => ['required', 'array', 'min:1'],
            'items.*.product_id' => ['distinct','integer', Rule::exists('products', 'id')],
            'items.*.amount' => ['required', 'integer', 'min:1'],
        ];
    }
}
