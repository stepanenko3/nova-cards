<template>
    <NovaCardsCard
        :heading="card.title || __('Server Metrics')"
        :showPolling="card?.polling || false"
        :showRefresh="card?.refresh || true"
        :loading="loading"
        :polling="polling"
        :pollingInterval="10000"
        @update:polling="polling = $event"
        @refresh="refresh"
    >
        <table
            v-if="response && response.disk_space"
            class="w-full text-left table-collapse"
        >
            <tbody class="align-baseline">
                <tr>
                    <td class="py-2 pr-2 font-bold">
                        {{ __("Disk Space") }}
                    </td>
                    <td class="p-2">
                        {{ response.disk_space.use_percentage }}%
                        {{ __("Used") }} (
                        {{ response.disk_space.used.memory }}
                        <span class="text-xs">
                            {{ response.disk_space.used.unit.toLowerCase() }}
                        </span>
                        /
                        {{ response.disk_space.total.memory }}
                        <span class="text-xs">
                            {{ response.disk_space.total.unit.toLowerCase() }}
                        </span>
                        )
                    </td>
                </tr>
                <tr v-if="response.memory_usage">
                    <td class="py-2 pr-2 font-bold">
                        {{ __("Memory Usage") }}
                    </td>
                    <td class="p-2">
                        {{ response.memory_usage.use_percentage }}%
                        {{ __("Used") }} (
                        {{ response.memory_usage.used.memory }}

                        <span class="text-xs">
                            {{ response.memory_usage.used.unit.toLowerCase() }}
                        </span>
                        / {{ response.memory_usage.total.memory }}
                        <span class="text-xs">
                            {{ response.memory_usage.total.unit.toLowerCase() }}
                        </span>
                        )
                    </td>
                </tr>
                <tr>
                    <td class="py-2 pr-2 font-bold">
                        {{ __("CPU Usage") }}
                    </td>
                    <td class="p-2">
                        {{ response.cpu_usage.use_percentage }}%
                        {{ __("Used") }}
                        <br />
                        <span class="text-xs">
                            {{ response.cpu_usage.name }}
                        </span>
                    </td>
                </tr>
            </tbody>
        </table>
        <div v-else>
            {{ __("No Data") }}
        </div>
    </NovaCardsCard>
</template>

<script setup lang="ts">
import { ref, defineProps } from "vue";
import { useLocalization } from "LaravelNova";

defineProps<{
    card: {
        title: string;
        polling?: boolean;
        refresh?: boolean;
    };
}>();

const { __ } = useLocalization();

const loading = ref<boolean>(false);
const polling = ref<boolean>(true);
const response = ref<any>();

async function refresh() {
    loading.value = true;

    await fetch("/nova-vendor/stepanenko3/nova-cards/system-resources")
        .then((res) => res.json())
        .then((data) => {
            response.value = data;
        })
        .catch((error) => {
            console.error(error);
        })
        .finally(() => {
            loading.value = false;
        });
}
</script>
