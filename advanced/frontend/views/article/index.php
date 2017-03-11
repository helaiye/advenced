<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use frontend\models\Posts;

/* @var $this yii\web\View */
/* @var $model frontend\models\Posts */
$model = new Posts();
/* @var $form ActiveForm */
?>
<div class="article-index">
    <?php $form = ActiveForm::begin(); ?>
        <?= $form->field($model, 'content') ?>
        <?= $form->field($model, 'cat_id') ?>
        <?= $form->field($model, 'user_id') ?>
        <?= $form->field($model, 'is_valid') ?>
        <?= $form->field($model, 'created_at') ?>
        <?= $form->field($model, 'updated_at') ?>
        <?= $form->field($model, 'title') ?>
        <?= $form->field($model, 'summary') ?>
        <?= $form->field($model, 'label_img') ?>
        <?= $form->field($model, 'user_name') ?>
    
        <div class="form-group">
            <?= Html::submitButton(Yii::t('common', 'Submit'), ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- article-index -->
