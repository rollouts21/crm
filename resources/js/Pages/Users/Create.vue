<script>
export default {
    name: "Create",

    data() {
        return {
            name: '',
            email: '',
            password: '',
            role: ''
        }
    },

    props: [
        'roles'
    ],

    methods: {
        store() {
            this.$inertia.post('/users', {name: this.name, email: this.email, password: this.password, role: this.role})
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
    <form @submit.prevent="store">
        <div class="mb-4">
            <input v-model="name" class="w-full rounded-full border border-gray-400" type="text" placeholder="name">
            <div v-if="pageErrors.name" class="text-red-600 text-sm">{{ pageErrors.name }}</div>
        </div>
        <div class="mb-4">
            <input v-model="email" class="w-full rounded-full border border-gray-400" placeholder="email"></input>
            <div v-if="pageErrors.email" class="text-red-600 text-sm">{{ pageErrors.email }}</div>
        </div>
        <div class="mb-4">
            <input v-model="password" class="w-full rounded-full border border-gray-400" placeholder="password"></input>
            <div v-if="pageErrors.password" class="text-red-600 text-sm">{{ pageErrors.password }}</div>
        </div>
        <div class="mb-4">
            <select v-model="role" >
                <option v-for="ro in roles" :value="ro">{{ro}}</option>
            </select>
            <div v-if="pageErrors.role" class="text-red-600 text-sm">{{ pageErrors.role }}</div>
        </div>
        <div>
            <button type="submit"
                    class="ml-auto hover:bg-white hover:text-sky-500 border-sky-500 border bg-sky-500 rounded-full text-center text-white block p-2 w-32">
                Store
            </button>
        </div>
    </form>
</template>

<style scoped>

</style>
