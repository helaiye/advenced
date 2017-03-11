<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' =>Yii::t("common","My Blog") ,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    $leftmenuItems = [
        ['label' => Yii::t("common","Home"), 'url' => ['/site/index']],
       
        ['label' => Yii::t("common","About"), 'url' => ['/site/about']],
        ['label' => Yii::t("common","Article"), 'url' => ['/article/index']],
        ['label' => Yii::t("common","Category"), 'url' => ['/category/index']],
        ['label' => Yii::t("common","Contact"), 'url' => ['/site/contact']],
    ];
    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => Yii::t("common","Signup") , 'url' => ['/site/signup']];
        $menuItems[] = ['label' => Yii::t("common","Login"), 'url' => ['/site/login']];
    } else {
        $menuItems[] = [
            "label"=> "<img src='\statics\images\headimg\a.jpeg' alt='' width='30px'>",
            'items'=>[
                ['label'=> "<i class='fa-bolt'></i>发布博客",'url'=>['article/add'],'linkOptions'=>['data-method'=>'post']],
                ['label'=> "切换用户",'url'=>['site/logout'],'linkOptions'=>['data-method'=>'post']],
                ['label'=> "更改密码",'url'=>['site/logout'],'linkOptions'=>['data-method'=>'post']],
                ['label'=> "绑定手机",'url'=>['site/logout'],'linkOptions'=>['data-method'=>'post']],
                ['label'=> "<i class='fa fa-sign-out'></i>退出",'url'=>['site/logout'],'linkOptions'=>['data-method'=>'post']],
                ],
            ];
                
                
//                '<li>'
//            . Html::beginForm(['/site/logout'], 'post')
//            . Html::submitButton(
//                'Logout (' . Yii::$app->user->identity->username . ')',
//                ['class' => 'btn btn-link logout']
//            )
//            . Html::endForm()
//            . '</li>';
    }
   
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-left'],
        'items' => $leftmenuItems,
    ]);
     echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
         'encodeLabels'=>false,
        'items' => $menuItems,
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; My Company <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
