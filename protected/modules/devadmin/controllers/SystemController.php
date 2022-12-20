<?php
/**
 * Системные настройки
 *
 */


use YiiHelper as Y;
use AttributeHelper as A;
use common\components\helpers\HYii as HYii;

class SystemController extends DevadminController
{
    public $layout = "column2";

    public function actionIndex()
    {
        if (!function_exists('curl_init')) {
            throw new CException('Curl not found');
        }

        if (!D::role('sadmin'))
            throw new \CHttpException(403);

        try {
            if (Y::request()->isPostRequest) {
                $prevModules = Modules::$allModules;
                $modules = Y::request()->getPost('modules');
                $data = array();
                foreach ($modules as $name => $active) {
                    unset($prevModules[$name]);
                    $data[$name] = true;
                    if ($name === 'event' && !Modules::getInstance()->isModuleEnabled($name)) {
                        \Yii::app()->settings->set('cms_settings', 'hide_news', false, true);
                        HYii::cacheFlush();
                    }
                }

                file_put_contents(
                    Yii::getPathOfAlias('application.config') . DS . 'modules.php',
                    '<?php return ' . A::toPHPString($data)
                );
                foreach ($prevModules as $module => $title) {
                    CmsMenu::getInstance()->removeItem($module);
                    if ($module === 'event') {
                        \Yii::app()->settings->set('cms_settings', 'hide_news', true, true);
                        HYii::cacheFlush();
                    }
                }

                \menu\models\Menu::clearMainMenuCache();
                Yii::app()->user->setFlash('success', 'Изменения успешно приняты');
                $this->refresh(true);
            }
        } catch (Exception $e) {
            Yii::app()->user->setFlash('error', $e->getMessage());
        }

        $this->render('index');
    }

}
