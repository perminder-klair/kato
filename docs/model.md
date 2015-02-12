#Model

## To get LIST of defined CONST

First define const in ActiveRecords like:
```php
const TYPE_ONE = 1;
const TYPE_TWO = 2;
const TYPE_THREE = 3;
```

To get array list:
```php
$model->listTypes('TYPE');
```

It will return result like:
```
[
    1 => ' One'
    2 => ' Two'
    3 => ' Three'
]
```

## To get LABEL of defined CONST

To get array list:

```php
$model->type = 1;
$model->getTypeLabel($model->type, 'TYPE');
```

It will return result like:
```
ONE
```
