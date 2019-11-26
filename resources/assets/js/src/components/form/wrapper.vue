<template>
    <form v-on:submit.prevent="submit" novalidate>
        <slot
            :group="group"
            :fields="fields"
            :validation="validationBag"
            :error="error"
            :submit="submit"
        ></slot>
    </form>
</template>
<script>
import  Error  from "./validator/Error";
import  Validator  from "./validator/Validator";
import  Rule  from "./validator/Rule";
export default {
    props: {
        group: {
            type: String,
            required: false
        },
        behaviour: {
            type: String,
            required: false
        }
    },
    data() {
        return {
            fields: {},
            validationBag: {},
            error: new Error
        };
    },
    created() {
        EventBus.listen("initialize-" + this.group, this.initiallize);
    },
    methods: {
        initiallize(data) {
            if (!this.validationBag.hasOwnProperty(data.field)) {
                this.validationBag[data.field] = data.rules;
            }
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

                this.error = new Error;

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
