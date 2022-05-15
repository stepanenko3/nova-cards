<template>
    <LoadingCardWithButton
        :heading="card.title || __('Nova Release')"
        :loading="loading"
        @refresh="fetch"
    >
        <a
            href="https://nova.laravel.com/releases"
            class="px-3 py-4 flex flex-col items-center no-underline text-80"
            v-if="loaded"
            target="_blank"
        >
            <div class="flex items-center mb-4 w-full">
                <svg v-if="outOfDate" class="align-middle fill-current text-warning w-8 h-8 mr-2"
                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                    <path
                        d="M504 256c0 136.997-111.043 248-248 248S8 392.997 8 256C8 119.083 119.043 8 256 8s248 111.083 248 248zm-248 50c-25.405 0-46 20.595-46 46s20.595 46 46 46 46-20.595 46-46-20.595-46-46-46zm-43.673-165.346l7.418 136c.347 6.364 5.609 11.346 11.982 11.346h48.546c6.373 0 11.635-4.982 11.982-11.346l7.418-136c.375-6.874-5.098-12.654-11.982-12.654h-63.383c-6.884 0-12.356 5.78-11.981 12.654z" />
                </svg>
                <svg v-else class="align-middle fill-current text-info w-8 h-8 mr-2" xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 512 512">
                    <path
                        d="M504 256c0 136.967-111.033 248-248 248S8 392.967 8 256 119.033 8 256 8s248 111.033 248 248zM227.314 387.314l184-184c6.248-6.248 6.248-16.379 0-22.627l-22.627-22.627c-6.248-6.249-16.379-6.249-22.628 0L216 308.118l-70.059-70.059c-6.248-6.248-16.379-6.248-22.628 0l-22.627 22.627c-6.248 6.248-6.248 16.379 0 22.627l104 104c6.249 6.249 16.379 6.249 22.628.001z" />
                </svg>

                <Heading
                    v-if="outOfDate"
                    level="1"
                    class="text-center font-bold text-xl"
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
