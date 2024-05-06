<template>
    <NovaCardsCard
        :heading="
            response && response.sys
                ? `${response.name}, ${response.sys.country}`
                : __('Weather')
        "
        :showPolling="card?.polling || false"
        :showRefresh="card?.refresh || true"
        :loading="loading"
        :polling="polling"
        :pollingInterval="10000"
        @update:polling="polling = $event"
        @refresh="refresh"
    >
        <template v-if="response && response.sys">
            <div class="flex items-center mb-2">
                <img
                    class="mr-2"
                    :src="`http://openweathermap.org/img/wn/${response.weather[0].icon}@2x.png`"
                    :alt="response.weather[0].icon"
                    width="50"
                    height="50"
                    v-tooltip="
                        response.weather[0].description
                            .charAt(0)
                            .toUpperCase() +
                        response.weather[0].description.substring(1)
                    "
                />

                <div class="text-xl font-bold">
                    {{ Math.round(response.main.temp) }} °C
                </div>
            </div>

            <div class="text-lg font-bold mb-4">
                {{
                    response.weather[0].description.charAt(0).toUpperCase() +
                    response.weather[0].description.substring(1)
                }}
            </div>

            <div class="grid grid-cols-4 gap-6 text-sm">
                <div class="flex flex-col">
                    <span class="mb-1"> Feels like </span>
                    <b> {{ Math.round(response.main.feels_like) }} °C </b>
                </div>
                <div class="flex flex-col">
                    <span class="mb-1"> Humidity </span>
                    <b> {{ response.main.humidity }}% </b>
                </div>
                <div class="flex flex-col">
                    <span class="mb-1"> Sunrise </span>
                    <b>
                        {{
                            new Date(
                                response.sys.sunrise * 1000
                            ).toLocaleString("en-GB", {
                                hour: "2-digit",
                                minute: "2-digit",
                                timeZone: "Europe/Kiev",
                            })
                        }}
                    </b>
                </div>
                <div class="flex flex-col">
                    <span> Sunset </span>
                    <b>
                        {{
                            new Date(response.sys.sunset * 1000).toLocaleString(
                                "en-GB",
                                {
                                    hour: "2-digit",
                                    minute: "2-digit",
                                    timeZone: "Europe/Kiev",
                                }
                            )
                        }}
                    </b>
                </div>
            </div>
        </template>
    </NovaCardsCard>
</template>

<script setup lang="ts">
import { ref } from "vue";
import { useLocalization } from "LaravelNova";

const props = defineProps<{
    card: {
        city: string;
        lang?: string;
        polling?: boolean;
        refresh?: boolean;
    };
}>();

const { __ } = useLocalization();

const loading = ref<boolean>(false);
const polling = ref<boolean>(false);
const response = ref();

async function refresh() {
    loading.value = true;

    const queryString = new URLSearchParams({
        q: props.card.city || "Kiev ",
        lang: props.card?.lang || "",
    }).toString();

    await fetch(
        "/nova-vendor/stepanenko3/nova-cards/weather" +
            (queryString ? `?${queryString}` : "")
    )
        .then((res) => res.json())
        .then((data) => {
            response.value = data;
        })
        .catch((error) => {
            console.error("Error fetching weather:", error);
        });

    loading.value = false;
}
</script>
