<?php

namespace Gldrenthe89\NovaCalculatedField;

use Laravel\Nova\Element;
use Laravel\Nova\Fields\Field;

class BroadcasterField extends Field
{
    /**
     * The field's component.
     *
     * @var string
     */
    public $component = 'broadcaster-field';

    /**
     * The type of the field to show on the form
     * @var string
     */
    public $type = 'number';
    public $step = 'any';

    /**
     * BroadcasterField constructor.
     *
     * @param $name
     * @param null $attribute
     * @param callable|null $resolveCallback
     */
    public function __construct($name, $attribute = null, callable $resolveCallback = null)
    {
        parent::__construct($name, $attribute, $resolveCallback);

        $this->withMeta([
            'type' => 'number',
            'broadcastTo' => 'broadcast-field-input',
            'step' => 'any'
        ]);
    }


    /**
     * The minimum value that can be assigned to the field.
     *
     * @param  mixed  $min
     * @return $this
     */
    public function min($min)
    {
        return $this->withMeta(['min' => $min]);
    }

    /**
     * The maximum value that can be assigned to the field.
     *
     * @param  mixed  $max
     * @return $this
     */
    public function max($max)
    {
        return $this->withMeta(['max' => $max]);
    }

    /**
     * Set the type of the field (string, number)
     *
     * @param $type
     * @return Element
     */
    public function setType($type): Element
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Allows us to set the step attribute on the input broadcaster field
     * @param $value
     * @return Element
     */
    public function setStep($value): Element
    {
        $this->step = $value;

        return $this;
    }

    /**
     * Tells the client side component which channel to broadcast on
     * @param array|string $broadcastChannel
     * @return Element
     */
    public function broadcastTo($broadcastChannel): Element
    {
        return $this->withMeta([
            'broadcastTo' => $broadcastChannel
        ]);
    }
}
