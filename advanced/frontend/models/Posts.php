<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "posts".
 *
 * @property integer $id
 * @property string $title
 * @property string $summary
 * @property string $content
 * @property string $label_img
 * @property integer $cat_id
 * @property integer $user_id
 * @property string $user_name
 * @property integer $is_valid
 * @property integer $created_at
 * @property integer $updated_at
 */
class Posts extends \yii\db\ActiveRecord
{
    const IS_VALID = 1;
    const NOT_VALID = 0;
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'posts';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['content'], 'string'],
            [['cat_id', 'user_id', 'is_valid', 'created_at', 'updated_at'], 'integer'],
            [['title', 'summary', 'label_img', 'user_name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('common', 'ID'),
            'title' => Yii::t('common', 'Title'),
            'summary' => Yii::t('common', 'Summary'),
            'content' => Yii::t('common', 'Content'),
            'label_img' => Yii::t('common', 'Label Img'),
            'cat_id' => Yii::t('common', 'Cat ID'),
            'user_id' => Yii::t('common', 'User ID'),
            'user_name' => Yii::t('common', 'User Name'),
            'is_valid' => Yii::t('common', 'Is Valid'),
            'created_at' => Yii::t('common', 'Created At'),
            'updated_at' => Yii::t('common', 'Updated At'),
        ];
    }
    public function getRelate(){
        return $this->hasMany(RelationPostTags::className(), ['post_id'=>'id']);
    }
    public function getExtend() {
        return $this->hasOne(PostExtends::className(), ['post_id'=>'id']);
    }
    public function getPages($query,$currentPage = 1,$pageSize = 5, $search = null) {
        if($search) {
            $query = $query->andFilerWhere($search);
        }
        $data['count'] = $query->count();
        if(!$data["count"]) {
            return ['count'=>0,'curPage'=>$currentPage,'pageSize'=>$pageSize,'star'=>0,'end'=>0,'data'=>[]];
        }
        $currentPage = (ceil($data['count'] / $pageSize) < $currentPage) ? ceil($data['count'] / $pageSize):$currentPage;
        $data['curPage'] = $currentPage;
        $data['pageSize'] = $pageSize;
        $data['start'] = ($currentPage - 1)*$pageSize +1;
        $data['end'] = (ceil($data['count'] / $pageSize) == $currentPage)?$data['count']:($currentPage-1)*$pageSize+$pageSize;
        $data['data'] = $query->offset(($currentPage - 1)*$pageSize)->limit($pageSize)->asArray()->all();
        return $data;
    }

}
