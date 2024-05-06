<template>
    <NovaCardsCard
        :heading="card.title"
        class="flex flex-col items-center justify-center text-center"
    >
        <p class="flex items-center text-4xl mb-4">
            <span v-if="percentage !== null"> {{ percentage }}% </span>
            <span v-else>-</span>
        </p>

        <div class="flex items-center">
            <p class="text-80 font-bold" v-show="percentage !== null">
                <span v-if="card.count !== null">{{ card.count }}</span>
                {{ __("of") }}
                <span v-if="total !== null">{{ card.total }}</span>
                {{ card.label }}
            </p>
            <p class="text-80 font-bold mt-4" v-show="percentage === null">
                {{ __("No Data") }}
            </p>
        </div>
    </NovaCardsCard>
</template>

<script setup lang="ts">
import { computed, defineProps } from "vue";
import { useLocalization } from "LaravelNova";

const props = defineProps<{
    card: {
        title: string;
        count: number;
        total: number;
        label: string;
        percentagePrecision: number;
    };
}>();

const { __ } = useLocalization();

const percentage = computed(() =>
    ((props.card.count / props.card.total) * 100).toFixed(
        props.card.percentagePrecision
    )
);
</script>
