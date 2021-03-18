<?php

namespace Gldrenthe89\NovaCalculatedField;

use Laravel\Nova\Element;
use Laravel\Nova\Fields\MorphTo;

class BroadcasterMorphToField extends MorphTo
{
    /**
     * The field's component.
     *
     * @var string
     */
    public $component = 'broadcaster-morph-to-field';

    /**
     * BroadcasterField constructor.
     *
     * @param $name
     * @param null $attribute
     */
    public function __construct($name, $attribute = null)
    {
        parent::__construct($name, $attribute);

        $this->withMeta([
            'broadcastTo' => 'broadcast-field-input'
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
