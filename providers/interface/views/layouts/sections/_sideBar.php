<?php
use yii\helpers\Html;
use ui\bundles\DashboardAsset;
DashboardAsset::register($this);
?>
<nav id="sidebar" aria-label="Main Navigation" class="sidebar">
<div class="  text-center py-3">
    <a href="<?= Yii::$app->urlManager->createUrl(['dashboard/site/dashboard']) ?>" class="d-flex align-items-center justify-content-center">
        
        <?= Html::img('@web/providers/interface/assets/images/logo.webp', [
            'alt' => 'TUM Wellness',
            'class' => 'img-fluid',
            'style' => 'max-height: 50px; margin-right: 10px;',// adjust size here
        ]) ?>
     
    </a>
</div>
    <!-- Side Header -->
    <div class="content-header">
        <!-- Logo -->
        <a class="fw-semibold text-dual" href="#">
            <span class="smini-visible">
                <i class="fa fa-circle-notch text-primary"></i>
            </span>
            <span class="smini-hide fs-5 tracking-wider"><?= Yii::$app->name ?></span>
        </a>
        <!-- END Logo -->

        <!-- Extra -->
        <div>
            <!-- Close Sidebar, Visible only on mobile screens -->
            <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
            <a class="d-lg-none btn btn-sm btn-alt-secondary ms-1" data-toggle="layout" data-action="sidebar_close" href="javascript:void(0)">
                <i class="fa fa-fw fa-times"></i>
            </a>
            <!-- END Close Sidebar -->
        </div>
        <!-- END Extra -->
    </div>
    <div class="js-sidebar-scroll">
        <!-- Side Navigation -->
        <div class="content-side">
            <?= \helpers\Menu::load() ?>
        </div>
    </div>
</nav>