<script>
import Header from "@/Components/Header.vue";
import SideBar from "@/Components/SideBar.vue";

export default {
    name: "DefaultLayout",
    components: {SideBar, Header}
}
</script>

<template>
<Header/>
    <SideBar/>
</template>

<style scoped>

</style>
