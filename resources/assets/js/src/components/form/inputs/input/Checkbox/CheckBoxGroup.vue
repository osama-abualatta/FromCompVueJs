<template>
    <div v-show="show" :class="computedWrapperCssClass" :style="computedWrapperCssStyle">
        <div v-for="option in options" :key="option.value" class="checkedbox-group-item">
            <input
            type="checkbox"
            :id="option_id =optionId(option)"
            :name="name"
            :disabled="isDisabled"
            :autocomplete="autocomplete"
            :value="option.value"
            :checked="isSelected(option.value)"
            :class="inputCssClass"
            @change="update"
            >
            <label :for="option_id" v-text="option.name"></label>
        </div>
    </div>
</template>
<script>
import MultiSelectINput from "../../MultiSelectInput";
export default {
    mixins:[MultiSelectINput],
    mounted(){
        if(this.selected){
            this.emit(this.selected);
        }
        this.initialize();
        this.registerListeners();
    },
    methods:{
        update(event){
            const value =event.target.value;
            if(this.isSelected(value)){
                this.selected=this.selected.filter(Element => Element !== value);
            }
            else{
                this.selected.push(value);
            }
            this.emit(this.selected);
        }
    }
}
</script>
