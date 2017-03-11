<?php
namespace frontend\widgets\article;
use yii\base\Widget;
use \frontend\models\PostsForm;
use frontend\models\Posts;
use yii\data\Pagination;
use \yii\helpers\Url;


/**
 * Description of ArticleWidget
 *
 * @author Administrator
 */
class ArticleWidget extends Widget {
    //put your code here
    public $title;
    public $limit = 3;
    public $page = true;
    public $more = true;
//    public  function init() {
//        
//    }
    public function  run() {
        //1.获取当前页
        $currentPage = \Yii::$app->request->get("page",1);
        //2,查询所有可见的文章
        $condition = ['=','is_valid', \frontend\models\Posts::IS_VALID];
        //3.由
        $res = PostsForm::getArticleList($condition,$currentPage, $this->limit);
        $result['title'] = $this->title ? :"最新文章";
        $result['more'] = Url::to(['article/index']);
        $result['body'] = $res['data']? :[];
        if($this->page) {
            $pages = new Pagination(['totalCount'=>$res['count'],'pageSize'=>$res['pageSize']]);
            $result['page'] = $pages;
        }else {
            
        }
        return $this->render("index",['data'=>$result]);
    }
}
