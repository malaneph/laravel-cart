<?php
/**
 * ProductSeeder.php
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

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            [
                'name' => 'Беспроводные наушники',
                'description' => 'Компактные наушники с шумоподавлением и длительным временем работы.',
                'category' => 'легкий',
                'price' => 4590.00
            ],
            [
                'name' => 'Хрустальный бокал',
                'description' => 'Изящный бокал из хрусталя для вина, требует бережного обращения.',
                'category' => 'хрупкий',
                'price' => 1290.50
            ],
            [
                'name' => 'Гантеля 10 кг',
                'description' => 'Металлическая гантеля с прорезиненным покрытием для домашних тренировок.',
                'category' => 'тяжелый',
                'price' => 1850.00
            ],
            [
                'name' => 'Перьевая ручка',
                'description' => 'Стильная ручка с тонким пером, идеальна для подарка.',
                'category' => 'легкий',
                'price' => 980.99
            ],
            [
                'name' => 'Фарфоровая ваза',
                'description' => 'Декоративная ваза из тонкого фарфора с ручной росписью.',
                'category' => 'хрупкий',
                'price' => 3750.00
            ],
            [
                'name' => 'Металлический сейф',
                'description' => 'Надежный сейф для хранения документов и ценностей.',
                'category' => 'тяжелый',
                'price' => 11200.75
            ],
            [
                'name' => 'Солнечные очки',
                'description' => 'Очки с поляризацией для защиты глаз от ультрафиолета.',
                'category' => 'легкий',
                'price' => 2150.00
            ],
            [
                'name' => 'Зеркало настенное',
                'description' => 'Большое зеркало в деревянной раме, требует осторожности при транспортировке.',
                'category' => 'хрупкий',
                'price' => 6890.49
            ],
            [
                'name' => 'Кирпич строительный',
                'description' => 'Стандартный керамический кирпич для строительных работ.',
                'category' => 'тяжелый',
                'price' => 45.00
            ],
            [
                'name' => 'Пластиковый контейнер',
                'description' => 'Легкий и прочный контейнер для хранения вещей.',
                'category' => 'легкий',
                'price' => 320.25
            ]
        ];

        $categories = Category::all();

        foreach ($products as $product) {
            Product::create([
                'name' => $product['name'],
                'description' => $product['description'],
                'category_id' => $categories->where('name', $product['category'])->first()->id ?? 1,
                'price' => $product['price'],
            ]);
        }
    }
}
