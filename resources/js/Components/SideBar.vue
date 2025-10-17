<script setup>
import { ref, computed } from 'vue';
import {Link} from "@inertiajs/vue3";

// --- Константы ширины в пикселях ---
// Используются для точного расчета отступа (padding-left) для элемента <main>
const CLOSED_WIDTH_PX = 60;
const OPENED_WIDTH_PX = 240;
// ------------------------------------


// Состояние: открыта ли панель
const isExpanded = ref(false);

const toggleSidebar = () => {
    isExpanded.value = !isExpanded.value;
};

// 1. Вычисляемое свойство для ширины (для Tailwind-классов на <aside>)
const sidebarWidthClass = computed(() => {
    // Закрыто: 60px. Открыто: 15% или минимум 240px.
    return isExpanded.value
        ? 'w-[15%] min-w-[240px]'
        : `w-[${CLOSED_WIDTH_PX}px]`;
});

// 2. Вычисляемое свойство для отступа (для сдвига <main>)
const mainPaddingStyle = computed(() => {
    // Используем пиксельные значения, которые совпадают с минимальной/закрытой шириной панели
    const width = isExpanded.value ? OPENED_WIDTH_PX : CLOSED_WIDTH_PX;

    return {
        'padding-left': `${width}px`
    };
});
</script>

<template>
    <div class="flex overflow-hidden bg-p-bg">

        <aside
            :class="sidebarWidthClass"
            class="bg-s-bg text-p-text transition-all duration-300 ease-in-out flex flex-col shadow-xl z-50 fixed h-full left-0 top-0 border-r border-border-default"
        >
            <div class="p-4 flex items-center h-[60px] border-b border-border-default flex-shrink-0">
                <button
                    @click="toggleSidebar"
                    class="p-2 rounded focus:outline-none focus:ring-2 focus:ring-brand hover:bg-bg-tertiary"
                    :aria-expanded="isExpanded"
                    aria-controls="sidebar-menu"
                >
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
                    </svg>
                </button>

                <h1 v-show="isExpanded" class="ml-3 text-xl font-semibold whitespace-nowrap overflow-hidden text-brand">
                    AKXMAI CRM
                </h1>
            </div>

            <nav id="sidebar-menu" class="flex-grow overflow-y-auto mt-2">

                <Link href="/" class="flex items-center p-3 mx-2 rounded hover:bg-bg-tertiary group">
<!--                    <i class="fa-solid fa-house w-6 h-6 flex-shrink-0 text-s-text group-hover:text-brand transition-colors"></i>-->
                    <i
                        class="fa-solid fa-house w-6 h-6 flex-shrink-0 transition-colors"
                        :class="$page.url === '/' ? 'text-brand' : 'text-s-text group-hover:text-brand'"
                    ></i>
                    <span v-show="isExpanded" class="ml-4 whitespace-nowrap text-p-text">Главная</span>
                </Link>

                <Link :href="route('companies.index')" class="flex items-center p-3 mx-2 rounded hover:bg-bg-tertiary group">
<!--                    <i class="fa-solid fa-database w-6 h-6 flex-shrink-0 text-s-text group-hover:text-brand transition-colors"></i>-->
                    <i
                        class="fa-solid fa-database w-6 h-6 flex-shrink-0 transition-colors"
                        :class="$page.url.startsWith('/companies') ? 'text-brand' : 'text-s-text group-hover:text-brand'"
                    ></i>
                    <span v-show="isExpanded" class="ml-4 whitespace-nowrap text-p-text">Базы</span>
                </Link>

                <Link href="/users" class="flex items-center p-3 mx-2 rounded hover:bg-bg-tertiary group">
                    <i class="fa-solid fa-list-check w-6 h-6 flex-shrink-0 text-s-text group-hover:text-brand transition-colors"></i>
                    <span v-show="isExpanded" class="ml-4 whitespace-nowrap text-p-text">Задачи</span>
                </Link>
            </nav>

            <div class="p-4 flex-shrink-0 border-t border-border-default">
                <Link href="/settings" class="flex items-center p-1 mx-1 rounded hover:bg-bg-tertiary group">
                    <i class="fa-regular fa-circle-user w-6 h-6 flex-shrink-0 text-s-text group-hover:text-brand transition-colors"></i>
                    <span v-show="isExpanded" class="ml-4 whitespace-nowrap text-p-text">Личный кабинет</span>
                </Link>
            </div>
        </aside>


    </div>
</template>

<style scoped>
/* Убираем небольшой отступ сверху, который мог появиться из-за специфики Icon Fonts */
i {
    margin-top: 6px;
}
/* Если нужно дополнительное выравнивание, используйте классы Tailwind: items-center на родительском <a> */
</style>
