<template>
    <NovaCardsCard
        class="h-auto overflow-hidden"
        :class="{ 'p-3': card.hasPadding, '!p-none !p-0': !card.hasPadding }"
    >
        <iframe
            class="w-full h-full"
            :src="card.url"
            allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
            allowfullscreen
        ></iframe>
    </NovaCardsCard>
</template>

<script setup lang="ts">
import { defineProps } from "vue";

defineProps<{
    card: {
        url: string;
        hasPadding: boolean;
    };
}>();
</script>
