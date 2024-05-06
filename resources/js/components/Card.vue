<template>
    <div
        class="nova-cards relative overflow-hidden bg-white dark:bg-gray-800 rounded-lg shadow isolate px-6 py-4 md:col-span-4 min-h-40 h-full"
    >
        <div
            v-if="heading"
            class="flex items-center justify-between mb-2 font-bold"
        >
            <span :class="headingClass" class="word-wrap: break-word">
                {{ heading }}
            </span>

            <div
                v-if="showRefresh || showPolling"
                class="md:ml-2 inline-flex items-center shadow rounded-lg bg-white dark:bg-gray-800 px-2 h-8"
            >
                <NovaCardsToolbarButton
                    v-if="showRefresh"
                    type="refresh"
                    v-tooltip="__('Refresh')"
                    :loading="loading"
                    @click.prevent="handleRefresh"
                />

                <NovaCardsToolbarButton
                    v-if="showPolling"
                    type="clock"
                    @click.prevent="emit('update:polling', !polling)"
                    v-tooltip="__(polling ? 'Stop polling' : 'Start polling')"
                    :class="{
                        'text-green-500': polling,
                        'text-gray-500': !polling,
                    }"
                    class="w-8 h-8"
                />
            </div>
        </div>

        <div class="card-overflow">
            <slot />
        </div>
    </div>
</template>

<script setup lang="ts">
import { ref, watch, onMounted, onUnmounted } from "vue";
import { useLocalization } from "LaravelNova";

const props = withDefaults(
    defineProps<{
        heading?: string;
        headingClass?: string;
        showRefresh?: boolean;
        showPolling?: boolean;
        loading?: boolean;
        polling?: boolean;
        pollingInterval?: number;
    }>(),
    {
        heading: "",
        headingClass: "",
        showRefresh: false,
        showPolling: false,
        loading: false,
        polling: false,
        pollingInterval: 3000,
    }
);

const { __ } = useLocalization();
const intervalId = ref<any>(0);

const emit = defineEmits<{
    (e: "refresh"): void;
    (e: "update:polling", value: boolean): void;
}>();

function resetPolling() {
    stopPolling();

    if (props.polling) {
        startPolling();
    }
}

function startPolling() {
    intervalId.value = setInterval(async () => {
        await emit("refresh");
    }, props.pollingInterval);
}

function stopPolling() {
    if (intervalId.value) {
        clearInterval(intervalId.value);

        intervalId.value = 0;
    }
}

watch(
    () => props.polling,
    (newPolling) => {
        if (newPolling) {
            resetPolling();
        } else {
            stopPolling();
        }
    },
    { immediate: true }
);

async function handleRefresh() {
    await emit("refresh");

    resetPolling();
}

onMounted(async () => {
    if (props.showPolling || props.polling) {
        await emit("refresh");
    }

    if (props.polling) {
        startPolling();
    }
});

onUnmounted(() => {
    stopPolling();
});
</script>
