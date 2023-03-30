<template>
    <LoadingCardWithButton
        :heading="res && res.sys ? `${res.name}, ${res.sys.country}` : 'Weather'"
        :card="card"
        :loading="loading"
        :loadingType="loadingType"
        :polling="polling"
        @update:polling="polling = $event"
        @refresh="fetch('button')"
    >
        <template v-if="res && res.sys">
            <div class="flex items-center mb-2">
                <img
                    class="mr-2"
                    :src="`http://openweathermap.org/img/wn/${res.weather[0].icon}@2x.png`"
                    :alt="res.weather[0].icon"
                    width="50"
                    height="50"
                    v-tooltip="res.weather[0].description.charAt(0).toUpperCase() + res.weather[0].description.substring(1)"
                />

                <div class="text-xl font-bold">
                    {{ Math.round(res.main.temp) }} °C
                </div>
            </div>

            <div class="text-lg font-bold mb-4">
                {{ res.weather[0].description.charAt(0).toUpperCase() + res.weather[0].description.substring(1) }}
            </div>

            <div class="grid grid-cols-4 gap-6 text-sm">
                <div class="flex flex-col">
                    <span class="mb-1">
                        Feels like
                    </span>
                    <b>
                        {{ Math.round(res.main.feels_like) }} °C
                    </b>
                </div>
                <div class="flex flex-col">
                    <span class="mb-1">
                        Humidity
                    </span>
                    <b>
                        {{ res.main.humidity }}%
                    </b>
                </div>
                <div class="flex flex-col">
                    <span class="mb-1">
                        Sunrise
                    </span>
                    <b>
                        {{ new Date(res.sys.sunrise * 1000).toLocaleString('en-GB', {
                            hour: '2-digit',
                            minute: '2-digit',
                            timeZone: 'Europe/Kiev',
                        }) }}
                    </b>
                </div>
                <div class="flex flex-col">
                    <span>
                        Sunset
                    </span>
                    <b>
                        {{ new Date(res.sys.sunset * 1000).toLocaleString('en-GB', {
                            hour: '2-digit',
                            minute: '2-digit',
                            timeZone: 'Europe/Kiev',
                        }) }}
                    </b>
                </div>
            </div>
        </template>
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
    		res: {},
        }),

        methods: {
            endpoint() {
                const queryString = new URLSearchParams({
                    q: this.card.city,
                    lang: this.card?.lang || '',
                }).toString();

                return Nova.request().get('/nova-vendor/stepanenko3/nova-cards/weather' + (queryString ? `?${queryString}`  :''));
            },

            success(data) {
                this.res = data
            },
        },
    }
</script>

<style>
    .grid-cols-4 {
        grid-template-columns: repeat(4,minmax(0,1fr));
    }
</style>
