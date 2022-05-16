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
        <div class="flex items-center w-full">
            <Icon
                width="30"
                height="30"
                :type="env !== 'production' ? 'exclamation-circle' : 'check-circle'"
                class="mr-4"
                :class="{
                    'text-yellow-500': env !== 'production',
                    'text-green-500': env === 'production',
                }"
            />

            <Heading
                level="3"
                v-text="env"
            />
        </div>
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
