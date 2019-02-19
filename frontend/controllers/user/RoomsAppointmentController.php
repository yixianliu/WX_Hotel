<?php
/**
 * Created by Yxl.
 * User: <zccem@163.com>.
 * Date: 2019/2/19
 * Time: 15:51
 */

namespace frontend\controllers\user;

use common\models\Hotels;
use common\models\RoomsAppointment;
use yii\data\ActiveDataProvider;
use Yii;

/**
 * OrderController implements the CRUD actions for Order model.
 */
class RoomsAppointmentController extends BaseController
{

    public function actionIndex()
    {

        $dataProvider = new ActiveDataProvider( [
            'query' => RoomsAppointment::find()->where( ['user_id' => Yii::$app->user->identity->user_id] ),
        ] );

        return $this->render( 'index', ['dataProvider' => $dataProvider,] );
    }

    public function actionCreate()
    {

        $model = new RoomsAppointment();

        if ($model->load( Yii::$app->request->post() ) && $model->save()) {

            Yii::$app->getSession()->setFlash( 'success', '预约已发布!' );

            return $this->redirect( ['index'] );
        }

        $result['hotel'] = Hotels::getHotelSelect( 'On' );

        return $this->render( 'create', ['model' => $model, 'result' => $result] );
    }
}