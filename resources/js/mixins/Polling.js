export default {
    props: {
        card: {
            type: Object,
            required: true,
        },
    },

    data: () => ({
        loading: false,
        timeout: null,
        endpoint: '',
    }),

    mounted() {
        this.fetch()
    },

    methods: {
        fetch() {
            if (this.loading)
                return;

            this.loading = true
            if (this.timeout) {
                clearTimeout(this.timeout);
            }

            Nova.request()
                .get(this.endpoint, this.payload())
                .then(response => {
                    this.loading = false

                    this.success(response.data, response);

                    if (this.card.pollingTime) {
                        this.timeout = setTimeout(this.fetch, this.card.pollingTime)
                    }
                })
                .catch(error => {
                    this.loading = false

                    this.error(error.response.data, error.response, error);
                })
        },

        success(data, response) {

        },
        error(data, response, error) {

        },

        payload: () => ({})
    }
}
