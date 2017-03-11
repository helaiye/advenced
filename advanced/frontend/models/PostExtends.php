<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "post_extends".
 *
 * @property integer $id
 * @property integer $post_id
 * @property integer $browser
 * @property integer $collect
 * @property integer $praise
 * @property integer $comment
 */
class PostExtends extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'post_extends';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['post_id', 'browser', 'collect', 'praise', 'comment'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'post_id' => Yii::t('app', 'Post ID'),
            'browser' => Yii::t('app', 'Browser'),
            'collect' => Yii::t('app', 'Collect'),
            'praise' => Yii::t('app', 'Praise'),
            'comment' => Yii::t('app', 'Comment'),
        ];
    }
    //参数一：根据条件找到某个文章
    //参数2：让文章的哪个属性自增
    //参数3：让自增的值是多少，默认为1
    //目的：让该函数剧本通用性，可以让评论，点赞，收藏，浏览量都能+1
    public function  upCounter($condition,$attribute,$num = 1) {
        //1.查询扩展表 PostExtends
        //条件一般是id
        $article = $this->findOne($condition);
        //1)文章已经存在，让浏览量在原来基础上+1
        if($article) {
            // 属性名 browser   值为 1目的让他在基础上+1
            $data[$attribute] = $num;
            $article->updateCounters($data);
        }
        //2)文章没有存储过，让浏览量默认为1
        else {
            $this->setAttributes($condition);
            $this->$attribute = 1;
            $this->save();
        }
        //2.评论数+1  点赞+1  收藏+1
       
    }
}
