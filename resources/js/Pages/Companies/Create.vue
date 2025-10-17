<script>
import DefaultLayout from "@/Layouts/DefaultLayout.vue";
import {Link} from "@inertiajs/vue3";

export default {
    name: "Create",
    components: {Link, DefaultLayout},

    data() {
        return {
            name: '',
            phone: '',
            address: '',
            source: '',
            status: 'cold',
            worktime: '',
            description: '',
            etc: ''
        }
    },

    methods: {
        store() {
            this.$inertia.post('/companies', {name: this.name, phone: this.phone, address: this.address, source: this.source, status: this.status, worktime: this.worktime, description: this.description, etc: this.etc})
        }
    },

    computed: {
        pageErrors() {
            return this.$page.props.errors
        }
    }
}
</script>

<template>
    <DefaultLayout/>

    <main class="w-4/5 mx-auto text-p-text  mt-10">
        <Link :href="route('companies.index')">Назад </Link>
    <div class="flex  justify-center items-center">
    <form @submit.prevent="store">
        <h1 class="mb-8 text-center text-xl" >Добавление компании</h1>

        <div class="mb-4">
            <input v-model="name" type="text" class="w-[200px] bg-s-bg  rounded-xl active:bg-t-bg focus:bg-t-bg border border-border-default" placeholder="Название">
            <div v-if="pageErrors.name" class="text-danger text-sm pl-1">{{ pageErrors.name }}</div>
        </div>
        <div class="mb-4">
            <input v-model="phone" type="text" class="w-[200px] bg-s-bg  rounded-xl active:bg-t-bg focus:bg-t-bg border border-border-default" placeholder="Номер телефона">
            <div v-if="pageErrors.phone" class="text-danger text-sm pl-1">{{ pageErrors.phone }}</div>
        </div>
        <div class="mb-4">
            <input v-model="address" type="text" class="w-[200px] bg-s-bg  rounded-xl active:bg-t-bg focus:bg-t-bg border border-border-default" placeholder="Адрес">
            <div v-if="pageErrors.address" class="text-danger text-sm pl-1">{{ pageErrors.address }}</div>
        </div>
        <div class="mb-4">
            <input v-model="source" type="text" class="w-[200px] bg-s-bg  rounded-xl active:bg-t-bg focus:bg-t-bg border border-border-default" placeholder="Источник">
            <div v-if="pageErrors.source" class="text-danger text-sm pl-1">{{ pageErrors.source }}</div>
        </div>
        <div class="mb-4">
            <select v-model="status" class="w-[300px] bg-s-bg  rounded-xl active:bg-t-bg focus:bg-t-bg border border-border-default">
                <option value="cold">Холодный</option>
                <option value="warm">Теплый</option>
                <option value="later">Перезвонить</option>
                <option value="yes">Согласен</option>
                <option value="no">Отказ</option>
                <option value="success">Закончен</option>
                <option value="inwork">В работе</option>
            </select>
            <div v-if="pageErrors.status" class="text-danger text-sm pl-1">{{ pageErrors.status }}</div>
        </div>
        <div class="mb-4">
            <input v-model="worktime" type="text" class="w-[200px] bg-s-bg  rounded-xl active:bg-t-bg focus:bg-t-bg border border-border-default" placeholder="Рабочее время">
            <div v-if="pageErrors.worktime" class="text-danger text-sm pl-1">{{ pageErrors.worktime }}</div>
        </div>
        <div class="mb-4">
            <textarea v-model="description" type="text" class="w-[300px] bg-s-bg  rounded-xl active:bg-t-bg focus:bg-t-bg border border-border-default" placeholder="Описание"></textarea>
            <div v-if="pageErrors.description" class="text-danger text-sm pl-1">{{ pageErrors.description }}</div>
        </div>
        <div class="mb-4">
            <textarea v-model="etc" type="text" class="w-[300px] bg-s-bg  rounded-xl active:bg-t-bg focus:bg-t-bg border border-border-default" placeholder="Доп. инфо (не обязательно)"></textarea>
            <div v-if="pageErrors.etc" class="text-danger text-sm pl-1">{{ pageErrors.etc }}</div>
        </div>
        <div>
            <button type="submit" class="hover:bg-t-bg border-border-default border bg-p-bg rounded-full text-center block p-2 w-32 mx-auto">Создать</button>
        </div>
    </form>
    </div>
    </main>
</template>

<style scoped>
    input {
        width: 300px;
        margin: auto;
    }
</style>
