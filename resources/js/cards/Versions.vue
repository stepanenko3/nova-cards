<template>
    <NovaCardsCard
        :heading="card.title || __('System Versions')"
        :showPolling="card?.polling || false"
        :showRefresh="card?.refresh || true"
        :loading="loading"
        :polling="polling"
        :pollingInterval="10000"
        @update:polling="polling = $event"
        @refresh="refresh"
    >
        <table v-if="response" class="w-full text-left table-collapse">
            <tbody class="align-baseline">
                <tr>
                    <td class="py-2 pr-2 font-bold">
                        {{ __("OS") }}
                    </td>
                    <td class="p-2">
                        {{ response.os || "-" }}
                    </td>
                </tr>
                <tr>
                    <td class="py-2 pr-2 font-bold">
                        {{ __("PHP") }}
                    </td>
                    <td class="p-2">
                        {{ response.php || "-" }}
                    </td>
                </tr>
                <tr>
                    <td class="py-2 pr-2 font-bold">
                        {{ __("Database") }}
                    </td>
                    <td class="p-2">
                        {{ response.database || "-" }}
                    </td>
                </tr>
                <tr>
                    <td class="py-2 pr-2 font-bold">
                        {{ __("Laravel") }}
                    </td>
                    <td class="p-2">
                        {{ response.laravel || "-" }}
                    </td>
                </tr>
                <tr>
                    <td class="py-2 pr-2 font-bold">
                        {{ __("Nova") }}
                    </td>
                    <td class="p-2">
                        {{ response.nova || "-" }}
                    </td>
                </tr>
            </tbody>
        </table>
    </NovaCardsCard>
</template>

<script setup lang="ts">
import { ref, defineProps } from "vue";

const props = defineProps<{
    card: {
        title: string;
        polling?: boolean;
        refresh?: boolean;
    };
}>();

const loading = ref<boolean>(false);
const polling = ref<boolean>(false);
const response = ref<any>();

async function refresh() {
    loading.value = true;

    await fetch("/nova-vendor/stepanenko3/nova-cards/versions")
        .then((res) => res.json())
        .then((data) => {
            response.value = data;
        })
        .catch((error) => {
            console.error("Error fetching weather:", error);
        });

    loading.value = false;
}
</script>
