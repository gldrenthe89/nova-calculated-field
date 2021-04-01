<?php

namespace Gldrenthe89\NovaCalculatedField;

use Laravel\Nova\Element;
use Laravel\Nova\Fields\Field;

class BroadcasterDateField extends Field
{
    /**
     * The field's component.
     *
     * @var string
     */
    public $component = 'broadcaster-date-field';

    /**
     * The type of the field to show on the form
     * @var string
     */
    public $type = 'number';

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
            'broadcastTo' => 'broadcast-field-input'
        ]);
    }

    /**
     * Set the type of the field (string, number)
     *
     * @param $type
     * @return Element
     */
    public function setType($type) : Element
    {
        return $this->withMeta([
            'type' => $type
        ]);
    }

    /**
     * Tells the client side component which channel to broadcast on
     * @param array|string $broadcastChannel
     * @return Element
     */
    public function broadcastTo($broadcastChannel) : Element
    {
        return $this->withMeta([
            'broadcastTo' => $broadcastChannel
        ]);
    }
}
