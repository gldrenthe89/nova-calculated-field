<template>
  <default-field :field="field" :errors="errors" :show-help-text="showHelpText">
    <template slot="field">
      <div class="flex items-center">
        <date-time-picker
          class="w-full form-control form-input form-input-bordered"
          ref="dateTimePicker"
          :dusk="field.attribute"
          :name="field.name"
          :value="value"
          :dateFormat="pickerFormat"
          :alt-format="pickerDisplayFormat"
          :placeholder="placeholder"
          :enable-time="false"
          :enable-seconds="false"
          :first-day-of-week="firstDayOfWeek"
          :class="errorClasses"
          @change="setFieldAndMessage"
          :disabled="isReadonly"
        />

        <a
          v-if="field.nullable"
          @click.prevent="$refs.dateTimePicker.clear()"
          href="#"
          :title="__('Clear value')"
          tabindex="-1"
          class="p-1 px-2 cursor-pointer leading-none focus:outline-none"
          :class="{
            'text-50': !value.length,
            'text-black hover:text-danger': value.length,
          }"
        >
          <icon type="x-circle" width="22" height="22" viewBox="0 0 22 22" />
        </a>
      </div>
    </template>
  </default-field>
</template>

<script>
import {
  FormField,
  HandlesValidationErrors,
  InteractsWithDates,
} from 'laravel-nova'

export default {
  mixins: [HandlesValidationErrors, FormField, InteractsWithDates],

  props: ['resourceName', 'resourceId', 'field'],

  methods: {
    setFieldAndMessage(value) {
      let parsedValue = value;

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

    /**
     * Update the field's internal value when it's value changes
     */
    handleChange(value) {
      this.value = value;
    },
  },

  computed: {
    firstDayOfWeek() {
      return this.field.firstDayOfWeek || 0
    },

    placeholder() {
      return this.field.placeholder || moment().format(this.format)
    },

    format() {
      return this.field.format || 'YYYY-MM-DD'
    },

    pickerFormat() {
      return this.field.pickerFormat || 'Y-m-d'
    },

    pickerDisplayFormat() {
      return this.field.pickerDisplayFormat || 'Y-m-d'
    },
  },
}
</script>
