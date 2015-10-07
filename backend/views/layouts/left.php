<?php
use yii\bootstrap\Nav;

?>
<aside class="left-side sidebar-offcanvas">

    <section class="sidebar">

        <?php if (!Yii::$app->user->isGuest) : ?>
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="<?= $directoryAsset ?>/img/avatar5.png" class="img-circle" alt="User Image"/>
                </div>
                <div class="pull-left info">
                    <p>Hello, <?= @Yii::$app->user->identity->username ?></p>
                    <a href="<?= $directoryAsset ?>/#">
                        <i class="fa fa-circle text-success"></i> Online
                    </a>
                </div>
            </div>
        <?php endif ?>

        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search..."/>
                            <span class="input-group-btn">
                                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i
                                        class="fa fa-search"></i></button>
                            </span>
            </div>
        </form>

        <?=
        Nav::widget(
            [
                'encodeLabels' => false,
                'options' => ['class' => 'sidebar-menu'],
                'items' => [
                //////////menu dashboard/////////////////////////////
                    ['label' => '<span class="fa fa-home fa-fw"></span> Home', 'url' => ['/']],

                //////// menu setting //////////////////////////////////
                    ['label' => '<span class="fa fa-cog fa-fw"></span>Setting <ul>'],
                    ['label' =>  '<li><span class="fa fa-university"></span> Manage University </li>', 'url' => ['/university']],
                    ['label' =>  '<li><span class="fa fa-server"></span> Manage Faculty </li>', 'url' => ['/institution']],
                    ['label' =>  '<li><span class="fa fa-archive"></span> Manage Course </li>', 'url' => ['/course']
                    ],
                    ['label' => '<li><span class="fa fa-graduation-cap"></span> Manage Education Level </li>', 'url' => ['/education-level']],
                    ['label' =>  '<li><span class="fa fa-facebook-official"></span> Manage Social Network </li>', 'url' => ['/socialmedia-platform'],
                    ],
                    ['label' => '</ul>'],
                ///////////////////////////////////////////////////////

                ////////// menu alumni ////////////////////////////////////////

                    ['label' => '<span class="fa fa-users"></span>Alumni<ul>'],
                    
                    ['label' =>  '<li><span class="fa fa-user"></span> Manage Alumni </li>', 'url' => ['/user'],
                    ],
                    ['label' =>  '<li><span class="fa fa-search"></span> Search Alumni </li>', 'url' => ['/advanced-search']],
                   // ['label' =>  '<li><span class="fa fa-file-text"></span> Import/Export List Alumni </li>', 'url' => ['/'],
                   // ],
                    ['label' => '</ul>'],
                ////////////////////////////////////////////////////////////

                    /*['label' => '<span class="fa fa-dashboard"></span> Working Information', 'url' => ['/working-information']],
                   */
                //////////////////////menu Report ///////////////////////////////
                    ['label' => '<span class="fa fa-folder"></span> Reports<ul>'],
                    ['label' =>  '<li><span class="fa fa-bar-chart"></span> Report Alumni </li>', 'url' => ['/report'],
                    ],
                    ['label' =>  '<li><span class="fa fa-line-chart"></span> Statistic Alumni </li>', 'url' => ['/statistic'],
                    ],
                    ['label' => '</ul>'],
               
                ],
            ]
        );
        ?>

    </section>

</aside>
