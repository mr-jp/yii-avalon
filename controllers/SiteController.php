<?php

namespace app\controllers;

use Yii;
use app\models\Game;
use app\models\Player;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
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
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $playerModel = new Player();
        $gameModel = Game::find()->where(['started' => '0'])->orderBy('id DESC')->one();
        $playerCount = (int)$gameModel->getPlayerCount();
        $gameAvailable = $this->checkAvailableGame($gameModel, $playerCount);

        if ($playerModel->load(Yii::$app->request->post())) {

            // check if max number of players reached
            if ($playerCount + 1 >= $gameModel->players) {
                return $this->redirect(['index']);
            }

            // redirect if player saves
            if ($playerModel->save()) {
                return $this->redirect(['wait', 'id' => $playerModel->id]);
            }
        }

        return $this->render('index', [
            'gameModel' => $gameModel,
            'playerModel' => $playerModel,
            'playerCount' => $playerCount,
            'gameAvailable' => $gameAvailable,
        ]);
    }

    /**
     * Waiting page
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionWait($id)
    {
        $model = $this->findPlayerModel($id);
        if (Yii::$app->request->post()) {
            // redirect to role page
        }

        return $this->render('wait', [
            'model' => $model,
        ]);
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Finds the Player model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Player the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findPlayerModel($id)
    {
        if (($model = Player::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    /**
     * Check if game is available
     * @param  Game $gameModel
     * @param  int $playerCount
     * @return boolean
     */
    protected function checkAvailableGame($gameModel, $playerCount) {
        if ($gameModel === null) {
            return false;
        }

        if ($playerCount >= $gameModel->players) {
            return false;
        }

        return true;
    }
}
