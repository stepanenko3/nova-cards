<template>
    <LoadingCardWithButton
        :heading="card.title || __('Scheduled Jobs')"
        :loading="loading"
        @refresh="fetch"
    >
        <p v-if="!loading && !data.length">
            {{ __('No Data') }}
        </p>

        <table v-if="data.length" class="w-full text-left table-collapse">
            <tbody class="align-baseline">
                <tr v-for="(item, index) in data" :item="item">
                    <td class="py-2 pr-2 font-bold">
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
    </LoadingCardWithButton>
</template>

<script>
    import Polling from '../mixins/Polling.js'

    export default {
        props: {
            card: {
                type: Object,
                required: true,
            },
        },

        mixins: [Polling],

        data: () => ({
            data: [],
        }),

        methods: {
            endpoint() {
                return Nova.request().get('/nova-vendor/stepanenko3/nova-cards/scheduled-jobs');
            },

            success(data) {
                this.data = data
            },
        },
    }
</script>
