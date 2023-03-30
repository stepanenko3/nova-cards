import LoadingCardWithButton from './components/LoadingCardWithButton'
//
import SystemResources from './cards/SystemResources'
import Versions from './cards/Versions'
import Html from './cards/Html'
import ScheduledJobs from './cards/ScheduledJobs'
import Percentage from './cards/Percentage'
import Linkable from './cards/Linkable'
import Ssl from './cards/Ssl'
import Countdown from './cards/Countdown'
import WorldClock from './cards/WorldClock'
import BlockchainExchange from './cards/BlockchainExchange'
import Environment from './cards/Environment'
import Embed from './cards/Embed'
import Cache from './cards/Cache'
import Weather from './cards/Weather'
import Calendar from './cards/Calendar'
import NovaRelease from './cards/NovaRelease'
import Greeter from './cards/Greeter'

Nova.booting((Vue) => {
    Vue.component('LoadingCardWithButton', LoadingCardWithButton);
    //
    Vue.component('system-resources-card', SystemResources);
    Vue.component('versions-card', Versions);
    Vue.component('html-card', Html);
    Vue.component('scheduled-jobs-card', ScheduledJobs);
    Vue.component('percentage-card', Percentage);
    Vue.component('linkable-card', Linkable);
    Vue.component('ssl-card', Ssl);
    Vue.component('countdown-card', Countdown);
    Vue.component('world-clock-card', WorldClock);
    Vue.component('blockchain-exchange-card', BlockchainExchange);
    Vue.component('environment-card', Environment);
    Vue.component('embed-card', Embed);
    Vue.component('cache-card', Cache);
    Vue.component('weather-card', Weather);
    Vue.component('calendar-card', Calendar);
    Vue.component('nova-release-card', NovaRelease);
    Vue.component('greeter-card', Greeter);
});
