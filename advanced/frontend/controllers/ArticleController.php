<?php

namespace frontend\controllers;
use Yii;
use frontend\models\PostsForm;
use frontend\models\Cats;
use frontend\models\Posts;
use frontend\models\Feeds;
use frontend\models\FeedsForm;
use frontend\models\PostExtends;
class ArticleController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }
    
    public function actionDetail(){
        $model = new PostsForm();
        $data = $model->getArticleById(\Yii::$app->request->get('id'));
        //每次展示文章详情，让浏览量自动+1
        //理论上，同一个ip 连续访问同一篇文章，不应该+1
        $model1 = new PostExtends();
        //自定义方法，每次调用+1
        $model1->upCounter(['post_id'=>\Yii::$app->request->get('id')],"browser",1);
        
        return $this->render('detail',['data'=>$data]);
    }
   

    public function actionAdd(){
        $model = new PostsForm;
        $model->setScenario(PostsForm::SCENARIOS_CREATE);
        if($model->load(\Yii::$app->request->post()) && $model->validate()){
           if($model->createArticle()){
               echo '保存成功';
               return $this->redirect(['article/detail','id'=>$model->id]);
           } else {
               echo '保存失败';
           }
           exit;
        }
        
        $categorys = Cats::find()->asArray()->all();
        //对查询到的数据做处理,转化为一维数组
        $cats = [];
        $cats[0]= '默认分类';
        foreach ($categorys as $k => $v) {
            $cats[$v['id']] = $v['cat_name'];
        }
        return $this->render('add',['model'=>$model,'categorys'=>$cats]);
    }
    
     public function actions()
    {
        return [
            'upload'=>[
                'class' => 'common\widgets\file_upload\UploadAction',     //这里扩展地址别写错
                'config' => [
                    'imagePathFormat' => "/image/{yyyy}{mm}{dd}/{time}{rand:6}",
                ]
            ],
            'ueditor'=>[
            'class' => 'common\widgets\ueditor\UeditorAction',
            'config'=>[
                //上传图片配置
                'imageUrlPrefix' => "", /* 图片访问路径前缀 */
                'imagePathFormat' => "/image/{yyyy}{mm}{dd}/{time}{rand:6}", /* 上传保存路径,可以自定义保存路径和文件名格式 */
            ]
        ]
        ];
    }
     public function actionAddfeed() {
        
        $model = new FeedsForm();
        $model->content = Yii::$app->request->post("content");
        if($model->validate()) {
            if($model->createFeeds()) {
                return json_encode(['status'=>true]);
            }
        }
        return json_encode(['status'=>false,'msg'=>"发布失败"]);
        
    }
    
}
