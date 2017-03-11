<?php
use frontend\widgets\banner\BannerWidget;
use frontend\widgets\hot\HotWidget;
use frontend\widgets\tag\TagWidget;
use frontend\widgets\article\ArticleWidget;
use frontend\widgets\chat\ChatWidgets;
/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<!--组件有什么用-->
<!--1.方便代码移植-->
<!--2.界面清新-->
<!--3.减少代码量-->
<div class="row">
    <div class="col-lg-9">
        <?=BannerWidget::widget();?>
        <?=ArticleWidget::widget();?>
    </div>
    <div class="col-lg-3">
        <?=HotWidget::widget();?>
        <?=TagWidget::widget();?>
        <?=ChatWidgets::widget();?>
        
    </div>
</div>
