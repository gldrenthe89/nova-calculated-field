<template>
    <default-field :field="field" :errors="errors">
        <template slot="field">
            <input
                :id="field.name"
                :type="this.field.type"
                class="w-full form-control form-input form-input-bordered"
                :class="errorClasses"
                :placeholder="field.name"
                :step="field.step"
                :min="field.min"
                :max="field.max"
                :value="value"
                @input="setFieldAndMessage"
            />
        </template>
    </default-field>
</template>

<script>
import { FormField, HandlesValidationErrors } from 'laravel-nova'

export default {
    mixins: [FormField, HandlesValidationErrors],

    props: ['resourceName', 'resourceId', 'field'],

    methods: {
        setFieldAndMessage(el) {
            const rawValue = el.target.value;
            let parsedValue = rawValue;

            if (this.field.type === 'number') {
                parsedValue = Number(rawValue)
            }

            let attribute = this.field.attribute
            if (Array.isArray(this.field.broadcastTo)) {
              this.field.broadcastTo.forEach(function (broadcastChannel) {
                Nova.$emit(broadcastChannel, {
                  'field_name': attribute,
                  'value': parsedValue
                })
              });
            } else {
              Nova.$emit(this.field.broadcastTo, {
                'field_name': attribute,
                'value': parsedValue
              })
            }

            this.value = parsedValue;
        },

        /*
         * Set the initial, internal value for the field.
         */
        setInitialValue() {
            this.value = this.field.value || ''
        },

        /**
         * Fill the given FormData object with the field's internal value.
         */
        fill(formData) {
            formData.append(this.field.attribute, this.value || '')
        },

        /**
         * Update the field's internal value.
         */
        handleChange(value) {
            this.value = value
        },
    },
}
</script>
