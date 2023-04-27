<?php

namespace app\controllers;

use app\models\User;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use yii\web\UploadedFile;
use yii\widgets\ActiveForm;


class UserController extends Controller
{
    public function actionProfile()
    {
        return $this->render('profile');
    }
    public function actionUsers()
    {
        $users = User::findAll(['role'=>'0']);
//        var_dump($users); die();
        return $this->render('users', ['users'=>$users]);
    }




}