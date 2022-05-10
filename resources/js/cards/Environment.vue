<template>
    <LoadingCardWithButton
        :heading="card.title || __('Current Environment')"
        :loading="loading"
        @refresh="fetch"
    >
        <Heading level="1" class="text-center font-bold text-xl">{{ env }}</Heading>
    </LoadingCardWithButton>
</template>

<script>
    import Polling from '../mixins/Polling.js'

    export default {
        props: {
            card: {
                type: Object,
                required: true,
            },
        },

        mixins: [Polling],

        data: () => ({
    		env: '...',
            endpoint: '/nova-vendor/stepanenko3/nova-cards/environment',
        }),

        methods: {
            success(data) {
                this.env = data
            },
        },
    }
</script>
