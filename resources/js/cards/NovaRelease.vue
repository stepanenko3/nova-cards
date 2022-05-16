<template>
    <LoadingCardWithButton
        :heading="card.title || __('Nova Release')"
        :card="card"
        :loading="loading"
        :loadingType="loadingType"
        :polling="polling"
        @update:polling="polling = $event"
        @refresh="fetch('button')"
    >
        <a
            href="https://nova.laravel.com/releases"
            class="flex flex-col items-center no-underline"
            v-if="loaded"
            target="_blank"
        >
            <div class="flex items-center mb-4 w-full">
                <Icon
                    width="30"
                    height="30"
                    :type="outOfDate ? 'exclamation-circle' : 'check-circle'"
                    class="mr-4"
                    :class="{
                        'text-yellow-500': outOfDate,
                        'text-green-500': !outOfDate,
                    }"
                />

                <Heading
                    level="3"
                    v-text="outOfDate ? __('Nova is out of date') : __('Nova is up to date')"
                />
            </div>

            <table class="w-full text-left table-collapse">
                <tbody class="align-baseline">
                    <tr>
                        <td class="py-2 pr-2 font-bold">Latest</td>
                        <td class="p-2">
                            <span :class="{ 'text-90': outOfDate }">
                                v{{ current_release_version }}
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td class="py-2 pr-2 font-bold">Installed</td>
                        <td class="p-2">
                            v{{ installed_version }}
                        </td>
                    </tr>
                </tbody>
            </table>
        </a>

        <div v-else>
            {{ __('No Data') }}
        </div>
    </LoadingCardWithButton>
</template>

<script>
    import Polling from '../mixins/Polling'

    export default {
        props: ['card'],

        data: () => ({
            installed_version: null,
            releases: [],
            current_release_version: null,
        }),

        mixins: [Polling],

        methods: {
            endpoint() {
                return [
                    Nova.request().get('/nova-vendor/stepanenko3/nova-cards/nova-releases'),
                    Nova.request().get('/nova-vendor/stepanenko3/nova-cards/nova-version'),
                ];
            },

            success(response) {
                this.releases = response[0].releases;
                this.current_release_version = response[0].current_version;
                this.installed_version = response[1].installed_version;
            },
        },

        computed: {
            outOfDate: function () {
                return this.installed_version !== this.current_release_version;
            },

            loaded: function () {
                return (this.installed_version !== null && this.current_release_version !== null);
            },
        },
    }
</script>
