<template>
    <tr>
        <td class="py-2 pr-2 font-bold">
            {{ props.timezone }}
        </td>
        <td class="p-2">
            {{ iso[2] || "-" }}
        </td>
        <td class="p-2">
            <Icon
                class="text-primary-500"
                :type="isDayTime(currentTime) ? 'sun' : 'moon'"
            ></Icon>
        </td>
    </tr>
</template>

<script setup lang="ts">
import { useCurrentTime } from "../composables/useCurrentTime";

const props = defineProps<{
    timezone: string;
}>();

const { currentTime, iso } = useCurrentTime(props.timezone);

function isDayTime(date) {
    const hours = date.getHours();

    return hours > 6 && hours < 20;
}
</script>
