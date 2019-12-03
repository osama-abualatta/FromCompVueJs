<template>
    <input
        :type="type"
        :id="identity"
        :name="name"
        :value="value"
        :maxlength="maxlength"
        :placeholder="placeholder"
        :autocomplete="autocomplete"
        v-focus="focus"
        v-on="inputListeners"
    />
</template>
<script>
import Helper from "../../../../core/Helper";
import BaseInput from "../BaseInput";
export default {
    mixins:[BaseInput ],
    data(){
        return {
            type:'text'
        }
    },
    computed: {
        inputListeners() {
            return Object.assign({}, this.listeners, {
                input: event => {
                    this.emit(event.target.value);
                }
            });
        }

    },

    mounted() {
        this.emit(this.currentVlue);
        this.initialize();
        this.registerListeners();
    },
    methods: {

        reset(){
            this.emit(this.currentVlue);
        },
        clear(){
            this.emit('');
        }
    }
       , watch: {
            disabled(isDissabled) {
                if (isDisabled) {
                    this.disabled();
                } else {
                    this.enable();
                }
            }
        }
};
</script>
