<template>
    <NovaCardsCard class="flex flex-col items-center justify-center">
        <div class="text-basic text-center mb-2">
            {{ card.title || __("Current Environment") }}
        </div>
        <div
            class="flex items-center w-full text-lg font-bold uppercase"
            :class="{
                'text-yellow-500': card.env !== 'production',
                'text-green-500': card.env === 'production',
            }"
        >
            <span v-if="card.env !== 'production'" class="mr-2"> ( ! ) </span>
            {{ card.env }}
        </div>
    </NovaCardsCard>
</template>

<script setup lang="ts">
import { defineProps } from "vue";
import { useLocalization } from "LaravelNova";

defineProps<{
    card: {
        title: string;
        env: string;
    };
}>();

const { __ } = useLocalization();
</script>
