<template>
    <span :class="cssClass"  @click="trigger">
        <slot name="label-on" v-if="!processing">
            <i class="fas fa-check fa-fw"></i> SUBMIT
        </slot>
        <slot name="label-off" v-if="processing">
            <i class="fas fa-spinner fa-spin fa-fw"></i> PROCESSING
        </slot>
    </span>
</template>
<script>
import Disabler from "../../mixins/Disabler";
export default {
 mixins: [Disabler],
    props: {
        group: {
            type: String,
            required: true
        },
        isSubmit: {
            type: Boolean,
            default: false
        },
        name: {
            type: String,
            default: "items"
        },

        restingCssClass: {
            type: String,
            default: "button"
        },

        workingCssClass: {
            type: String,
            required: false
        }
    },
    data() {
        return {
            processing: false
        };
    },
    computed: {
        cssClass() {
            if (this.processing) {
                return [
                    this.workingCssClass
                    ||
                     this.restingCssClass,
                    "disabled"
                ];
            }
            return [
                this.restingCssClass,
                {
                    disabled: this.isDisabled
                }
            ];
        }
    },
    created() {
        EventBus.listen("disable-started-" + this.group, this.disable);
        EventBus.listen("disable-ended-" + this.group, this.enable);
    },
    methods: {
        trigger() {
            console.log("please implement trigger methods");
        }
    }
};
</script>
