<?php

namespace app\modules\invoice\controllers;

use Yii;
use yii\web\Controller;
use yii\web\HttpException;
use yii\data\ActiveDataProvider;
use app\modules\invoice\models\Invoice;
use app\modules\invoice\models\Seller;

/**
 * Default controller for the `invoice` module
 */
class DefaultController extends Controller
{

    /**
     * Список всех счетов.
     * @return string
     */
    public function actionIndex()
    {
        $invoiceDataProvider = new ActiveDataProvider([
            'query' => Invoice::find(),
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);
        return $this->render('index', compact('invoiceDataProvider'));
    }

    /**
     * Создает новый чек на оплату.
     * В случае успеха перенаправляет на страницу просмотра чека в HTML.
     * @return string
     */
    public function actionMake()
    {
        $model = new Invoice;

        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                $model->save();

                // таким образом все чеки могут видеть все путем подбора id,
                // но по заданию мы никого ни в чем не ограничиваем.
                $this->redirect(['/invoice/default/html', 'id' => $model->id]);
            }
        }

        // показать форму при первичном заходе или в случае ошибок
        return $this->render('make', [
                'model' => $model,
        ]);
    }

    /**
     * Генерирует HTML-представление чека на оплату
     * @param integer $id номер чека
     * @return string
     */
    public function actionHtml($id, $partial = false)
    {
        $invoice = Invoice::find()->where(['id' => $id])->one(); // ищем чек.
        if (!$invoice) { // если чек не найден - 404, как самый простой вариант.
            throw new HttpException(404, 'Чек на оплату не найден');
        }

        // данные продавца
        $seller = Seller::findOne('1=1');

        // сумма прописью
        $sumInWords = '';

        // лучшим решением было бы не делать два варианта вывода,
        // а сделать версию для печати средствами CSS (@media),
        $method = $partial ? 'renderPartial' : 'render';
        return $this->$method('html', [
                'seller' => $seller,
                'invoice' => $invoice,
                'isPartial' => (boolean) $partial,
                'sumInWords' => $sumInWords
        ]);
    }

}
