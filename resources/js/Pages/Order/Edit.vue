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
const form = useForm({
    customer: page.props.order.customer,
    status: page.props.order.status,
    customer_comment: page.props.order.customer_comment,
    items: page.props.order.items
})

const addItem = () => {
    form.items.push({
        product_id: '',
        amount: '',
        price: ''
    })
}

const removeItem = (index) => {
    form.items.splice(index, 1)
}

const handleProductChange = (index) => {
    const selectedProduct = page.props.products.find(p => p.id === form.items[index].product_id)
    if (selectedProduct) {
        form.items[index].price = selectedProduct.price
        form.items[index].amount = '1'
    }
}

const submit = () => {
    form.put(route('orders.update', page.props.order.id))
}

defineProps({
    order: {
        type: Object
    },
    products: {
        type: Array
    },
    statuses: {
        type: Array
    }
})
</script>

<template>
    <Head title="Изменить заказ" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Изменить заказ</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 overflow-x-auto">
                        <div class="p-6 text-gray-900 overflow-x-auto">
                            <form @submit.prevent="submit" class="flex flex-col gap-4">
                                <div class="form-group w-2/5">
                                    <InputLabel for="customer" value="ФИО покупателя" />
                                    <TextInput
                                        id="name"
                                        type="text"
                                        v-model="form.customer"
                                        :disabled="form.processing">
                                        {{ order.customer }}
                                    </TextInput>
                                    <InputError :message="form.errors.name" />
                                </div>

                                <div class="form-group w-2/5">
                                    <InputLabel for="status" value="Статус" />
                                    <Select v-model="form.status">
                                        <SelectTrigger>
                                            <SelectValue placeholder="Выберите статус" />
                                        </SelectTrigger>
                                        <SelectContent>
                                            <SelectGroup>
                                                <SelectItem v-for="status in statuses" :key="status.value" :value="status.value">
                                                    {{ status.description }}
                                                </SelectItem>
                                            </SelectGroup>
                                        </SelectContent>
                                    </Select>
                                    <InputError :message="form.errors.status" />
                                </div>

                                <div class="form-group w-2/5">
                                    <InputLabel for="customer_comment" value="Комментарий покупателя" />
                                    <Textarea
                                        id="customer_comment"
                                        type="text"
                                        v-model="form.customer_comment"
                                        :disabled="form.processing"
                                        class="text-base">
                                    </Textarea>
                                    <InputError :message="form.errors.customer_comment" />
                                </div>

                                <div class="form-group w-2/5">
                                    <div class="grow">
                                        <div v-for="(item, index) in form.items" :key="index" class="mb-4 p-4 border rounded">
                                            <div class="flex justify-between items-center mb-2">
                                                <h3 class="font-medium">Товар #{{ index + 1 }}</h3>
                                                <button
                                                    type="button"
                                                    @click="removeItem(index)"
                                                    class="text-red-600 hover:text-red-800"
                                                    v-if="form.items.length > 1">
                                                    Удалить
                                                </button>
                                            </div>
                                            <div class="flex gap-4 items-end">
                                                <div class="flex-1">
                                                    <InputLabel :for="'product_id_' + index" value="Товар"/>
                                                    <Select 
                                                        v-model="form.items[index].product_id"
                                                        @update:modelValue="handleProductChange(index)">
                                                        <SelectTrigger>
                                                            <SelectValue placeholder="Выберите товар"/>
                                                        </SelectTrigger>
                                                        <SelectContent>
                                                            <SelectGroup>
                                                                <SelectItem v-for="product in products" :key="product.id"
                                                                            :value="product.id">
                                                                    {{ product.name }}
                                                                </SelectItem>
                                                            </SelectGroup>
                                                        </SelectContent>
                                                    </Select>
                                                </div>

                                                <div class="w-32">
                                                    <InputLabel :for="'amount_' + index" value="Количество"/>
                                                    <input
                                                        type="number"
                                                        class="rounded border-gray-300 w-full"
                                                        v-model="form.items[index].amount"
                                                        min="1">
                                                </div>

                                                <div class="w-32">
                                                    <InputLabel value="Сумма"/>
                                                    <div class="rounded border-gray-300 w-full p-2 bg-gray-50">
                                                        {{ (form.items[index].price * form.items[index].amount).toFixed(2) }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <button
                                            type="button"
                                            @click="addItem"
                                            class="mt-2 px-4 py-2 bg-gray-100 hover:bg-gray-200 rounded">
                                            + Добавить товар
                                        </button>
                                    </div>
                                    <InputError :message="form.errors.items" />
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
