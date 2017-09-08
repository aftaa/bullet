<?php

namespace app\modules\invoice\controllers;

use yii\web\Controller;

/**
 * Default controller for the `invoice` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }
    
    /**
     * Создает новый чек на оплату.
     * @return string
     */
    public function actionMake()
    {
        return $this->render('make');
    }
    
    /**
     * Генерирует HTML-представление чека на оплату
     * @param integer $id номер чека
     * @return string
     */
    public function actionHtml($id)
    {
        return $this->render('html');
    }
}
