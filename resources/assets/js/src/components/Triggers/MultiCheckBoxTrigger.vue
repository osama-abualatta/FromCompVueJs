<script>
import Trigger from "./Trigger";
import Behaviour from "./Behaviour";
import AjaxCaller from "../../mixins/AjaxCaller";
import MultiHandler from "../../mixins/MultiHandler";
import Behaviour from '../form/Behaviour';
export default {
    mixins:[Trigger,AjaxCaller,MultiHandler],
    props:{
        behaviour:{
            type : String,
            required : false
        },
        listen:{
            type: String,
            required : false
             }
    },
    computed:{
        requestData(){
            return {items :this.items};
        }
    },
    methods:{
        evaluate(){
            this.isDisabled =this.items.length ===0;
        },
        trigger(){
            if(Behaviour.isNotAjax(this.behaviour)){
                Behaviour[this.behaviour](this , this.items);
                return ;
            }
            this.makeAjaxCal(this.callSuccessful,this.calFailed);
        },
        startProcessingAjaxCallEvent(){
            EventBus.fire('disable-start-' + this.group);
        },
             stopProcessingAjaxCallEvent(){
            EventBus.fire('disable-ended-' + this.group);
        },
        callSuccessful(response){
            try{
Behaviour[this.behaviour ? this.behaviour:response.data.behaviour](this,response);
            }catch(error){
                ErrorHandler.showError({
                    message: "Invalid form behaviour '" +
                    response.data.behaviour +"'"
                });
                this.stopProcessingAjaxCall();
            }

        },
        calFailed(error){
ErrorHandler.showError(error, this.stopProcessingAjaxCall);
        }

    }

}
</script>
