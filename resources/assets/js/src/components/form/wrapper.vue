<template>
    <div>
        <form v-on:submit.prevent="submit" novalidate>
            <slot
                :group="group"
                :fields="fields"
                :validation="validationBag"
                :error="error"
                :submit="submit"
                :enable="enable"
                :disable="disable"
                :processing="processing"
                :isDisabled="isDisabled"
            ></slot>
        </form>
    </div>
</template>
<script>
import Behaviour from "./Behaviour";
import Error from "./validator/Error";
import Helper from "../../core/Helper";
import Disabler from "../../mixins/Disabler";
import Validator from "./validator/Validator";
import AjaxCaller from "../../mixins/AjaxCaller";
export default {
    mixins: [AjaxCaller, Disabler],
    props: {
        group: {
            type: String,
            required: false
        },
        behaviour: {
            type: String,
            required: false
        },
        eventSubmitOnly: {
            type: Boolean,
            default: false
        },
        collections: {
            type: Object,
            default: () => {
                return {};
            }
        }
    },
    data() {
        return {
            fields: {...this.collections},
            validationBag: {},
            error: new Error,
        };
    },
    computed: {
        requestData() {
            return this.fields;
        }
    },
    created() {
        EventBus.listen("submit-" + this.group, this.submitEvent);
        EventBus.listen("initialize-" + this.group, this.initiallize);
        EventBus.listen("reset-" + this.group, this.reset);
        EventBus.listen("clear-" + this.group, this.clear);
        EventBus.listen("disable-stared-" + this.group, this.disable);
        EventBus.listen("disable-ended-" + this.group, this.enable);
         EventBus.listen('remove-field-' + this.group,this.removeField);
    },
    mounted(){
        if(this.isDisabled){
            EventBus.fire('disable-started-' + this.group)
        }
    },
    methods: {
        startProcessingAjaxCallEvent(){
            EventBus.fire([
                'submission-started-'+ this.group,
                'disable-started-'+ this.group
            ]);
        },
         stoptProcessingAjaxCallEvent(){
            EventBus.fire([
                'submission-ended-'+ this.group,
                'disable-ended-'+ this.group
            ]);
        },
        initiallize(data) {
            if (!this.validationBag.hasOwnProperty(data.field)) {
                this.validationBag[data.field] = data.rules;
            }
        },
        disable(){
            this.clearNotification();
            Disabler.methods.disable.call(this);
        },

        reset() {
            if(this.isDisabled){
                return;
            }
            this.cleanse('reset-form');
        },
        clear() {
            if(this.isDisabled){
                return;
            }
              this.cleanse('clear-form');
        },
        cleanse(event){
            this.clearNotification();
            EventBus.fire(event + '-' + this.group);
        },
        clearNotification(){
            this.error.clear();
            EventBus.fire('clear-top-dialog')
        },
        removeField(field){
        Helper.removeObjectProperties(this,[field], this.fields);
        },
        submit() {
        if(this.eventSubmitOnly){
            return;
        }
        this.submitEvent();
        },
        submitEvent() {
        if(this.isDisabled){
            return;
        }
        this.validate().then(this.makeCall).catch(this.callFailed);
        },
        validate() {
            return new Promise((resolve, reject) => {
                if (!this.requiresValidation()) {
                    resolve();
                    return;
                }

                this.error = new Error();

                new Validator(this, resolve, reject);
            });
        },
        requiresValidation() {
            return Object.keys(this.validationBag).length > 0;
        },
        makeCall() {},
        callFailed() {}
    }
};
</script>
