<template>
    <a class="h-auto hover:opacity-50" :href="card.url" :target="card.target">
        <Card class="h-full p-4 flex flex-col items-center justify-center ">
            <Icon width="32" height="32" class="mb-4" type="link"></Icon>
            <Heading level="1" class="mb-3">{{ card.title }}</Heading>
            <Heading level="3" v-if="card.subtitle">{{ card.subtitle }}</Heading>
        </Card>
    </a>
</template>

<script>
    export default {
        props: {
            card: {
                type: Object,
                required: true,
            },
        },

        computed: {
            cardClassList() {
                let classes = '';
                if (this.card.center) {
                    classes += ' flex flex-col justify-center text-center';
                }
                return classes;
            },
        },

        mounted() {
            if (this.card.forceFullWidth) {
                this.$parent.$el.classList.remove('w-5/6');
                this.$parent.$el.classList.add('w-full');
            }
        },
    }
</script>

<style>
    .htmlCard {
        height: auto;
    }

    .htmlCard__content>p:not(:last-child) {
        margin-bottom: 1em;
    }
</style>
