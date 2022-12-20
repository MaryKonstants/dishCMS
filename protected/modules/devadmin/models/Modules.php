<?php


class Modules
{
    /**
     *
     * @var Modules
     */
    private static $instance;
    public $enabledModules;
    public $modules;

    public function __construct()
    {
        foreach (self::$allModules as $module => $val) {
            $this->modules[$module] = false;
        }
        $path = \Yii::getPathOfAlias('application').DIRECTORY_SEPARATOR. 'config' . DIRECTORY_SEPARATOR .'modules.php';
        $this->enabledModules = include($path)?:[];
        $this->modules = array_merge($this->modules, $this->enabledModules);
    }

    /**
     * @return Modules
     */
    public static function getInstance()
    {
        if (is_null(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function isModuleEnabled($module)
    {
        return $this->modules[$module];
    }

    public static $allModules = [
        'event' => 'Новости',
        'feedback' => 'Обратная связь',
        'question' => 'Вопрос-ответ',
        'shop' => 'Магазин',
        'slider' => 'Слайдер',
        'gallery' => 'Фотогалерея',
        'sale' => 'Акции',
        'reviews' => 'Отзывы',
        'articles' => 'Статьи',
        'services' => 'Услуги',
    ];
}