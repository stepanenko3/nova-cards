<template>
    <Card class="h-auto p-4">
        <div class="w-full px-3 py-3">
            <Heading v-if="card.showtitle" :level="3" class="flex items-center justify-between mb-2">
                {{ card.title }}
            </Heading>

            <table v-if="data.length > 0" class="w-full text-left table-collapse">
                <tbody class="align-baseline">
                    <tr v-for="time in data" :key="time.name">
                        <td class="py-2 pr-2 font-bold">
                            {{ time.name }}
                        </td>
                        <td class="p-2">
                            {{ time.time }}
                        </td>
                        <td class="p-2">
                            <Icon class="text-primary-500" :type="time.night ? 'moon' : 'sun'"></Icon>
                        </td>
                    </tr>
                </tbody>
            </table>

            <div v-else>
                {{ __('No Data') }}
            </div>
        </div>
    </Card>
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
            endpoint: '/nova-vendor/stepanenko3/nova-cards/world-clock',
        }),

        methods: {
            success(data) {
                this.data = data;
            },

            payload() {
                return {
                    params: {
                        timezones: this.card.timezones,
                        timeFormat: this.card.timeFormat,
                    },
                };
            },
        },
    }
</script>
