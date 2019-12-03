<template>

<div v-show="show" class="checkedbox-group-item"
:class="computedWarpperCssClass"
 :style="computedWrapperCssStyle">
<input
type="checkbox"
:id="identity"
:name="name"
:disabled="isDisabled"
:autocomplete="autocomplete"
:class="inputCssClass"
v-model="checked"
@change="update"
>
<slot>
   <validation
   :label="label"
   :id="identity"
   :name="name"
   :show="showValidation"
    :css-class="computedValidationCssClass"
    :validation="error"
   ></validation>
</slot>
</div>

</template>

<script>
import BaseInput from "../../BaseInput";
export default {
mixins :[BaseInput],
props:{

    removeWhenFalse:{
        type:Boolean,
        default:false
    },
    trueValue:{
        default:true
    },
    falseValue: {
        default:false
    }
},
    data(){
        return {
            checked:this.isSelected()
        }
    },
    conputed:{
        valueToEmit(){
         return this.checked ? this.trueValue : this.falseValue;
        }
    },
    mounted(){
        this.update();
        this.initialize();
        this.registerListeners();
        this.registerCustomListener();
    },
    methods:{
        registerCustomListener(){
            if(this.listen){
                EventBus.listen(this.listen,checked => {
                    this.checked= checked;
                    this.emitFireEvent();
                });
            }
        },
        emitFireEvent(){
            BaseInput.methods.emitFireEvent.call(this, {
            value: this.trueValue,
            remove : !this.checked
            });
            this.$emit('input',this.valueToEmit);
        },
        isSelected(){
            return this.currentVlaue===this.trueValue;
        },
        update(){
if(!this.checked &&this.removeWhenFalse){
    EventBus.fire('remove-field-' + this.group,this.name);
    return;
}
    this.emit(this.valueToEmit);
        },
        reset() {
           this.checked=this.isSelected();
           this.update();
        },
        clear() {
            this.checked=false;
           this.update();
        }
    }

}
</script>
