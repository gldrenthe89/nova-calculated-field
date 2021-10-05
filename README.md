This packages is created after the package from [codebykyle](https://github.com/codebykyle/calculated-field) But after an extensive refactor and updating a lot of VueJS code to the latest Laravel Nova code I made this in to a new package.

# New features

[Release V2.3]<br>
-- Fixed issue where you can't edit a listener field <br>
-- Added Date Broadcaster field <br>
-- Added Date Listener field <br>
-- Added 'calculate' buttons to all visible Listener Fields <br>
-- Added ability to turn of calculation on update forms. <br>

[changes up to V2.2]<br>
-- BelongsTo Broadcaster field <br>
-- MorphTo Broadcaster field <br>
-- Currency Listener Field <br>
-- Hidden Listener Field <br>
-- Code has been completely updated to latest Nova (2021-03-18) <br>

Below pieces of the old Documentation from [codebykyle](https://github.com/codebykyle)
I'm not really good at writing documentation. So please feel free to creat a PR for it.

# Installation

Install the package via composer:

`composer require gldrenthe89/nova-calculated-field`


## Example

![Calculated Number Field](https://cbk-website.s3.amazonaws.com/calculated-field/number_calc_field.gif "Calculated Number Field")

```php

<?php
use Gldrenthe89\NovaCalculatedField\BroadcasterField;
use Gldrenthe89\NovaCalculatedField\ListenerField;

class MyResource extends Resource
{
    public function fields(Request $request) {
        return [    
            BroadcasterField::make('Sub Total', 'sub_total')
                ->broadcastTo('total'), // can either be a String or an Array

            BroadcasterField::make('Tax', 'tax')
                ->broadcastTo('total'), // can either be a String or an Array

            ListenerField::make('Total Field', 'total_field')
                ->listensTo('total') // can either be a String or an Array
                ->calculateWith(function (Collection $values) {
                    $subtotal = $values->get('sub_total');
                    $tax = $values->get('tax');
                    return $subtotal + $tax;
                }),


            BroadcasterField::make('Senior Discount', 'senior_discount')
                ->broadcastTo('discount'), // can either be a String or an Array
    
            BroadcasterField::make('Coupon Discount', 'coupon_amount')
                ->broadcastTo('discount'), // can either be a String or an Array
    
            ListenerField::make('Total Discount', 'total_discount')
                ->listensTo('discount') // can either be a String or an Array
                ->disableCalculationOnUpdate() // Only when to disable on Update forms
                ->calculateWith(function (Collection $values) {
                    $seniorDiscount = $values->get('senior_discount');
                    $couponAmount = $values->get('coupon_amount');
    
                    return $seniorDiscount + $couponAmount;
                })
        ];
    }
}
```
