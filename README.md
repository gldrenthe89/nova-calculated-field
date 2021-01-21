This packages was originaly created by [codebykyle](https://github.com/codebykyle/calculated-field) But after an extensive refactor and updating a lot of VueJS code to latest Laravel Nova code i made this in to a new package.

## Installation

Install the package via composer:

`composer require gldrenthe89/nove-calculated-field`

In your composer add teh following:

```
{
"type": "vcs",
"url": "https://github.com/gldrenthe89/nova-calculated-field"
},
```

###The README gets an update in the future
added features:
-- select broadcaster field
-- belongsto broadcaster field
-- ability to broadcast to multiple channels
-- updated Vue components to reflect recent Nova added features


# Original how-to from codebykyle

### Example
For example:
#### As a number
![Calculated Number Field](https://cbk-website.s3.amazonaws.com/calculated-field/number_calc_field.gif "Calculated Number Field")

#### As a string:
![Calculated String Field](https://cbk-website.s3.amazonaws.com/calculated-field/string_calc_field.gif "Calculated String Field")

##### Default
The Listener field will by default sum all numbers passed to it

### Usage
```php
<?php

use Gldrenthe89\NovaCalculatedField\BroadcasterField;
use Gldrenthe89\NovaCalculatedField\ListenerField;

class MyResource extends Resource
{
    public function fields(Request $request) {
        return [    
            BroadcasterField::make('Sub Total', 'sub_total'),
            BroadcasterField::make('Tax', 'tax'),
            ListenerField::make('Total Field', 'total_field')
        ];
    }
}
```

#### Overriding the Callback

```php

<?php
use Gldrenthe89\NovaCalculatedField\BroadcasterField;
use Gldrenthe89\NovaCalculatedField\ListenerField;

class MyResource extends Resource
{
    public function fields(Request $request) {
        return [    
            BroadcasterField::make('Sub Total', 'sub_total'),
            BroadcasterField::make('Tax', 'tax'),

            ListenerField::make('Total Field', 'total_field')
                ->calculateWith(function (Collection $values) {
                    $subtotal = $values->get('sub_total');
                    $tax = $values->get('tax');
                    return $subtotal + $tax;
                }),
        ];
    }
}
```


#### String Fields
```php

<?php
use Gldrenthe89\NovaCalculatedField\BroadcasterField;
use Gldrenthe89\NovaCalculatedField\ListenerField;

class MyResource extends Resource
{
    public function fields(Request $request) {
        return [    
            BroadcasterField::make('First Name', 'first_name')
                ->setType('string'),

            BroadcasterField::make('Last Name', 'last_name')
                ->setType('string'),

            ListenerField::make('Full Name', 'full_name')
                ->calculateWith(function (Collection $values) {
                    return $values->values()->join(' ');
                }),
        ];
    }
}
```


#### Multiple Calculated Fields

```php

<?php
use Gldrenthe89\NovaCalculatedField\BroadcasterField;
use Gldrenthe89\NovaCalculatedField\ListenerField;

class MyResource extends Resource
{
    public function fields(Request $request) {
        return [    
            BroadcasterField::make('Sub Total', 'sub_total')
                ->broadcastTo('total'),

            BroadcasterField::make('Tax', 'tax')
                ->broadcastTo('total'),

            ListenerField::make('Total Field', 'total_field')
                ->listensTo('total')
                ->calculateWith(function (Collection $values) {
                    $subtotal = $values->get('sub_total');
                    $tax = $values->get('tax');
                    return $subtotal + $tax;
                }),


            BroadcasterField::make('Senior Discount', 'senior_discount')
                ->broadcastTo('discount'),
    
            BroadcasterField::make('Coupon Discount', 'coupon_amount')
                ->broadcastTo('discount'),
    
            ListenerField::make('Total Discount', 'total_discount')
                ->listensTo('discount')
                ->calculateWith(function (Collection $values) {
                    $seniorDiscount = $values->get('senior_discount');
                    $couponAmount = $values->get('coupon_amount');
    
                    return $seniorDiscount + $couponAmount;
                })
        ];
    }
}
```
