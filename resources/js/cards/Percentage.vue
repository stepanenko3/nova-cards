<template>
    <Card class="h-auto p-4">
        <Heading :level="3" class="flex items-center justify-between mb-2">
            {{ card.title }}
        </Heading>
        <p class="flex items-center text-4xl mb-4">
            <span v-if="percentage !== null">
                {{ percentage }}%
            </span>
            <span v-else>-</span>
        </p>
        <div class="flex items-center">
            <p class="text-80 font-bold" v-show="percentage !== null">
                <span v-if="count!==null">{{ card.count }}</span>
                {{ __('of') }}
                <span v-if="total!==null">{{ card.total }}</span>
                {{ card.label }}
            </p>
            <p class="text-80 font-bold mt-4" v-show="percentage === null">
                {{ __('No Data') }}
            </p>
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
        },

        data: () => ({
            percentage: null,
        }),

        mounted() {
            this.init();
        },

        methods: {
            init() {
                this.percentage = (this.card.count / this.card.total * 100)
                    .toFixed(this.card.percentagePrecision);
            },
        },
    }
</script>
