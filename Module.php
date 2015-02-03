<?php

namespace itzen\comments;

use Yii;

class Module extends \yii\base\Module {

    /**
     * @var array Available comments statuses [statusId => statusName]
     */
    public static $statuses = [
        1 => 'New',
        2 => 'Accepted',
        3 => 'Deleted',
    ];

    /**
     * @var array Array of users [userId => userName]
     */
    public static $users = [];

    /**
     * @inheritdoc
     */
    public $defaultRoute = 'comment';
    

    public $defaultAvatar;

    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'itzen\comments\controllers';

    /**
     * @inheritdoc
     */
    public function init() {
        parent::init();
        if (!isset(Yii::$app->i18n->translations['itzen']) || !isset(Yii::$app->i18n->translations['*'])) {
            Yii::$app->i18n->translations['itzen'] = [
                'class' => 'yii\i18n\PhpMessageSource',
                'sourceLanguage' => 'en',
                'basePath' => '@itzen/comments/messages'
            ];
        }
        $view = Yii::$app->getView();
        $assets=CommentsAsset::register($view);

        if($this->defaultAvatar === null) {
            $this->defaultAvatar = $assets->baseUrl . '/avatar.png';
        }
    }

    /**
     * Returns array of translated statuses
     * @return array
     */
    public static function getStatuses() {
        $statuses = [];
        foreach (self::$statuses as $key => $status) {
            $statuses[$key] = Yii::t('itzen', $status);
        }
        return $statuses;
    }

}
