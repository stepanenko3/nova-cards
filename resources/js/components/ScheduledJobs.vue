<template>
    <LoadingCardWithButton
        :heading="__('Scheduled Jobs')"
        :loading="loading"
        @refresh="fetch"
    >
        <p v-if="!loading && !data.length">
            {{ __('No Data') }}
        </p>

        <table v-if="data.length" class="w-full text-left table-collapse">
            <tr v-for="(item, index) in data" :item="item">
                <td>{{ item.command }}</td>
                <td>{{ item.expression }}</td>
                <td>{{ item.humanReadableNextRun }}</td>
            </tr>
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
            endpoint: '/nova-vendor/stepanenko3/nova-cards/scheduled-jobs',
        }),

        methods: {
            success: function(data) {
                this.data = data
            }
        },
    }
</script>
