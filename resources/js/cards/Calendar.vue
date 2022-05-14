<template>
    <Card class="h-auto p-4">
        <Heading :level="3" class="flex items-center justify-between mb-2">
            {{ card.day.name }}, {{ card.day.withMonth }}
        </Heading>

        <table class="w-full text-left table-collapse">
            <tbody class="align-baseline">
                <tr>
                    <td class="py-2 pr-2 font-bold">
                        Year
                    </td>
                    <td class="p-2">
                        {{ card.year }}
                    </td>
                </tr>
                <!-- <tr>
                    <td class="py-2 pr-2 font-bold">
                        Day of week
                    </td>
                    <td class="p-2">
                        {{ card.dayOfWeek }}
                    </td>
                </tr> -->
                <tr>
                    <td class="py-2 pr-2 font-bold">
                        Day of year
                    </td>
                    <td class="p-2">
                        {{ card.dayOfYear }}
                    </td>
                </tr>
                <!-- <tr>
                    <td class="py-2 pr-2 font-bold">
                        Week of month
                    </td>
                    <td class="p-2">
                        {{ card.weekOfMonth }}
                    </td>
                </tr> -->
                <!-- <tr>
                    <td class="py-2 pr-2 font-bold">
                        Week of year
                    </td>
                    <td class="p-2">
                        {{ card.weekOfYear }}
                    </td>
                </tr> -->
                <tr>
                    <td class="py-2 pr-2 font-bold">
                        Days in month
                    </td>
                    <td class="p-2">
                        {{ card.daysInMonth }}
                    </td>
                </tr>
                <tr>
                    <td class="py-2 pr-2 font-bold">
                        Qarter
                    </td>
                    <td class="p-2">
                        {{ card.quarter }}
                    </td>
                </tr>
                <tr>
                    <td class="py-2 pr-2 font-bold">
                        Timezone
                    </td>
                    <td class="p-2">
                        {{ card.timezone }}
                    </td>
                </tr>
            </tbody>
        </table>
    </Card>
</template>

<script>
    export default {
        props: {
            card: {
                type: Object,
                required: true,
            },
        },

        created() {
            //
        },

        mounted() {
            //
        },

        methods: {
            //
        }
    }
</script>
