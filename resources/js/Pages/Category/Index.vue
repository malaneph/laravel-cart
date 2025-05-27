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

defineProps({
    categories: {
        type: Array
    }
})
</script>

<template>
    <Head title="Категории" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Категории</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <PrimaryButton :style="{ 'background-color': 'green' }" :href="route('categories.create')">
                            <Link :href="route('categories.create')">
                                Добавить новую категорию
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
                                </TableRow>
                            </TableHeader>
                            <TableBody>
                                <TableRow v-for="category in categories" :key="category.id" class="hover:bg-gray-100 focus-within:bg-gray-100">
                                    <TableCell class="font-medium">
                                        {{ category.id }}
                                    </TableCell>
                                    <TableCell>
                                        {{ category.name }}
                                    </TableCell>
                                    <TableCell class="text-right">
                                        <DangerButton>
                                            <Link href="/categories/delete" method="post" :data="{ id: category.id }">
                                                Удалить
                                            </Link>
                                        </DangerButton>
                                    </TableCell>
                                </TableRow>
                                <TableRow v-if="categories.length === 0">
                                    <TableCell class="px-6 py-4 border-t" colspan="4">Категорий не найдено</TableCell>
                                </TableRow>
                            </TableBody>
                        </Table>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
