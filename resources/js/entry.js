Nova.booting((Vue) => {
    Vue.component('LoadingCardWithButton', require('./components/LoadingCardWithButton').default);
    //
    Vue.component('system-resources-card', require('./components/SystemResources').default);
    Vue.component('versions-card', require('./components/Versions').default);
    Vue.component('html-card', require('./components/Html').default);
    Vue.component('scheduled-jobs-card', require('./components/ScheduledJobs').default);
    Vue.component('percentage-card', require('./components/Percentage').default);
    Vue.component('linkable-card', require('./components/Linkable').default);
    Vue.component('ssl-card', require('./components/Ssl').default);
    Vue.component('countdown-card', require('./components/Countdown').default);
    Vue.component('world-clock-card', require('./components/WorldClock').default);
    Vue.component('blockchain-exchange-card', require('./components/BlockchainExchange').default);
  });
