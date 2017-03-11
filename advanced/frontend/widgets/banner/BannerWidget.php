<?php

namespace frontend\widgets\banner;
use yii\base\Widget;

//广告轮播
class BannerWidget extends Widget {
    //一般应该由用户自定义
    
    public $items = [];
    public function init() {
        //初始化数据
        if(count($this->items) === 0) {
            $this->items = [
                [   
                    'active'=>'active',
                    'image_url' => "/statics/images/banner/0.jpg",
                    "html" => "http://www.baidu.com",
                    "image_name" =>"图片1",
                    "image_title" =>"欢迎光临",
                    
                ],
                [
                    'active'=>'',
                    'image_url' => "/statics/images/banner/1.jpg",
                    "html" => "http://www.baidu.com",
                    "image_name" =>"图片1",
                    "image_title" =>"欢迎光临",
                    
                ],
                [
                    'active'=>'',
                    'image_url' => "/statics/images/banner/2.jpg",
                    "html" => "http://www.baidu.com",
                    "image_name" =>"图片1",
                    "image_title" =>"欢迎光临",
                    
                ],
                [
                    'active'=>'',
                    'image_url' => "/statics/images/banner/3.jpg",
                    "html" => "http://www.baidu.com",
                    "image_name" =>"图片1",
                    "image_title" =>"欢迎光临",
                    
                ],
                
            ];
        }
    }
    public function  run() {
        //用于展示模板页
        return $this->render("index",['items'=>$this->items]);
    }
}
