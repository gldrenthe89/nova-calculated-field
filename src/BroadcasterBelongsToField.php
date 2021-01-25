<?php

namespace Gldrenthe89\NovaCalculatedField;

use Laravel\Nova\Element;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Field;
use Laravel\Nova\Fields\ResourceRelationshipGuesser;

class BroadcasterBelongsToField extends BelongsTo
{

    /**
     * The field's component.
     *
     * @var string
     */
    public $component = 'broadcaster-belongsto-field';

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
    public function __construct($name, $attribute = null, $resource = null)
    {
        parent::__construct($name, $attribute, $resource);

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
     *
     * @param string|array $broadcastChannel
     * @return Element
     */
    public function broadcastTo($broadcastChannel) : Element
    {
        return $this->withMeta([
            'broadcastTo' => $broadcastChannel
        ]);
    }
}
