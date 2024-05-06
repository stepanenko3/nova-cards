<template>
    <NovaCardsCard
        :heading="
            card.domain +
            ' - ' +
            __(response?.is_valid ? 'Valid Certificate' : 'Invalid Certificate')
        "
        :headingClass="{
            'text-green-500': response?.is_valid,
            'text-red-500': !response?.is_valid,
        }"
        :showPolling="card?.polling || false"
        :showRefresh="card?.refresh || true"
        :loading="loading"
        :polling="polling"
        :pollingInterval="10000"
        @update:polling="polling = $event"
        @refresh="refresh"
    >
        <div v-if="!response && loading">
            {{  __('Loading...') }}
        </div>
        <table v-else-if="response && !errorMessage" class="w-full text-left table-collapse">
            <tbody class="align-baseline">
                <tr>
                    <td class="py-2 pr-2 font-bold">
                        {{ __('Issuer') }}
                    </td>
                    <td class="p-2">
                        {{ response.issuer }}
                    </td>
                </tr>
                <tr>
                    <td class="py-2 pr-2 font-bold">
                        {{ __('Expiration') }}
                    </td>
                    <td class="p-2">
                        {{ response.expiration_date }}
                        (
                        <strong class="italic">
                            {{ parseInt(response.expiration_date_in_days) }} days
                        </strong>
                        )
                    </td>
                </tr>
            </tbody>
        </table>

        <div v-else>
            {{ errorMessage || '' }}
        </div>
    </NovaCardsCard>
</template>

<script setup lang="ts">
import { ref, defineProps } from "vue";
import { useLocalization } from "LaravelNova";

const props = defineProps<{
    card: {
        domain: string;
        polling?: boolean;
        refresh?: boolean;
    };
}>();

const { __ } = useLocalization();

const loading = ref<boolean>(false);
const polling = ref<boolean>(false);
const response = ref<any>();
const errorMessage = ref<string | null>(null);

async function refresh() {
    loading.value = true;

    await fetch(
        "/nova-vendor/stepanenko3/nova-cards/ssl?domain=" + props.card.domain
    )
        .then((res) => res.json())
        .then((data) => {
            response.value = data;
        })
        .catch((error) => {
            errorMessage.value = error;
        });

    loading.value = false;
}
</script>
