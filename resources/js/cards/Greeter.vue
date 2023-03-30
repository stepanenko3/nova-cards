<template>
    <Card class="h-auto flex items-center p-4">
        <div class="flex items-center justify-between flex-grow">
            <div class="flex items-center space-x-4">
                <div v-if="card.avatar" class="flex-shrink-0">
                    <img
                        class="mx-auto h-20 w-20 rounded-full"
                        :src="card.avatar_url"
                        :alt="card.user_name"
                    />
                </div>
                <div v-else class="flex-shrink-0 text-3xl h-20 w-20 rounded-full bg-primary-500 tracking-wide text-white flex items-center justify-center">
                    {{  getInitials(card.user_name) }}

                </div>
                <div class="text-left">
                    <p
                        class="text-sm font-medium text-gray-600 dark:text-gray-400"
                    >
                        {{ card.message ?? __("Welcome back,") }}
                    </p>
                    <p
                        class="font-bold text-xl"
                    >
                        {{ card.user_name }}
                    </p>
                    <p
                        v-if="card.user_title"
                        class="text-sm font-medium text-gray-600 dark:text-gray-400"
                    >
                        {{ card.user_title }}
                    </p>
                    <dl
                        v-if="card.verified"
                        class="mt-6 flex flex-col mt-1 flex-row flex-wrap"
                    >
                        <dt class="sr-only">
                            {{ card.verified_text ?? __("Verified Account") }}
                        </dt>
                        <dd
                            class="mt-3 flex justify-center text-sm text-gray-500 dark:text-gray-300 font-medium mr-6 mt-1 capitalize"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke-width="1.5"
                                stroke="currentColor"
                                class="flex-shrink-0 mr-1.5 h-5 w-5 text-green-400 dark:text-green-500"
                                aria-hidden="true"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"
                                />
                            </svg>
                            {{ card.verified_text ?? __("Verified Account") }}
                        </dd>
                    </dl>
                </div>
            </div>
            <div v-if="card.buttons.length > 0" class="space-y-4 flex flex-col">
                <OutlineButtonInertiaLink
                    v-for="button in card.buttons"
                    :href="button.target"
                >
                    {{ button.name }}
                </OutlineButtonInertiaLink>
            </div>
        </div>

        <div
            v-if="card.stats"
            class="border-t border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800/25 grid grid-cols-1 divide-y divide-gray-200 dark:divide-gray-700 grid-cols-3 divide-y-0 divide-x"
        >
            <div
                v-for="stat in card.stats"
                :key="stat.label"
                class="px-6 py-3 text-sm font-medium text-center"
            >
                <span class="text-gray-900 dark:text-gray-300">{{
                    stat.value
                }}</span>
                {{ " " }}
                <span class="text-gray-600 dark:text-gray-400">{{
                    stat.label
                }}</span>
            </div>
        </div>
    </Card>
</template>

<script setup>
import { onMounted, onBeforeUnmount, ref } from "vue";
import { useLocalization } from "laravel-nova";

const { __ } = useLocalization();

defineProps({
    card: Object,
});

const observer = ref(null);
const dark = ref(false);

onMounted(() => {
    dark.value = document.documentElement.classList.contains("dark");

    observer.value = new MutationObserver((records) => {
        records.forEach((record) => {
            dark.value = record.target.classList.contains("dark");
        });
    });

    observer.value.observe(document.documentElement, {
        attributes: true,
        attributeFilter: ["class"],
        childList: false,
        characterData: false,
    });
});

onBeforeUnmount(() => {
    observer.value.disconnect();
    observer.value = null;
});

function getInitials(name) {
    return name.match(/(\b\S)?/g).join("").match(/(^\S|\S$)?/g).join("").toUpperCase();
}
</script>

<style>
.w-20 {
    width: 80px;
}

.h-20 {
    height: 80px;
}
</style>
