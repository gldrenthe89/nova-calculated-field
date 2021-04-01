<?php


namespace Gldrenthe89\NovaCalculatedField\Traits;


use Laravel\Nova\Http\Requests\NovaRequest;

trait CanDisableCalculationOnUpdateTrait
{
    /**
     * Ability to disable calculation on update form
     *
     * @var bool
     */
    public $disableOnUpdate = false;

    /*
     * Function to disable calculation on update form
     */
    public function disableCalculationOnUpdate($bool = true) {
        $this->disableOnUpdate = $bool;
        return $this;
    }
}