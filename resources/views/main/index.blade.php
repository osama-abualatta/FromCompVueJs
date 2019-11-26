@extends('template.app')

@section('content')

<form-wrapper group="update-form" v-cloak>
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
                            'min:2':'minmum length: 2 char',
                            'max:30':'maximum length: 30 char'
                        }"
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
        </fieldset>
    </div>
</form-wrapper>

@endsection

@push('footer-scripts')
    <script src="//cdn.ckeditor.com/4.9.2/full/ckeditor.js"></script>
@endpush
