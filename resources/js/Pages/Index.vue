<script>
import DefaultLayout from "@/Layouts/DefaultLayout.vue";
import {defineComponent} from "vue";

export default defineComponent({
    components: {DefaultLayout},

    props: [
        'callCompaniesCount'
    ]
})


</script>

<template>
    <DefaultLayout/>
    <main class="w-4/5 mx-auto">
        Всего продаж {{callCompaniesCount}}
    </main>
</template>

<style scoped>

</style>
