<template>
    <Card class="h-auto p-4">
        <Heading :level="3" class="flex items-center justify-between mb-2">
            <span :class="headingClass">
                {{ heading }}
            </span>

            <LoadingButton
                class="relative ml-auto"
                size="xs"
                component="LinkButton"
                :disabled="loading"
                :loading="loading"
                @click="$emit('refresh')"
            >
                <Icon type="refresh" />
            </LoadingButton>
        </Heading>

        <Loader v-if="loading" class="mb-4"></Loader>

        <div class="card-overflow">
            <slot v-if="!loading" />
        </div>
    </Card>
</template>

<script>
    export default {
        props: {
            card: {
                type: Object,
                required: true,
            },
            refresh: {
                type: Object,
                required: false,
            },
            loading: {
                type: Boolean,
                required: false,
            },
            heading: {
                type: String,
                required: true,
            },
            headingClass: {
                type: String,
                required: false,
            },
        },
    }
</script>

<style>
    .card-overflow {
        max-height: 250px;
        overflow-y: auto;
    }
</style>
