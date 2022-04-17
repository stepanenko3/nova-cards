Nova.booting((Vue) => {
    Vue.component('LoadingCardWithButton', require('./components/LoadingCardWithButton').default);
    Vue.component('system-resources-card', require('./components/SystemResources').default);
    Vue.component('versions-card', require('./components/Versions').default);
    Vue.component('html-card', require('./components/Html').default);
    Vue.component('scheduled-jobs-card', require('./components/ScheduledJobs').default);
  });
