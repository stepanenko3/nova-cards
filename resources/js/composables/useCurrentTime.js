import { ref, onBeforeUnmount } from "vue";

export const useCurrentTime = (timezone = null) => {
    const currentTime = ref(getDate(timezone));
    const iso = ref(currentTime.value.toISOString().match(/(\d{4}\-\d{2}\-\d{2})T(\d{2}:\d{2}:\d{2})/));

    const updateCurrentTime = () => {
        currentTime.value = getDate(timezone);
        iso.value = currentTime.value.toISOString().match(/(\d{4}\-\d{2}\-\d{2})T(\d{2}:\d{2}:\d{2})/);
    };

    const updateTimeInterval = setInterval(updateCurrentTime, 1000);

    onBeforeUnmount(() => {
        clearInterval(updateTimeInterval);
    });

    return {
        currentTime,
        iso,
    };
};

function getDate(timezone = null) {
    return timezone
        ? new Date(
            new Date().toLocaleString('en-US', {
                timeZone: timezone,
            }),
        )
        : new Date();
}
