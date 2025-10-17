<script>
import {Link, router} from "@inertiajs/vue3";
import DefaultLayout from "@/Layouts/DefaultLayout.vue";

export default {
    name: "Index",
    components: {DefaultLayout, Link},
    props: {
        companies: {
            type: Array,
            default: () => [],
        },
        filters: {
            type: Object,
            default: () => ({}),
        },
    },
    data() {
        return {
            statuses: [
                {value: 'cold', name: 'Холодный'},
                {value: 'warm', name: 'Теплый'},
                {value: 'later', name: 'Перезвонить'},
                {value: 'yes', name: 'Согласен'},
                {value: 'no', name: 'Отказ'},
                {value: 'success', name: 'Закончен'},
                {value: 'inwork', name: 'В работе'},
            ],
            editableData: {},
            originalData: {},
            savingStates: {},
            searchTerm: '',
            selectedStatus: '',
        };
    },
    watch: {
        companies: {
            handler(newCompanies) {
                this.initializeEditableData(newCompanies);
            },
            immediate: true,
        },
        filters: {
            handler(newFilters) {
                this.searchTerm = newFilters?.search ?? '';
                this.selectedStatus = newFilters?.status ?? '';
            },
            deep: true,
            immediate: true,
        },
    },
    methods: {
        getStatusColorClass(statusCode) {
            // Если статус не определен, возвращаем класс по умолчанию
            if (!statusCode) return 'bg-gray-700 text-white';

            switch (statusCode) {
                case 'cold':
                    return 'bg-info '; // Синий для "Холодный"
                case 'warm':
                    return 'bg-t-bg '; // Оранжевый для "Теплый"
                case 'later':
                    return 'bg-warning'; // Желтый для "Перезвонить"
                case 'yes':
                    return 'bg-brand'; // Зеленый для "Согласен"
                case 'no': // Внимание: если вы используете 'No', лучше изменить его на 'no'
                    return 'bg-danger'; // Красный для "Отказ"
                case 'success':
                    return 'bg-success'; // Светло-зеленый для "Закончен"
                case 'inwork':
                    return 'bg-success'; // Фиолетовый для "В работе"
                default:
                    return 'bg-gray-700 text-white';
            }
        },
        initializeEditableData(companies) {
            const editable = {};
            const original = {};

            (companies || []).forEach(company => {
                const base = {
                    status: company.status ?? '',
                    description: company.description ?? '',
                    etc: company.etc ?? '',
                };
                editable[company.id] = {...base};
                original[company.id] = {...base};
            });

            this.editableData = editable;
            this.originalData = original;
        },
        hasChanges(companyId) {
            const edited = this.editableData[companyId];
            const original = this.originalData[companyId];

            if (!edited || !original) {
                return false;
            }

            return (
                edited.status !== original.status ||
                (edited.description ?? '') !== (original.description ?? '') ||
                (edited.etc ?? '') !== (original.etc ?? '')
            );
        },
        applyFilters() {
            router.get(route('companies.index'), {
                search: this.searchTerm || undefined,
                status: this.selectedStatus || undefined,
            }, {
                preserveState: true,
                preserveScroll: true,
                replace: true,
            });
        },
        clearFilters() {
            this.searchTerm = '';
            this.selectedStatus = '';
            this.applyFilters();
        },
        saveChanges(companyId) {
            if (!this.hasChanges(companyId) || this.savingStates[companyId]) {
                return;
            }

            const dataToSave = this.editableData[companyId];

            if (!dataToSave) {
                return;
            }

            this.savingStates = {...this.savingStates, [companyId]: true};

            router.patch(route('companies.update', companyId), dataToSave, {
                preserveState: true,
                preserveScroll: true,
                only: ['companies', 'filters'],
                onSuccess: () => {
                    this.originalData = {
                        ...this.originalData,
                        [companyId]: {...dataToSave},
                    };
                },
                onFinish: () => {
                    this.savingStates = {...this.savingStates, [companyId]: false};
                },
            });
        },
    },
};
</script>

<template>
    <DefaultLayout/>
    <main class="mt-20 w-4/5 mx-auto transition-all duration-300 ease-in-out">
        <section class="flex flex-col gap-6">
            <div class="flex flex-wrap justify-between gap-4 items-center">
                <Link
                    :href="route('companies.create')"
                    class="border border-default px-4 py-2 bg-s-bg hover:bg-t-bg transition-colors text-s-text rounded-full"
                >
                    Создать компанию
                </Link>
                <div class="flex flex-wrap gap-3 items-center">
                    <input
                        v-model="searchTerm"
                        type="text"
                        placeholder="Поиск по любой информации"
                        class="bg-t-bg rounded-xl border border-t-bg px-3 w-[235px] py-2 text-sm focus:ring-1 focus:ring-border-default focus:border-border-default"
                    />
                    <select
                        v-model="selectedStatus"
                        class="bg-t-bg rounded-xl border border-t-bg px-3 py-2 w-[150px] text-sm focus:ring-1 focus:ring-border-default focus:border-border-default"
                    >
                        <option value="">Все статусы</option>
                        <option
                            v-for="status in statuses"
                            :key="status.value"
                            :value="status.value"
                        >
                            {{ status.name }}
                        </option>
                    </select>
                    <button
                        @click="applyFilters"
                        class="px-4 py-2 bg-s-bg  rounded-lg hover:bg-t-bg transition-colors"
                    >
                        Применить
                    </button>
                    <button
                        @click="clearFilters"
                        class="px-4 py-2 bg-danger  rounded-lg"
                    >
                        Сбросить
                    </button>
                </div>
            </div>

            <div v-if="companies.length" class="grid gap-5 md:grid-cols-2 xl:grid-cols-3">
                <article
                    v-for="company in companies"
                    :key="company.id"
                    class="bg-s-bg rounded-3xl p-4 shadow-sm border border-border-default"
                >
                    <template v-if="editableData[company.id]">
                        <header class="mb-3">
                            <h3 class="text-xl font-semibold">{{ company.name }}</h3>
                            <p class="text-sm text-gray-500">ID: {{ company.id }}</p>
                        </header>

                        <div class="space-y-2 text-sm">
                            <p><span class="font-medium">Телефон:</span> {{ company.phone }}</p>
                            <p><span class="font-medium">Адрес:</span> {{ company.address }}</p>
                            <p><span class="font-medium">Источник:</span> {{ company.source }}</p>
                            <p><span class="font-medium">Рабочее время:</span> {{ company.worktime }}</p>
                        </div>

                        <div class="mt-4 space-y-3 text-sm">
                            <label class="flex flex-col gap-1">
                                <span class="font-medium">Статус:</span>
                                <select
                                    :class="getStatusColorClass(editableData[company.id].status)"
                                    v-model="editableData[company.id].status"
                                    class="bg-t-bg rounded-xl border border-t-bg px-3 py-2 focus:ring-1 focus:ring-border-default focus:border-border-default"
                                >
                                    <option
                                        v-for="status in statuses"
                                        :key="status.value"
                                        :value="status.value"
                                    >
                                        {{ status.name }}
                                    </option>
                                </select>
                            </label>

                            <label class="flex flex-col gap-1">
                                <span class="font-medium">Описание:</span>
                                <textarea
                                    v-model="editableData[company.id].description"
                                    rows="3"
                                    class="bg-t-bg rounded-xl border border-t-bg px-3 py-2 focus:ring-1 focus:ring-border-default focus:border-border-default resize-y min-h-[80px]"
                                ></textarea>
                            </label>

                            <label class="flex flex-col gap-1">
                                <span class="font-medium">Доп. информация:</span>
                                <textarea
                                    v-model="editableData[company.id].etc"
                                    rows="3"
                                    class="bg-t-bg rounded-xl border border-t-bg px-3 py-2 focus:ring-1 focus:ring-border-default focus:border-border-default resize-y min-h-[80px]"
                                ></textarea>
                            </label>
                        </div>

                        <footer class="mt-4 flex justify-end">
                            <button
                                @click="saveChanges(company.id)"
                                :disabled="!hasChanges(company.id) || savingStates[company.id]"
                                class="px-4 py-2 rounded-lg text-white transition-colors"
                                :class="[
                                    (!hasChanges(company.id) || savingStates[company.id])
                                        ? 'bg-s-text cursor-not-allowed'
                                        : 'bg-s-bg hover:bg-t-bg'
                                ]"
                            >
                                {{ savingStates[company.id] ? 'Сохраняю...' : 'Сохранить' }}
                            </button>
                        </footer>
                    </template>
                </article>
            </div>

            <div v-else class="text-center text-sm text-gray-500 mt-10">
                По заданным условиям ничего не найдено.
            </div>
        </section>
    </main>
</template>

<style scoped>
</style>
