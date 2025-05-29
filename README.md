# Laravel Cart

Проект корзины покупок на Laravel с использованием Inertia.js и Vue.js.

## Требования

- PHP 8.2 или выше
- Composer
- Node.js и NPM
- MySQL или PostgreSQL

## Установка

Выполните следующие команды:
```bash
git clone https://github.com/malaneph/laravel-cart.git
cd laravel-cart

# Установка composer
composer install

# Установка зависимостей JavaScript
npm install

# Копирование файла .env
cp .env.example .env

# Запуск миграций
php artisan migrate:fresh --seed

# Сборка ассетов и запуск сервера
npm run build && php artisan serve
```
Данные тестового пользователя:

- **Username**: test@example.com
- **Password**: secret

