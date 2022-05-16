<template>
    <Card class="h-auto p-4" :class="class">
        <Heading v-if="heading" :level="3" class="flex items-center justify-between mb-2">
            <span :class="headingClass">
                {{ heading }}
            </span>

            <div
                class="md:ml-2 inline-flex items-center shadow rounded-lg bg-white dark:bg-gray-800 px-2 h-8"
            >
                <CardToolbarButton
                    type="refresh"
                    v-tooltip="__('Refresh')"
                    :loading="loading"
                    @click.prevent="$emit('refresh')"
                />

                <CardToolbarButton
                    v-if="card.polling"
                    type="clock"
                    @click.prevent="$emit('update:polling', !polling)"
                    v-tooltip="polling ? __('Stop polling') : __('Start polling')"
                    :class="{
                        'text-green-500': polling,
                        'text-gray-500': !polling,
                    }"
                    class="w-8 h-8"
                />
            </div>
        </Heading>

        <Loader v-if="bodyLoading" class="mb-4"></Loader>

        <div v-else class="card-overflow" :class="owerflowClass">
            <slot />
        </div>
    </Card>
</template>

<script>
    import ToolbarButton from './ToolbarButton'

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
            loadingType: {
                type: String,
                required: false,
            },
            polling: {
                type: Boolean,
                required: true,
            },
            class: {
                type: String,
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
            owerflowClass: {
                type: String,
                required: false,
            },
        },

        emits: [
            'update:polling',
        ],

        components: {
            CardToolbarButton: ToolbarButton,
        },

        computed: {
            bodyLoading() {
                return this.loading && (!this.loadingType || this.loadingType === 'default');
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
