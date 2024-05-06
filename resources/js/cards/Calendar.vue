<template>
    <NovaCardsCard :heading="`${card.day.name} ${card.day.withMonth}`">
        <table class="w-full text-left table-collapse">
            <tbody class="align-baseline">
                <tr>
                    <td class="py-2 pr-2 font-bold">
                        {{ __('Year') }}
                    </td>
                    <td class="p-2">
                        {{ card.year }}
                    </td>
                </tr>
                <!-- <tr>
                    <td class="py-2 pr-2 font-bold">
                        {{ __('Day of week') }}
                    </td>
                    <td class="p-2">
                        {{ card.dayOfWeek }}
                    </td>
                </tr> -->
                <tr>
                    <td class="py-2 pr-2 font-bold">
                        {{ __('Day of year') }}
                    </td>
                    <td class="p-2">
                        {{ card.dayOfYear }}
                    </td>
                </tr>
                <!-- <tr>
                    <td class="py-2 pr-2 font-bold">
                        {{ __('Week of month') }}
                    </td>
                    <td class="p-2">
                        {{ card.weekOfMonth }}
                    </td>
                </tr> -->
                <!-- <tr>
                    <td class="py-2 pr-2 font-bold">
                        {{ __('Week of year') }}
                    </td>
                    <td class="p-2">
                        {{ card.weekOfYear }}
                    </td>
                </tr> -->
                <tr>
                    <td class="py-2 pr-2 font-bold">
                        {{ __('Days in month') }}
                    </td>
                    <td class="p-2">
                        {{ card.daysInMonth }}
                    </td>
                </tr>
                <tr>
                    <td class="py-2 pr-2 font-bold">
                        {{ __('Qarter') }}
                    </td>
                    <td class="p-2">
                        {{ card.quarter }}
                    </td>
                </tr>
                <tr>
                    <td class="py-2 pr-2 font-bold">
                        {{ __('Timezone') }}
                    </td>
                    <td class="p-2">
                        {{ card.timezone }}
                    </td>
                </tr>
            </tbody>
        </table>
    </NovaCardsCard>
</template>

<script setup lang="ts">
import { defineProps } from "vue";
import { useLocalization } from "LaravelNova";

const { __ } = useLocalization();

defineProps<{
    card: {
        day: {
            name: string;
            withMonth: string;
        };
        year: number;
        dayOfWeek: number;
        dayOfYear: number;
        weekOfMonth: number;
        weekOfYear: number;
        daysInMonth: number;
        quarter: number;
        timezone: string;
    };
}>();
</script>
