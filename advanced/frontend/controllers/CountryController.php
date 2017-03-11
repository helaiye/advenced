<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace frontend\controllers;
use yii\web\Controller;
use frontend\models\Country;
use yii\data\Pagination;

/**
 * Description of CountryController
 *
 * @author Administrator
 */
class CountryController extends Controller {
    //put your code here
    public function actionIndex() {
        $query = Country::find();
        
        $pagination = new Pagination([
            'defaultPageSize' => 5, //每也几条数据
            'totalCount' => $query->count(),//总页数
        ]);

        
        
        //查询所有城市
//        $countrys = $query->all();
//        $countrys = $query->where([">","population","100000000"])->all();
        
        $countrys = $query->offset($pagination->offset)->limit($pagination->limit)->all();
        //使用sql 语句查询
        //$countrys = Country::findBySql("select * from country")->all();
        
        // 查询大量数据 -- 查询所有商品的基本信息
        //注意：直接会导致内存不够用
        //解决办法1.过滤调不必要的字段
        //2.返回的数据为标准的数组，而不是对象
        $countrys = $query->asArray->all();
        //3.分段查询 分页
        foreach($query->batch(10) as $country) {
            
        }
        return $this->render("index",["countrys"=>$countrys,"pagination"=>$pagination]);
    }
}
