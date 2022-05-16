<template>
    <LoadingCardWithButton
        :heading="card.title || __('Current Environment')"
        :card="card"
        :loading="loading"
        :loadingType="loadingType"
        :polling="polling"
        @update:polling="polling = $event"
        @refresh="fetch('button')"
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
        }),

        methods: {
            endpoint() {
                return Nova.request().get('/nova-vendor/stepanenko3/nova-cards/environment');
            },

            success(data) {
                this.env = data
            },
        },
    }
</script>
