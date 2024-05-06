<template>
    <NovaCardsCard
        :heading="card.title || __('Scheduled Jobs')"
        :showPolling="card?.polling || false"
        :showRefresh="card?.refresh || true"
        :loading="loading"
        :polling="polling"
        :pollingInterval="10000"
        @update:polling="polling = $event"
        @refresh="refresh"
    >
        <p v-if="!response.length">
            {{ __(loading ? "Loading..." : "No Data") }}
        </p>

        <table v-if="response.length" class="w-full text-left table-collapse">
            <tbody class="align-baseline">
                <tr v-for="(item, index) in response" :item="item">
                    <td class="py-2 pr-2 font-bold" style="word-wrap: anywhere">
                        {{ item.command }}
                    </td>
                    <td class="p-2">
                        {{ item.expression }}
                    </td>
                    <td class="p-2">
                        {{ item.humanReadableNextRun }}
                    </td>
                </tr>
            </tbody>
        </table>
    </NovaCardsCard>
</template>

<script setup lang="ts">
import { ref, defineProps } from "vue";
import { useLocalization } from "LaravelNova";

const props = defineProps<{
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

    await fetch("/nova-vendor/stepanenko3/nova-cards/scheduled-jobs")
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
