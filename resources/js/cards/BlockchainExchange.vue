<template>
    <LoadingCardWithButton
        :heading="card.title || 'Blockchain Exchange Rates'"
        :loading="loading"
        @refresh="fetch"
    >
        <table v-if="data" class="w-full text-left table-collapse">
            <thead class="bg-white dark:bg-gray-800 sticky-table-header">
                <tr>
                    <th class="p-2 font-bold"></th>
                    <th class="p-2 font-bold">Buy</th>
                    <th class="p-2 font-bold">Sell</th>
                </tr>
            </thead>
            <tbody class="align-baseline">
                <tr v-for="(item, index) in data">
                    <td class="py-2 pr-2 font-bold">
                        {{ index }}
                    </td>
                    <td class="p-2">
                        {{ formatPrice(item.buy) }}
                    </td>
                    <td class="p-2">
                        {{ formatPrice(item.sell) }}
                    </td>
                </tr>
            </tbody>
        </table>
        <div v-else>
            {{ __('No Data') }}
        </div>

        <div class="py-3 text-xs text-80">
            Via <a href="https://blockchain.info/ticker">Blockchain.com</a>
        </div>
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
            data: {},
        }),

        methods: {
            endpoint() {
                return Nova.request().get('/nova-vendor/stepanenko3/nova-cards/blockchain-exchange');
            },

            success(data) {
                this.data = data
            },

            formatPrice(value) {
                let val = (value/1).toFixed(2).replace('.', ',')
                return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
            },
        },
    }
</script>

<style>
    .sticky-table-header {
        position: sticky;
        top: 0;
    }
</style>
