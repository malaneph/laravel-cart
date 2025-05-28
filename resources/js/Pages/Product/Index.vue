<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { Head, Link } from '@inertiajs/vue3'
import PrimaryButton from "@/Components/PrimaryButton.vue";
import {
    Table,
    TableBody,
    TableCell,
    TableHead,
    TableHeader,
    TableRow,
} from '@/components/ui/table';
import DangerButton from "@/Components/DangerButton.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";

defineProps({
    products: {
        type: Array
    }
})
</script>

<template>
    <Head title="Товары" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Товары</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <PrimaryButton :style="{ 'background-color': 'green' }" :href="route('categories.create')">
                            <Link :href="route('products.create')">
                                Добавить новый товар
                            </Link>
                        </PrimaryButton>
                    </div>
                    <div class="p-6 text-gray-900 overflow-x-auto">
                        <Table>
                            <TableHeader>
                                <TableRow>
                                    <TableHead class="w-[100px]">
                                        ID
                                    </TableHead>
                                    <TableHead>Название</TableHead>
                                    <TableHead>Категория</TableHead>
                                    <TableHead>Описание</TableHead>
                                    <TableHead class="text-right">Цена</TableHead>
                                </TableRow>
                            </TableHeader>
                            <TableBody>
                                <TableRow v-for="product in products" :key="product.id" class="hover:bg-gray-100 focus-within:bg-gray-100">
                                    <TableCell class="font-medium">
                                        {{ product.id }}
                                    </TableCell>
                                    <TableCell>
                                        {{ product.name }}
                                    </TableCell>
                                    <TableCell>
                                        <span v-for="category in product.category" :key="product.category.id">
                                                                    {{ category.name }}
                                        </span>
                                    </TableCell>
                                    <TableCell>
                                        {{ product.description }}
                                    </TableCell>
                                    <TableCell class="text-right">
                                        {{ product.price }}
                                    </TableCell>
                                    <TableCell>
                                        <SecondaryButton>
                                            <Link :href="`/products/${product.id}/edit`" method="get">
                                                Редактировать
                                            </Link>
                                        </SecondaryButton>
                                    </TableCell>
                                    <TableCell>
                                        <DangerButton class="fa-trash">
                                            <Link :href="`/products/${product.id}/delete`" method="post" :data="{ id: product.id }">
                                                Удалить
                                            </Link>
                                        </DangerButton>
                                    </TableCell>
                                </TableRow>
                                <TableRow v-if="products.length === 0">
                                    <TableCell class="px-6 py-4 border-t" colspan="4">Товаров не найдено</TableCell>
                                </TableRow>
                            </TableBody>
                        </Table>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
