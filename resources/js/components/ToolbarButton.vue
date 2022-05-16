<template>
    <button
        type="button"
        class="relative inline-flex items-center justify-center w-8 h-8 focus:outline-none focus:ring rounded-lg"
    >
        <span :class="{ invisible: processing || loading }">
            <slot />
            <Icon v-if="type" solid :type="type" />
        </span>

        <span
            v-if="processing || loading"
            class="absolute"
            style="top: 50%; left: 50%; transform: translate(-50%, -50%)"
        >
            <Loader class="text-gray-500" width="32" />
        </span>
    </button>
</template>

<script>
    export default {
        props: {
            type: {
                type: String,
                required: false,
            },
            processing: {
                type: Boolean,
                required: false,
            },
            loading: {
                type: Boolean,
                required: false,
            },
        },
    }
</script>
