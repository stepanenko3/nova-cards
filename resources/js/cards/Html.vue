<template>
    <div v-if="card.withoutCardStyles" class="h-full" :class="cardClassList" v-html="card.content"></div>
    <NovaCardsCard v-else :class="cardClassList" v-html="card.content" />
</template>

<script setup lang="ts">
import { computed, defineProps } from 'vue';

const props = defineProps<{
    card: {
        content: string;
        center?: boolean;
        forceFullWidth?: boolean;
        withoutCardStyles?: boolean;
    };
}>();

const cardClassList = computed(() => {
    let classes = '';

    if (props.card.center) {
        classes += ' flex flex-col justify-center text-center';
    }
    return classes;
});
</script>
