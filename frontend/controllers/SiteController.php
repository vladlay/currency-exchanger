<?php
namespace frontend\controllers;

use Yii;
use yii\web\Response;
use yii\web\Controller;
use yii\widgets\ActiveForm;
use yii\filters\VerbFilter;
use common\models\Currency;
use yii\base\ErrorException;
use common\models\ExchOrder;
use yii\helpers\ArrayHelper;
use common\models\LoginForm;
use yii\filters\AccessControl;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use common\models\ContactSearch;
use backend\models\ExchDirection;
use yii\web\BadRequestHttpException;
use frontend\models\VerifyEmailForm;
use frontend\models\ResetPasswordForm;
use yii\base\InvalidArgumentException;
use backend\models\ExchDirectionSearch;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResendVerificationEmailForm;

/**
 * Site controller
 */
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
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
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
     * @return mixed
     */
    public function actionIndex()
    {   
        /**
         * создание модели
         */
        $model = new ExchOrder();

        /**
         * вытягивает все картинки (id => code)
         */
        $currenciesCodes = Currency::getCurrenciesCodes();

        /**
         * from_currencies - первоначальный левый блок отдаете
         * $model->from_currency - задаем выбранный элемент
         */
        $from_currencies = ExchDirection::getFromCurrencies();
        $model->from_currency = array_key_first($from_currencies);
        
        /**
         * просто пишем запрос в переменную
         */
        $request = Yii::$app->request;

        /**
         * слушаем запрос пост
         * если изменился выбор в левом блоке - пишем в модель новый выбор
         */
        $from = $request->post('from') ? $request->post('from') : $model->from_currency;
        $model->from_currency = $from;
        
        /**
         * если пришл гет запрос
         * обновляем from
         * пишем to
         * на этом этапе у нас есть данные для поиска направления
         */
        if ($request->get('from') && $request->get('to')) {
            $from = $request->get('from');
            $to = $request->get('to');

            $checked_direction = ExchDirection::getCourse(
                array_search($from, $currenciesCodes),
                array_search($to, $currenciesCodes)
            );

            $model = new ExchOrder(
                $checked_direction->min_amount_from,
                $checked_direction->max_amount_from,
                $checked_direction->min_amount_to,
                $checked_direction->max_amount_to,
            );

            $course = [
                    'from' => $checked_direction->rate_from,
                    'to' => $checked_direction->rate_to
            ];

            $model->from_currency = $from;
            $model->to_currency = $to;
            // $model->rate = $course['from'] . ' → ' . $course['to'];
            $model->rate = $course['from']
                            . ' '
                            . $from 
                            . ' → ' 
                            . $course['to'] 
                            . ' '
                            . $to;
            $model->status = $model->statuses['not_paid'];
            $model->ip_address = Yii::$app->request->userIP;
            
        } else {
            $course = null;
        }
        
        /**
         * $to_currencies - все модели блока Получаете
         * $to_currencies_list array код => имя валюты
         * $to_currencies_reserves - array код => резерв
         */
        $to_currencies = ExchDirection::getToCurrencies($from);
        $to_currencies_list = ArrayHelper::map(
            $to_currencies,
            'toCurrency.code', 
            'toCurrency.name'
        );
        $to_currencies_reserves = ArrayHelper::map(
            $to_currencies,
            'toCurrency.code', 
            'toCurrency.reserve'
        );

        /**
         * $icons массив id валюты => src
         * $icon_from - код валюты from
         * $icon_to - код валюты to
         */ 
        $icons = Currency::getIcons();
        $icon_from = $request->get('from');
        $icon_to = $request->get('to');

        /**
         * для валидации, проверить нужно ли?
         */
        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            
            $secret_id = base64_encode(
                base64_encode(
                    base64_encode($model->id)
                )
            );

            return $this->redirect(['payment', 'id' => $secret_id]);
        }

        /**
         * данные для возврата
         */
        $data = compact(
            'model', 
            'from_currencies', 
            'to_currencies_list',
            'icons',
            'currenciesCodes',
            'to_currencies_reserves',
            'icon_from',
            'icon_to',
            'course',
        );

        /**
         * рендер и возврат данных
         */
        if(Yii::$app->request->getHeaders()->has('X-PJAX')) {
            return $this->renderAjax('index', $data);
        } else {
            return $this->render('index', $data);
        }
    }

    public function actionPayment($id) {
        $id = base64_decode(
            base64_decode(
                base64_decode($id)
            )
        );

        $model = ExchOrder::findOne($id);
        
        return $this->render('payment', [
            'model' => $model,
        ]);
    }

    public function actionOrderView($id) {

        $id = base64_decode(
            base64_decode(
                base64_decode($id)
            )
        );

        $model = ExchOrder::findOne($id);

        return $this->render('order-view', [
            'model' => $model,
        ]);
    }

    public function actionPaidOrder($id)
    {
        $id = base64_decode(
            base64_decode(
                base64_decode($id)
            )
        );

        $model = ExchOrder::findOne($id);
        $model->status = $model->statuses['in_processing'];

        try {
            $model->save(false);
        } catch (ErrorException $e) {
            throw new \yii\web\HttpException(404, 'Что то пошло не так :(');
        }

        $secret_id = base64_encode(
            base64_encode(
                base64_encode($model->id)
            )
        );

        return $this->redirect(['order-view', 'id' => $secret_id]);
    }

    public function actionDelete_order($id)
    {
        $decoded_id = base64_decode(
            base64_decode(
                base64_decode($id)
            )
        );

        $model = ExchOrder::findOne($decoded_id);
        $model->status = $model->statuses['deleted'];

        try {
            $model->save(false);
        } catch (ErrorException $e) {
            throw new \yii\web\HttpException(404, 'Что то пошло не так :(');
        } finally {
            return $this->goHome();
        }
    }

    public function actionFaq()
    {
        return $this->render('faq');
    }

    public function actionRules()
    {
        return $this->render('rules');
    }

    public function actionContacts()
    {
        $searchModel = new ContactSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('contacts', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            $model->password = '';

            return $this->render('login', [
                'model' => $model,
            ]);
        }
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
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending your message.');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post()) && $model->signup()) {
            Yii::$app->session->setFlash('success', 'Thank you for registration. Please check your inbox for verification email.');
            return $this->goHome();
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }

    /**
     * Verify email address
     *
     * @param string $token
     * @throws BadRequestHttpException
     * @return yii\web\Response
     */
    public function actionVerifyEmail($token)
    {
        try {
            $model = new VerifyEmailForm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }
        if ($user = $model->verifyEmail()) {
            if (Yii::$app->user->login($user)) {
                Yii::$app->session->setFlash('success', 'Your email has been confirmed!');
                return $this->goHome();
            }
        }

        Yii::$app->session->setFlash('error', 'Sorry, we are unable to verify your account with provided token.');
        return $this->goHome();
    }

    /**
     * Resend verification email
     *
     * @return mixed
     */
    public function actionResendVerificationEmail()
    {
        $model = new ResendVerificationEmailForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');
                return $this->goHome();
            }
            Yii::$app->session->setFlash('error', 'Sorry, we are unable to resend verification email for the provided email address.');
        }

        return $this->render('resendVerificationEmail', [
            'model' => $model
        ]);
    }
}
