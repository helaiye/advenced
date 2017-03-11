<?php
namespace frontend\widgets\chat;
use frontend\models\FeedsForm;
use Yii;
use yii\base\Widget;

class ChatWidgets extends Widget {
    public function run() {
        $feeds = new FeedsForm;
        $data['feed'] = $feeds->getList();
        return $this->render("index", ['data' => $data]);
    }
}
