<template>
    <Card class="h-auto p-4">
        <Heading :level="3" class="flex items-center justify-between mb-2">
            <span>{{ heading }}</span>

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

        <slot v-if="!loading" />
    </Card>
</template>

<script>
    export default {
        props: ['card', 'refresh', 'loading', 'heading'],
    }
</script>
