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
    }),

    mounted() {
        this.fetch();
    },

    methods: {
        fetch() {
            if (this.loading)
                return;

            this.loading = true
            if (this.timeout) {
                clearTimeout(this.timeout);
            }

            const endpoint = this.endpoint();
            const promise = Array.isArray(endpoint)
                ? Promise.all(endpoint)
                : endpoint;

            promise
                .then(response => {
                    this.loading = false

                    const data = Array.isArray(response)
                        ? response.map(res => res.data)
                        : response.data;

                    this.success(data, response);

                    if (this.card.pollingTime) {
                        this.timeout = setTimeout(this.fetch, this.card.pollingTime)
                    }
                })
                .catch(error => {
                    this.loading = false

                    const data = Array.isArray(error.response)
                        ? error.response.map(res => res.data)
                        : error.response.data;

                    this.error(data, error.response, error);
                })
        },

        success(data, response) {

        },
        error(data, response, error) {

        },
    }
}
