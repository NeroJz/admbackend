<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
    ];
    public $js = [
        'js/highcharts.js',
        'js/exporting.js',
        'js/graphDashboard.js',
        'js/jquery.dataTables.bootstrap.js',
        'js/jquery.dataTables.min.js',
        'js/manageAlumni.js',
        'js/viewReport.js',
        'js/managefaculty.js',
        'js/managecourse.js',
        'js/statisticAlumni.js',
        'js/advSearch.js',

    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        //'fedemotta\datatables\DataTablesAsset',
    ];
}
