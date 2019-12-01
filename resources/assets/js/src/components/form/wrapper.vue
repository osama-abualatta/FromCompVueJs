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
    },
    methods: {
        submitEvent(data) {

        },
        initiallize(data) {
            if (!this.validationBag.hasOwnProperty(data.field)) {
                this.validationBag[data.field] = data.rules;
            }
        },
        reset(data) {

        },
        clear(data) {

        },
        submit() {
            this.validate()
                .then(this.makeCall)
                .catch(this.callFailed);
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
