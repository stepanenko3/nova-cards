<template>
    <NovaCardsCard
        :heading="card.title || __('Countdown')"
        class="flex flex-col items-center justify-center text-center"
    >
        <p class="flex items-center text-4xl mb-4">
            {{ timeLeft }}
        </p>

        <div class="text-center" v-if="card.label">
            {{ card.label }}
        </div>
    </NovaCardsCard>
</template>

<script setup lang="ts">
import { ref, defineProps, onMounted } from "vue";
import { useLocalization } from "LaravelNova";

const props = defineProps<{
    card: {
        title: string;
        to: number;
        label: string;
    };
}>();

const { __ } = useLocalization();

const timeLeft = ref<string>("00:00:00:00");
const remainingTime = ref<number>(0);
const seconds = ref<number>(0);
const minutes = ref<number>(0);
const hours = ref<number>(0);
const days = ref<number>(0);

onMounted(() => {
    remainingTime.value = props.card.to - new Date().getTime();

    if (remainingTime.value > 0) window.requestAnimationFrame(showTime);

    window.addEventListener("focus", () => {
        if (remainingTime.value < 1000) {
            timeLeft.value = "00:00:00:00";
            window.cancelAnimationFrame(showTime);
        }
    });
});

const pad = (value: number) => ("0" + Math.floor(value)).slice(-2);

const showTime = () => {
    remainingTime.value = props.card.to - new Date().getTime();
    seconds.value = pad((remainingTime.value % (1000 * 60)) / 1000);
    minutes.value = pad((remainingTime.value % (1000 * 60 * 60)) / (1000 * 60));
    hours.value = pad(
        (remainingTime.value % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60)
    );
    days.value = pad(remainingTime.value / (1000 * 60 * 60 * 24));

    // ensure clock only updates if a second or more is remaining
    if (remainingTime.value >= 1000) {
        timeLeft.value = `${days.value}:${hours.value}:${minutes.value}:${seconds.value}`;
        window.requestAnimationFrame(showTime);
    } else {
        window.cancelAnimationFrame(showTime);
        timeLeft.value = "00:00:00:00";
    }
};
</script>
