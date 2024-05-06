import '../css/card.css'

import Card from './components/Card.vue'
import WorldClockTimer from './components/WorldClockTimer.vue'
//
import SystemResources from './cards/SystemResources.vue'
import Versions from './cards/Versions.vue'
import Html from './cards/Html.vue'
import ScheduledJobs from './cards/ScheduledJobs.vue'
import Percentage from './cards/Percentage.vue'
import Linkable from './cards/Linkable.vue'
import Ssl from './cards/Ssl.vue'
import Countdown from './cards/Countdown.vue'
import WorldClock from './cards/WorldClock.vue'
import Environment from './cards/Environment.vue'
import Embed from './cards/Embed.vue'
import Weather from './cards/Weather.vue'
import Calendar from './cards/Calendar.vue'
import Greeter from './cards/Greeter.vue'
import ToolbarButton from './components/ToolbarButton.vue'

Nova.booting((Vue) => {
    Vue.component('NovaCardsCard', Card);
    Vue.component('NovaCardsToolbarButton', ToolbarButton);
    Vue.component('WorldClockTimer', WorldClockTimer);
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
    Vue.component('environment-card', Environment);
    Vue.component('embed-card', Embed);
    Vue.component('cache-card', Cache);
    Vue.component('weather-card', Weather);
    Vue.component('calendar-card', Calendar);
    Vue.component('greeter-card', Greeter);
});
