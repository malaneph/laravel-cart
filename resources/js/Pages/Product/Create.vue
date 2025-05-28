<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { Head, useForm } from '@inertiajs/vue3'
import InputError from '@/Components/InputError.vue'
import InputLabel from '@/Components/InputLabel.vue'
import PrimaryButton from '@/Components/PrimaryButton.vue'
import TextInput from '@/Components/TextInput.vue'
import {
    Select,
    SelectContent,
    SelectGroup,
    SelectItem,
    SelectTrigger,
    SelectValue,
} from '@/components/ui/select'

const form = useForm({
    name: '',
    category_id: '',
    description: '',
    price: ''
})
const submit = () => {
    form.post(route('products.store'))
}

defineProps({
    categories: {
        type: Array
    }
})
</script>

<template>
    <Head title="Добавить товар" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Добавить товар</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 overflow-x-auto">
                        <div class="p-6 text-gray-900 overflow-x-auto">
                            <form @submit.prevent="submit" class="flex flex-col gap-4">
                                <div class="form-group">
                                    <InputLabel for="name" value="Название товара" />
                                    <TextInput
                                        id="name"
                                        type="text"
                                        v-model="form.name"
                                        :disabled="form.processing"
                                    />
                                    <InputError :message="form.errors.name" />
                                </div>

                                <div class="form-group">
                                    <InputLabel for="category_id" value="Категория" />
                                    <Select v-model="form.category_id">
                                        <SelectTrigger>
                                            <SelectValue placeholder="Выберите категорию" />
                                        </SelectTrigger>
                                        <SelectContent>
                                            <SelectGroup>
                                                <SelectItem v-for="category in categories" :key="category.id" :value="category.id">
                                                    {{ category.name }}
                                                </SelectItem>
                                            </SelectGroup>
                                        </SelectContent>
                                    </Select>
                                    <InputError :message="form.errors.category_id" />
                                </div>

                                <div class="form-group">
                                    <InputLabel for="description" value="Описание товара" />
                                    <TextInput
                                        id="description"
                                        type="text"
                                        v-model="form.description"
                                        :disabled="form.processing"
                                    />
                                    <InputError :message="form.errors.description" />
                                </div>

                                <div class="form-group">
                                    <InputLabel for="price" value="Цена товара" />
                                    <TextInput
                                        id="price"
                                        type="text"
                                        v-model="form.price"
                                        :disabled="form.processing"
                                    />
                                    <InputError :message="form.errors.price" />
                                </div>

                                <div>
                                    <PrimaryButton :processing="form.processing">
                                        Создать
                                    </PrimaryButton>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<style scoped>

</style>
