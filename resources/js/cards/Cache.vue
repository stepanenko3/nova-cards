<template>
    <div class="flex-grow flex flex-col">
        <LoadingCardWithButton
            :heading="card.title || (card.defaultDriver + ' ' + __('Cache'))"
            class="flex-grow flex flex-col"
            owerflowClass="flex-grow flex flex-col"
            :card="card"
            :loading="loading"
            :loadingType="loadingType"
            :polling="polling"
            @update:polling="polling = $event"
            @refresh="fetch('button')"
        >
            <div class="mb-3 flex-grow">
                <template v-if="cacheSize">
                    {{ __('Cache Size') }}: <code>{{ cacheSize }}</code>
                </template>
            </div>

            <div class="mt-auto flex items-center">
                <DefaultButton class="mr-2 flex-grow" @click="isGetModalOpen = true">
                    {{ __('Get') }}
                </DefaultButton>

                <DangerButton class="mr-2 flex-grow" @click="isForgetModalOpen = true">
                    {{ __('Forget') }}
                </DangerButton>

                <DangerButton class="flex-grow" @click="isFlushModalOpen = true">
                    {{ __('Flush') }}
                </DangerButton>
            </div>
        </LoadingCardWithButton>

        <Modal
            :show="isFlushModalOpen"
            @closing="handleClose"
            @close-via-escapeclose="handleClose"
        >
            <div class="mx-auto bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden">
                <ModalHeader v-text="__('Flush Cache')" />

                <div class="p-6">
                    <p>
                        {{ __('Are you sure you want to flush the cache?') }}
                    </p>
                </div>

                <ModalFooter>
                    <div class="flex items-center ml-auto">
                        <CancelButton
                            component="button"
                            type="button"
                            dusk="cancel-action-button"
                            class="ml-auto mr-3"
                            @click.prevent="handleClose"
                        />

                        <DefaultButton
                            ref="confirmButton"
                            type="submit"
                            dusk="confirm-button"
                            @click.prevent="onFlush"
                        >
                            {{ __('Flush') }}
                        </DefaultButton>
                    </div>
                </ModalFooter>
            </div>
        </Modal>

        <Modal
            :show="isGetModalOpen"
            @closing="handleClose"
            @close-via-escapeclose="handleClose"
        >
            <div class="mx-auto bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden">
                <ModalHeader v-text="__('Get Cache Key')" />

                <div class="p-6">
                    <p class="mb-3">
                        {{ __('Provide the cache key you would like to retrieve?') }}
                    </p>

                    <input
                        type="text"
                        class="w-full h-full form-control form-input form-input-bordered py-3"
                        :placeholder="__('Cache key...')"
                        v-model="cacheKey"
                        autofocus
                        required
                    />
                </div>

                <ModalFooter>
                    <div class="flex items-center ml-auto">
                        <CancelButton
                            component="button"
                            type="button"
                            dusk="cancel-action-button"
                            class="ml-auto mr-3"
                            @click.prevent="handleClose"
                        />

                        <DefaultButton
                            ref="confirmButton"
                            type="submit"
                            dusk="confirm-button"
                            @click.prevent="onGet"
                        >
                            {{ __('Get') }}
                        </DefaultButton>
                    </div>
                </ModalFooter>
            </div>
        </Modal>

        <Modal
            :show="isForgetModalOpen"
            @closing="handleClose"
            @close-via-escapeclose="handleClose"
        >
            <div class="mx-auto bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden">
                <ModalHeader v-text="__('Forget Cache Key')" />

                <div class="p-6">
                    <p class="mb-3">
                        {{ __('Provide the cache key you would like to forget?') }}
                    </p>

                    <input
                        type="text"
                        class="w-full h-full form-control form-input form-input-bordered py-3"
                        :placeholder="__('Cache key...')"
                        v-model="cacheKey"
                        autofocus
                        required
                    />
                </div>

                <ModalFooter>
                    <div class="flex items-center ml-auto">
                        <CancelButton
                            component="button"
                            type="button"
                            dusk="cancel-action-button"
                            class="ml-auto mr-3"
                            @click.prevent="handleClose"
                        />

                        <DefaultButton
                            ref="confirmButton"
                            type="submit"
                            dusk="confirm-button"
                            @click.prevent="onForget"
                        >
                            {{ __('Forget') }}
                        </DefaultButton>
                    </div>
                </ModalFooter>
            </div>
        </Modal>

        <Modal
            :show="isViewModalOpen"
            maxWidth="screen-md"
            @closing="onViewClose"
            @close-via-escapeclose="onViewClose"
        >
            <div class="mx-auto bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden">
                <ModalHeader v-text="cacheKey" />

                <div class="p-6">
                    <textarea
                        class="w-full form-control form-input form-input-bordered py-3 h-auto"
                        style="height: 500px"
                        readonly
                    >{{ cacheValue }}</textarea>
                </div>

                <ModalFooter>
                    <div class="flex items-center ml-auto">
                        <CancelButton
                            component="button"
                            type="button"
                            dusk="cancel-action-button"
                            class="ml-auto mr-3"
                            @click.prevent="onViewClose"
                        />
                    </div>
                </ModalFooter>
            </div>
        </Modal>
    </div>
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
            isFlushModalOpen: false,
            isForgetModalOpen: false,
            isGetModalOpen: false,
            isViewModalOpen: false,
            cacheKey: '',
            cacheValue: '',
            cacheSize: '',
        }),

        methods: {
            endpoint() {
                return Nova.request().get('/nova-vendor/stepanenko3/nova-cards/cache/load');
            },

            success(data) {
                this.cacheKey = data.key;
                this.cacheValue = data.value;
                this.cacheSize = data.size;
            },

            onFlush() {
                Nova.request().post('/nova-vendor/stepanenko3/nova-cards/cache/flush').then(response => {
                    if (!response.data.success) {
                        Nova.error(this.__('There was an issue flushing the cache!'));
                    } else {
                        Nova.success(this.__('Successfully flushed the cache!'));
                    }
                    this.cacheSize = response.data.size;
                });

                this.isFlushModalOpen = false;
            },

            onForget() {
                Nova.request()
                    .post('/nova-vendor/stepanenko3/nova-cards/cache', {
                        params: {
                            cacheKey: this.cacheKey,
                        },
                    })
                    .then(response => {
                        if (!response.data.success) {
                            this.toastInvalidCacheKey(response.data.key);
                        } else {
                            Nova.success(this.__(
                                'Successfully forgot the cache value associated with key: <strong class="ml-2">:key</strong>',
                                { key: response.data.key },
                            ));
                        }
                        this.cacheSize = response.data.size;
                    });

                this.isForgetModalOpen = false;
            },

            onGet() {
                Nova.request()
                    .get('/nova-vendor/stepanenko3/nova-cards/cache', {
                        params: {
                            cacheKey: this.cacheKey,
                        },
                    })
                    .then(response => {
                        if (!response.data.success) {
                            this.toastInvalidCacheKey(response.data.key);
                        } else {
                            this.cacheValue = response.data.value;
                            this.cacheKey = response.data.key;
                            this.isViewModalOpen = true;
                        }
                        this.cacheSize = response.data.size;
                    });

                this.isGetModalOpen = false;
            },

            handleClose() {
                this.isFlushModalOpen = false;
                this.isForgetModalOpen = false;
                this.isGetModalOpen = false;
                this.isViewModalOpen = false;
            },

            onViewClose() {
                this.isViewModalOpen = false;
                this.cacheKey = '';
                this.cacheValue = '';
            },

            toastInvalidCacheKey(key) {
                Nova.danger(this.__('There is nothing cached for key: <strong class="ml-2">:key</strong>', { key }));
            },
        },
    }
</script>
