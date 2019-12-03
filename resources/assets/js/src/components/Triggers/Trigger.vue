
<script>
import Disabler from "../../mixins/Disabler";
import Processor from "../../mixins/Processor";
export default {
 mixins: [Disabler,Processor],
    props: {
        group: {
            type: String,
            required: true
        },

        name: {
            type: String,
            default: "items"
        }
       },

    created() {
        EventBus.listen("disable-started-" + this.group, this.disable);
        EventBus.listen("disable-ended-" + this.group, this.enable);
    },
    methods: {
        conditionalTrigger(){
            if(this.isDisabled){
                return;
            }
            this.trigger();
        },
        trigger() {
            console.log("please implement trigger methods");
        }
    },
    render(){
        return this.$scopedSlots.default({
            disabled : this.isDisabled,
            processing: this.processing,
            trigger : this.conditionalTrigger
        });
    }
}
</script>
