export default {
    props: {
        card: {
            type: Object,
            required: true,
        },
    },

    data: () => ({
        loading: false,
        polling: false,
        interval: null,
        killed: false,
    }),

    mounted() {
        this.fetch();

        if (this.card.pollingStart) {
            this.polling = true;
        }

        if (this.card.pollingTime) {
            this.setupInterval();
        }
    },

    beforeUnmount() {
        this.killed = true;
    },

    methods: {
        fetch(loadingType = 'default') {
            if (loadingType !== 'polling') {
                clearInterval(this.interval);
            }

            if (this.loading)
                return;

            this.loading = true
            this.loadingType = loadingType;

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
                })
                .catch(error => {
                    this.loading = false

                    const data = Array.isArray(error.response)
                        ? error.response.map(res => res.data)
                        : error.response.data;

                    this.error(data, error.response, error);
                })
                .finally(() => {
                    if (loadingType !== 'polling') {
                        this.setupInterval();
                    }
                })
        },

        success(data, response) {

        },

        error(data, response, error) {

        },

        setupInterval() {
            clearInterval(this.interval);

            if (this.killed) {
                return;
            }

            this.interval = setInterval(() => {
                if (this.killed) {
                    clearInterval(this.interval);
                    return;
                }

                if (this.polling && !this.loading) {
                    this.fetch('polling');
                }
            }, this.card.pollingTime);
        },
    }
}
