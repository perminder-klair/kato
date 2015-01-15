#Pages

To get page link

    \kato\helpers\KatoHtml::page('page-slug');

To get a block of static page

- Set in view:

```php
$this->params['block'] = [
    'id' => $model->id,
    'slug' => $model->slug
];
```

- To echo:

```php 
echo $this->loadBlock('block-name');
```
    
To get a block of dynamic (cms driven) page

- Set in view:

```php
$this->params['block'] = [
    'id' => $model->id,
    'layout' => $model->layout,
];
```

- To echo:

```php 
echo $this->loadBlock('block-name');
```

To get all blocks of a system (non static) page

    $this->getPageBlocks()
