<template>
    <a
        class="h-auto hover:opacity-50 transition"
        :href="card.url"
        :target="card.target"
    >
        <NovaCardsCard
            class="flex flex-col items-center justify-center"
            :heading="card.title"
            headingClass="text-2xl font-bold"
        >
            <div v-if="card.subtitle" calss="text-basic font-semibold">
                {{ card.subtitle }}
            </div>
        </NovaCardsCard>
    </a>
</template>

<script setup lang="ts">
import { defineProps } from "vue";

defineProps<{
    card: {
        title: string;
        subtitle?: string;
        url: string;
        target: string;
    };
}>();
</script>
