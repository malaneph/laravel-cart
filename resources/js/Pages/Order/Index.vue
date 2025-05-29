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
    orders: {
        type: Array
    }
})
</script>

<template>
    <Head title="Заказы" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Заказы</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <PrimaryButton :style="{ 'background-color': 'green' }" :href="route('categories.create')">
                            <Link :href="route('orders.create')">
                                Добавить новый заказ
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
                                    <TableHead>ФИО покупателя</TableHead>
                                    <TableHead>Комментарий покупателя</TableHead>
                                    <TableHead>Статус</TableHead>
                                    <TableHead>Товар</TableHead>
                                    <TableHead class="text-right">Сумма заказа</TableHead>
                                </TableRow>
                            </TableHeader>
                            <TableBody>
                                <TableRow v-for="order in orders" :key="order.id" class="hover:bg-gray-100 focus-within:bg-gray-100">
                                    <TableCell class="font-medium">
                                        {{ order.id }}
                                    </TableCell>
                                    <TableCell>
                                        {{ order.customer }}
                                    </TableCell>
                                    <TableCell>
                                        {{ order.customer_comment }}
                                    </TableCell>
                                    <TableCell>
                                        {{ order.status }}
                                    </TableCell>
                                    <TableCell>
                                        <span v-for="item in order.items" :key="item.product.id">
                                            {{ item.product.name }} , {{ item.amount }} шт.
                                        </span>
                                    </TableCell>
                                    <TableCell class="text-right">
                                        {{ order.total_price }}
                                    </TableCell>
                                    <TableCell>
                                        <SecondaryButton>
                                            <Link :href="`/orders/${order.id}/edit`" method="get">
                                                Редактировать
                                            </Link>
                                        </SecondaryButton>
                                    </TableCell>
                                    <TableCell>
                                        <DangerButton class="fa-trash">
                                            <Link :href="`/orders/${order.id}/delete`" method="post" :data="{ id: order.id }">
                                                Удалить
                                            </Link>
                                        </DangerButton>
                                    </TableCell>
                                </TableRow>
                                <TableRow v-if="orders.length === 0">
                                    <TableCell class="px-6 py-4 border-t" colspan="4">Заказов не найдено</TableCell>
                                </TableRow>
                            </TableBody>
                        </Table>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
