<template>
    <Card class="h-auto overflow-hidden" :class="{ 'px-3 py-3': card.hasPadding }">
        <iframe
            class="w-full h-full"
            :src="card.url"
            allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
            allowfullscreen
        ></iframe>
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
    };
</script>
