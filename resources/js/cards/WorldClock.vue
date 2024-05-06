<template>
    <NovaCardsCard
        class="flex flex-col items-center justify-center text-center"
        :heading="card.title || __('World Clock')"
    >
        <div class="card-overflow">
            <table
                v-if="card.timezones.length > 0"
                class="w-full text-left table-collapse"
            >
                <tbody class="align-baseline">
                    <WorldClockTimer
                        v-for="timezone in card.timezones"
                        :timezone="timezone"
                    />
                </tbody>
            </table>
        </div>
    </NovaCardsCard>
</template>

<script setup lang="ts">
import { useLocalization } from "LaravelNova";

defineProps<{
    card: {
        title: string;
        timezones: string[];
    };
}>();

const { __ } = useLocalization();
</script>
