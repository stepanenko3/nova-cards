<template>
    <LoadingCardWithButton
        :heading="card.domain + ' - ' + (data.is_valid ? 'Valid Certificate' : 'Invalid Certificate')"
        :headingClass="{ 'text-green-500' : data.is_valid, 'text-red-500' : ! data.is_valid }"
        :loading="loading"
        @refresh="fetch"
    >
        <table v-if="!errorMessage" class="w-full text-left table-collapse">
            <tbody class="align-baseline">
                <tr>
                    <td class="py-2 pr-2 font-bold">
                        Issuer
                    </td>
                    <td class="p-2">
                        {{ data.issuer }}
                    </td>
                </tr>
                <tr>
                    <td class="py-2 pr-2 font-bold">
                        Expiration
                    </td>
                    <td class="p-2">
                        {{ data.expiration_date }} (<strong class="italic">{{ data.expiration_date_in_days }} days</strong>)
                    </td>
                </tr>
            </tbody>
        </table>

        <div v-else>
            {{ errorMessage }}
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
            data: {},
    		errorMessage: null,
            endpoint: '/nova-vendor/stepanenko3/nova-cards/ssl',
        }),

        methods: {
            success(data) {
                this.data = data
            },

            error(data) {
        		this.errorMessage = data.error;
            },

            payload() {
                return {
                    params: {
                        domain: this.card.domain,
                    },
                };
            }
        },
    }
</script>
