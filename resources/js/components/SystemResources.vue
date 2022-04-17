<template>
    <LoadingCardWithButton
        heading="Server Metrics"
        :loading="loading"
        @refresh="fetch"
    >
        <table v-if="data && data.disk_space" class="w-full text-left table-collapse">
            <tbody class="align-baseline">
                <tr>
                    <td class="py-2 pr-2 font-bold">Disk Space</td>
                    <td class="p-2">
                        {{ data.disk_space.use_percentage}}% Used
                        ({{ data.disk_space.used.memory }}<span class="text-xs">{{ data.disk_space.used.unit.toLowerCase() }}</span> / {{ data.disk_space.total.memory }}<span class="text-xs">{{ data.disk_space.total.unit.toLowerCase() }}</span>)
                    </td>
                </tr>
                <tr v-if="data.memory_usage">
                    <td class="py-2 pr-2 font-bold">Memory Usage</td>
                    <td class="p-2">
                        {{ data.memory_usage.use_percentage}}% Used ({{ data.memory_usage.used.memory }}<span class="text-xs">{{ data.memory_usage.used.unit.toLowerCase() }}</span> / {{ data.memory_usage.total.memory }}<span class="text-xs">{{ data.memory_usage.total.unit.toLowerCase() }}</span>)
                    </td>
                </tr>
                <tr>
                    <td class="py-2 pr-2 font-bold">CPU Usage</td>
                    <td class="p-2">
                        {{ data.cpu_usage.use_percentage}}% Used
                        <br>
                        <span class="text-xs">{{ data.cpu_usage.name }}</span>
                    </td>
                </tr>
            </tbody>
        </table>
        <div v-else>
            {{ __('No Data') }}
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
            endpoint: '/nova-vendor/stepanenko3/nova-cards/system-resources',
        }),

        methods: {
            success: function(data) {
                this.data = data
            }
        }
    }
</script>
