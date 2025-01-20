<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var dashboard\models\Staff $model */

$this->title = 'Create Staff';
$this->params['breadcrumbs'][] = ['label' => 'Staff', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="staff-create">

  

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
