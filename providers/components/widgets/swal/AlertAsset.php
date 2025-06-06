<?php

namespace helpers\widgets\swal;

use yii\web\AssetBundle;

/**
 * Class AlertAsset
 * @package yii2mod\alert
 */
class AlertAsset extends AssetBundle
{

    /**
     * @var string the directory that contains the source asset files for this asset bundle.
     * A source asset file is a file that is part of your source code repository of your Web application.
     */
    public $sourcePath =  '@ui/assets/oneui/plugins/sweetalert2';

    /**
     * @var array list of JavaScript files that this bundle contains. Each JavaScript file can be
     * specified in one of the following formats:
     */
    public $js = [
        'sweetalert2.min.js',
    ];

    /**
     * @var array list of CSS files that this bundle contains. Each CSS file can be specified
     * in one of the three formats as explained in [[js]].
     */
    public $css = [
        'sweetalert2.min.css'
    ];

}
