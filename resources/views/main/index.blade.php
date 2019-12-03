@extends('template.app')

@section('content')


@include('template.partials.form-buttons-detached',['group' => "update-form"])

<form-wrapper group="update-form"
group="update-form"
action="{{ route('main.store') }}"
:collections="{ address: {}, colours: [], fruit: [] }"
behaviour="confirmWithDialogAndClear"
v-cloak>
    <div slot-scope="props">
        <fieldset class="fieldset">
            <legend>Personal Details</legend>
            <div class="grid-x grid-margin-x">
                <div class="cell small-12 medium-6">
                    <text-input
                        :group="props.group"
                        name="first_name"
                        v-model="props.fields.first_name"
                        :focus="true"
                        placeholder="first name"
                        maxlength="9"
                        autocomplete="given-name"
                        :validation="{
                            'required':'please provide your first name',
                            'min:2':'minmum length: 2 char',
                            'max:30':'maximum length: 30 char'
                        }"
                        :error="props.error"
                        current-value="Sebastian"
                        :disabled="props.isDisabled"
                        class="test-class"
                   > </text-input>
                </div>
                <div class="cell small-12 medium-6">
                        <text-input
                            :group="props.group"
                            name="last_name"
                            v-model="props.fields.last_name"
                           placeholder="last name"
                            maxlength="9"
                            autocomplete="given-name"
                            :validation="['min:2','max:30']"
                       > </text-input>
            </div>
            <div class="cell small-12 medium-6">
                    <number-input
                        :group="props.group"
                        name="phone_number"
                        v-model="props.fields.phone_number"
                        placeholder="phone number"
                        maxlength="9"
                        :validation="['min:2','max:30']"
                   > </number-input>

        <div class="cell small-12 medium-6">
                <password-input
                    :group="props.group"
                    name="password"
                    v-model="props.fields.password"
                    placeholder="password"
                    maxlength="9"
                    :validation="['min:2','max:30']"
               > </password-input>
    </div>
</fieldset>
    <fieldset class="fieldset">
    <legend>Consents</legend>
    <div class="checked-group">
        <checkbox-input
        :group="props.group"
        name="share"
        label="please share my data with thrid party"
        v-model="props.fields.share"
        :validation="{
            'required' : 'Invalid selected',
            'in:a':  'we have to share your data'
        }"
        :error="props.error"
        current-value="a"
        true-value="a"
        false-value="b"
        validation-css-class="block"
        ></checkbox-input>
        <checkbox-input
        :group="props.group"
        name="privacy"
        label="i agree with the privacy policy"
        v-model="props.fields.privacy"
        :validation="{
            'required' : 'you have to agree with our privacy policy'
                     }"
        :error="props.error"
        :remove-when-false="true"
        validation-css-class="block"
        ></checkbox-input>
        <checkbox-input
        :group="props.group"
        name="terms"
        label="I agree with the terms & conditions"
        v-model="props.fields.terms"
        :validation="{
            'accepted' : 'you have to agree our terms & conditions'
        }"
        :error="props.error"
         validation-css-class="block"
        ></checkbox-input>

    </div>
        </fieldset>

     <!--<fieldset class="fieldset">
                <legend>Colours (exactly 2 items)</legend>

                    <validation
                    :id="colours"
                    name="colours"
                    :show="props.error.has('colours')"
                    :validation="{
                        'required' : 'please select exactly 2 items',
                        'min:2' : 'please select exactly 2 items',
                        'max:2' : 'please select exactly 2 items'
                    }"
                    :error="props.error"
                    css-class="block"
                    ></validation>
                    <checkbox-group-input
                    :group="props.group"
                    name="colours"
                    current-value="['blue']"
                    :options="[
                        {name:'Blue',value:'blue'}, {name:'Green',value:'green'}, {name:'Orange',value:'orange'}
                    ]"
                    v-model="props.fields.colours"
                    :validation="['required','min:2','max:2']"
                    :error="props.error"

                    ></checkbox-group-input>

                    </fieldset>-->

                    @include('template.partials.form-buttons-attached')
                </div>
    </div>
</form-wrapper>

@endsection

@push('footer-scripts')
    <script src="//cdn.ckeditor.com/4.9.2/full/ckeditor.js"></script>
@endpush
