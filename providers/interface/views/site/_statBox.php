<?php
use yii\helpers\Html;
/**
 * @var string $label
 * @var int $count
 * @var string $icon
 * @var string $color
 */
?>

<div class="col-md-4 mb-4">
    <div class="card border-left-<?= $color ?> shadow h-100 py-2">
        <div class="card-body d-flex justify-content-between align-items-center">
            <div>
                <div class="text-xs font-weight-bold text-<?= $color ?> text-uppercase mb-1">
                    <?= Html::encode($label) ?>
                </div>
                <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $count ?></div>
            </div>
            <i class="fas <?= $icon ?> fa-2x text-gray-300"></i>
        </div>
    </div>
</div>
