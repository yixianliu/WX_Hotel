<?php
/**
 * Created by Yxl.
 * User: <zccem@163.com>.
 * Date: 2018/8/31
 * Time: 15:42
 */

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use frontend\models\SignupForm;
use frontend\models\LoginForm;

/**
 * RoomsController implements the CRUD actions for Rooms model.
 */
class MemberController extends Controller
{

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only'  => ['logout', 'reg'],
                'rules' => [
                    [
                        'actions' => ['reg', 'login'],
                        'allow'   => true,
                        'roles'   => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow'   => true,
                        'roles'   => ['@'],
                    ],
                ],
            ],
            'verbs'  => [
                'class'   => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [

            'error'   => [
                'class' => 'yii\web\ErrorAction',
            ],

            'captcha' => [
                'class'           => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        if ( !Yii::$app->user->isGuest ) {
            return $this->goHome();
        }

        $model = new LoginForm();

        if ( $model->load(Yii::$app->request->post()) && $model->login() ) {
            return $this->goBack();
        }

        $model->password = '';

        return $this->render('../center/login', [
            'model' => $model,
        ]);
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->goHome();
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionReg()
    {

        $model = new SignupForm();

        if ( $model->load(Yii::$app->request->post()) ) {

            if ( $user = $model->signup() ) {
                if ( Yii::$app->getUser()->login($user) ) {
                    return $this->goHome();
                }
            }
        }

        return $this->render('../center/reg', [
            'model' => $model,
        ]);
    }

}