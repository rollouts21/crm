<script>
export default {
    name: "Header"
}
</script>

<template>
    <header class="flex w-4/5 mx-auto mt-6 justify-between">
        <div class="main">
            <a href="#">AKXMAI CRM</a>
        </div>

        <div class="menu">
            <nav>
                <ul class="flex">
                    <li><a href="#">Базы</a></li>
                    <li><a href="#">Личный кабинет</a></li>
                    <li></li>
                </ul>
            </nav>
        </div>
    </header>
</template>

<style scoped>
    li {
        padding-left: 10px;
    }

    a {
        transition: color .3s ease-in;
    }

    a:hover {
        color: var(--text-link)
    }
</style>
