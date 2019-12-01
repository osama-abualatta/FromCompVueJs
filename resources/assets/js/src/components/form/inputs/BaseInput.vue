<script>
import Helper from "../../Validator/Error";
import Helper from "../../../core/Helper";
import Helper from "../../../mixins/Disabler";
import Helper from "../validator/validation";

export default {
    computed: {

        isInvalid() {
            return this.error.has(this.name);
        },
        showValidation() {
            return this.isInvalid && this.displayValidation;
        },
        computedValidationCssClass() {
            return {
                [this.validationCssClass]: this.isInvalid
            };
        },
        computedwrapperCssClass() {
            return [
                {
                    [this.wrapperErrorCssClass]: this.isInvalid
                },
                this.wrapperCssClass
            ]
        },
        computedValidationCssStyle() {
            return [
                {
                    [this.wrapperErrorCssStyle]: this.isInvalid
                },
                this.wrapperCssClass
            ]
        }
    },
    props: {
        group: {
            type: String,
            required: false
        },
        name: {
            type: String,
            required: false
        },
        id: {
            type: String,
            required: false
        },
        value: {
            default: ""
        },
        currentVlue: {
            default: ""
        },
        placeholder: {
            type: String,
            required: false
        },
        focus: {
            type: Boolean,
            default: false
        },
        maxlength: {
            type: String,
            required: false
        },
        autocomplete: {
            type: String,
            required: false
        },
        validation: {
            type: [Array, Object],
            default: () => []
        }
    },
    data() {
        return {
            identity: this.id ? this.id : this.name,
            displayValidation: false
        };
    },
};
</script>
