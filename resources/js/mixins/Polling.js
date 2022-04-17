export default {
    props: ['card'],

    data: () => ({
        loading: false,
        timeout: null,
        fetchPath: '',
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

            Nova.request().get(this.fetchPath).then((response) => {
                this.loading = false

                this.fetchCallback(response.data, response);

                if (this.card.pollingTime) {
                    this.timeout = setTimeout(this.fetch, this.card.pollingTime)
                }
            })
        },
        fetchCallback: (data, response) => {},
    }
}
