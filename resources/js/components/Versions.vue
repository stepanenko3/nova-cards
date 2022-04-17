<template>
    <LoadingCardWithButton
        heading="System Versions"
        :loading="loading"
        @refresh="fetch"
    >
        <table v-if="data" class="w-full text-left table-collapse">
            <tbody class="align-baseline">
                <tr>
                    <td class="py-2 pr-2 font-bold">OS</td>
                    <td class="p-2">{{ data.os || '-' }}</td>
                </tr>
                <tr>
                    <td class="py-2 pr-2 font-bold">PHP</td>
                    <td class="p-2">{{ data.php || '-' }}</td>
                </tr>
                <tr>
                    <td class="py-2 pr-2 font-bold">Database</td>
                    <td class="p-2">{{ data.database || '-' }}</td>
                </tr>
                <tr>
                    <td class="py-2 pr-2 font-bold">Laravel</td>
                    <td class="p-2">{{ data.laravel || '-' }}</td>
                </tr>
                <tr>
                    <td class="py-2 pr-2 font-bold">Nova</td>
                    <td class="p-2">{{ data.nova || '-' }}</td>
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
            data: {},
            endpoint: '/nova-vendor/stepanenko3/nova-cards/versions',
        }),

        methods: {
            success: function(data) {
                this.data = data
            }
        }
    }
</script>
