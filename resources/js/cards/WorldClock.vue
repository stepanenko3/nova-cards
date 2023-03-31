<template>
    <Card class="h-auto p-4">
        <Heading :level="3" class="flex items-center justify-between mb-2">
            <span class="word-wrap: break-word">
                {{ card.title || __("World Clock") }}
            </span>
        </Heading>

        <div class="card-overflow">
            <table v-if="card.timezones.length > 0" class="w-full text-left table-collapse">
                <tbody class="align-baseline">
                    <WorldClockTimer
                        v-for="timezone in card.timezones"
                        :timezone="timezone"
                    />
                </tbody>
            </table>
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
};
</script>
