<?php

namespace app\controllers;

use app\models\User;

class SignUpController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $user = new User();
        $user->setScenario(User::SCENARIO_REGISTER);

        if ($user->load(\Yii::$app->request->post()) && $user->validate()) {
            $user->save();
            return $this->goHome();
        }
        return $this->render('index', ["model" => $user]);

    }

}
