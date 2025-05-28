<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { Head, useForm, usePage } from '@inertiajs/vue3'
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
    SelectValue
} from "@/components/ui/select/index.js"
import {Textarea} from "@/components/ui/textarea/index.js";

const page = usePage()
const form = useForm(page.props.product)
const submit = () => {
    form.post(route('products.update', form))
}

defineProps({
    categories: {
        type: Array
    },
    product: {
        type: Object
    }
})
</script>

<template>
    <Head title="Добавить товар" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Изменить товар</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 overflow-x-auto">
                        <div class="p-6 text-gray-900 overflow-x-auto">
                            <form @submit.prevent="submit" class="flex flex-col gap-4">
                                <div class="form-group w-2/5">
                                    <InputLabel for="name" value="Название товара" />
                                    <TextInput
                                        id="name"
                                        type="text"
                                        v-model="form.name"
                                        :disabled="form.processing">
                                        {{ product.name }}
                                    </TextInput>
                                    <InputError :message="form.errors.name" />
                                </div>

                                <div class="form-group w-2/5">
                                    <InputLabel for="category_id" value="Категория" />
                                    <Select :defaultValue="product.category_id">
                                        <SelectTrigger>
                                            <SelectValue placeholder="Выберите категорию" class="text-base"/>
                                        </SelectTrigger>
                                        <SelectContent>
                                            <SelectGroup>
                                                <SelectItem v-for="category in categories" :key="category.id" :value="category.id" class="text-base">
                                                    {{ category.name }}
                                                </SelectItem>
                                            </SelectGroup>
                                        </SelectContent>
                                    </Select>
                                    <InputError :message="form.errors.category_id" />
                                </div>

                                <div class="form-group w-2/5">
                                    <InputLabel for="description" value="Описание товара" />
                                    <Textarea
                                        id="description"
                                        type="text"
                                        v-model="form.description"
                                        :disabled="form.processing"
                                        class="text-base">
                                        {{ product.description }}
                                    </Textarea>
                                    <InputError :message="form.errors.description" />
                                </div>

                                <div class="form-group w-2/5">
                                    <InputLabel for="price" value="Цена товара" />
                                    <TextInput
                                        id="price"
                                        type="text"
                                        v-model="form.price"
                                        :disabled="form.processing">
                                        {{ product.price }}
                                    </TextInput>
                                    <InputError :message="form.errors.price" />
                                </div>

                                <div>
                                    <PrimaryButton :processing="form.processing">
                                        Сохранить изменения
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
