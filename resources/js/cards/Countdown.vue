<template>
    <Card class="h-auto p-4">
        <Heading :level="3" class="flex items-center justify-between mb-2">
            {{ card.title || 'Countdown' }}
        </Heading>
        <p class="flex items-center text-4xl mb-4">
            {{ timeLeft }}
        </p>
        <div class="flex items-center">
            <p class="text-80 font-bold" v-if="card.label">
                <span>{{ card.label }}</span>
            </p>
        </div>
    </Card>
</template>

<script>
    export default {
        props: {
            card: {
                type: Object,
                required: true,
            },
        },

        data: () => ({
            timeLeft: '00:00:00',
            remainingTime: 0,
            seconds: 0,
            minutes: 0,
            hours: 0,
            days: 0,
        }),

        created() {
            this.remainingTime = this.card.to - new Date().getTime();
        },

        mounted() {
            if (this.remainingTime > 0)
                window.requestAnimationFrame(this.showTime);

            window.addEventListener('focus', () => {
                if (this.remainingTime < 1000) {
                    this.timeLeft = '00:00:00:00';
                    window.cancelAnimationFrame(this.showTime);
                }
            });
        },

        methods: {
            pad(value) {
                return ('0' + Math.floor(value)).slice(-2);
            },

            showTime() {
                this.remainingTime = this.card.to - new Date().getTime();
                this.seconds = this.pad((this.remainingTime % (1000 * 60)) / 1000);
                this.minutes = this.pad((this.remainingTime % (1000 * 60 * 60)) / (1000 * 60));
                this.hours = this.pad((this.remainingTime % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                this.days = this.pad(this.remainingTime / (1000 * 60 * 60 * 24));
                // ensure clock only updates if a second or more is remaining
                if (this.remainingTime >= 1000) {
                    this.timeLeft = `${this.days}:${this.hours}:${this.minutes}:${this.seconds}`;
                    window.requestAnimationFrame(this.showTime);
                } else {
                    window.cancelAnimationFrame(this.showTime);
                    this.timeLeft = '00:00:00:00';
                }
            }
        }
    }
</script>
