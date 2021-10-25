<template>
  <default-field :field="field" :errors="errors" :show-help-text="showHelpText">
    <template slot="field">
      <div class="flex">
        <input
            class="w-full form-control form-input form-input-bordered"
            @input="handleChange"
            :value="value"
            :id="field.attribute"
            :dusk="field.attribute"
            v-bind="extraAttributes"
            :step="field.step"
            :disabled="isReadonly"
            :list="`${field.attribute}-list`"
        />

        <datalist
            v-if="field.suggestions && field.suggestions.length > 0"
            :id="`${field.attribute}-list`"
        >
          <option
              :key="suggestion"
              v-for="suggestion in field.suggestions"
              :value="suggestion"
          />
        </datalist>
          <input type="button"
                 v-if="this.field.buttonVisible"
                 class="btn btn-default btn-primary ml-3 cursor-pointer"
                 value="Calculate" :id="field.attribute.concat('CalculateButton')"
                 v-on:click="calculateValue(true);">
      </div>
    </template>
  </default-field>
</template>

<script>
import { FormField, HandlesValidationErrors } from 'laravel-nova'

export default {
  mixins: [HandlesValidationErrors, FormField],

  created() {
    Nova.$on(this.field.listensTo, this.messageReceived)
  },

  data: () => ({
    calculating: false,
    field_values: {}
  }),

  methods: {
    messageReceived(message) {
      this.field_values[message.field_name] = message.value;
      this.calculateValue()
    },

    broadCastAgain() {
      console.log(this.field.broadcastTo);
      if(this.field.broadcastTo == null) return;
      let attribute = this.field.attribute
      Nova.$emit(this.field.broadcastTo, {
        'field_name': attribute,
        'value': this.value
      })
    },

    calculateValue: _.debounce(function (force = false) {
      this.calculating = true;

      Nova.request().post(
          `/gldrenthe89/nova-calculated-field/calculate/${this.resourceName}/${this.field.attribute}`,
          this.field_values
      ).then((response) => {
        if (
            !(response.data.disabled && this.field.isUpdating)
            ||
            force
        ) {
          console.log("inside if");
          this.value = response.data.value
          this.broadCastAgain();
        }
        console.log("outside if");
        this.calculating = false;
      }).catch(() => {
        this.calculating = false;
      });
    }, 500),

    showButton() {
      return false;
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

    computed: {
      defaultAttributes() {
        return {
          type: this.field.type || 'text',
          min: this.field.min,
          max: this.field.max,
          step: this.field.step,
          pattern: this.field.pattern,
          placeholder: this.field.placeholder || this.field.name,
          class: this.errorClasses,
        }
      },

      extraAttributes() {
        const attrs = this.field.extraAttributes

        return {
          // Leave the default attributes even though we can now specify
          // whatever attributes we like because the old number field still
          // uses the old field attributes
          ...this.defaultAttributes,
          ...attrs,
        }
      },
    },
  },
}
</script>
