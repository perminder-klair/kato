<?php

use dosamigos\editable\Editable;
use yii\helpers\Json;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

/**
 * @var backend\models\Media $media
 */


$uploadUrl = '';
if (isset($isNew)) {
    $uploadUrl = '/admin';
}

$titleOptions = [
    'name' => 'title',
    'value' => $media->title,
    'url' => $uploadUrl . '/media/update-data?id=' . $media->id,
    'type' => 'text',
    'mode' => 'inline',
];

$statusOptions = [
    'name' => 'status',
    'value' => $media->statusLabel,
    'url' => $uploadUrl. '/media/update-data?id=' . $media->id,
    'type' => 'select2',
    'mode' => 'pop',
];

$statusClientOptions = [
    'placement' => 'right',
    'select2' => [
        'width' => '124px'
    ],
    'source' => $media->statusDropDownList(),
];

?>
<div class="col-sm-3 col-md-2" id="media-<?= $media->id ?>">
    <div class="thumbnail">
        <?= Html::a('<i class="fa fa-times"></i>', null, [
            'title' => Yii::t('yii', 'Close'),
            'class' => 'btn btn-default delete-btn',
            //'data-original-title' => 'Delete',
            //'data-confirm' => 'Are you sure to delete this item?',
            'onclick'=>"
                 $.ajax({
                type     :'POST',
                cache    : false,
                url  : '" . \Yii::$app->urlManager->createAdminUrl(['media/delete', 'id' => $media->id]) . "',
                success  : function(response) {
                    $('#media-$media->id').remove();
                }
                });return false;",
        ]); ?>

        <a href="<?php echo $media->render(); ?>" <?php if ($media->mimeType === 'application/pdf') { ?>target="_blank"<?php } else { ?>data-lightbox="<?= $media->filename; ?>" data-title="<?= $media->title; ?>"<?php } ?>>
            <?= $media->render([
                'imgTag' => true,
                'width' => 90,
                'height' => 90,
                'class' => 'img-responsive'
            ]); ?>
        </a>
        <div class="caption">
            <h4>
                <?= Editable::widget(
                    ArrayHelper::merge($titleOptions, [
                        'options' => [
                            'id' => 'ed' . $media->id,
                        ],
                        'clientOptions' => [
                            'pk' => $media->id,
                        ],
                    ])
                );?>
            </h4>
            <div class="row">
                <div class="col-md-6">
                    <small><?= \kato\helpers\KatoBase::formatBytes($media->byteSize, 'MB', 3) ?></small>
                </div>
                <div class="col-md-6 status">
                    <?= Editable::widget(
                        ArrayHelper::merge($statusOptions, [
                            'options' => [
                                'id' => 'edw' . $media->id,
                            ],
                            'clientOptions' => ArrayHelper::merge($statusClientOptions, [
                                'pk' => $media->id . '2',
                            ]),
                        ])
                    );?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php if (isset($isNew)) { ?>
    <script type="text/javascript">
        jQuery('#ed<?= $media->id; ?>').editable(<?= Json::encode(ArrayHelper::merge($titleOptions, ['pk' => $media->id])); ?>);
        jQuery('#edw<?= $media->id; ?>').editable(
            <?= Json::encode(ArrayHelper::merge(ArrayHelper::merge($statusOptions, $statusClientOptions), ['pk' => $media->id])); ?>
        );
    </script>
<?php } ?>