Vue.component('top-dialog',require('./src/components/Dialogs/TopDialog').default);

Vue.component('form-wrapper',require('./src/components/form/wrapper').default);
Vue.component('validation',require('./src/components/form/Validator/Validator').default);
Vue.component('form-trigger',require('./src/components/Triggers/FormTrigger').default);

Vue.component('date-input',require('./src/components/form/inputs/input/Date').default);
Vue.component('datetime-input',require('./src/components/form/inputs/input/DateTime').default);
Vue.component('email-input',require('./src/components/form/inputs/input/Email').default);
Vue.component('hidden-input',require('./src/components/form/inputs/input/Hidden').default);
Vue.component('number-input',require('./src/components/form/inputs/input/Number').default);
Vue.component('password-input',require('./src/components/form/inputs/input/Password').default);
Vue.component('text-input',require('./src/components/form/inputs/input/Text').default);
Vue.component('time-input',require('./src/components/form/inputs/input/Time').default);

Vue.component('checkbox-input',require('./src/components/form/inputs/input/CheckBox/CheckBox').default);
Vue.component('checkbox-group-input',require('./src/components/form/inputs/input/CheckBox/CheckBoxGroup').default);
Vue.component('master-checkbox-input',require('./src/components/form/inputs/input/CheckBox/MasterCheckBox').default);
