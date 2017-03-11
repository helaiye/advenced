<?php

namespace frontend\controllers;

class CategoryController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

}
