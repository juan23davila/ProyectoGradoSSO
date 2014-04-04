<?php

class SiteController extends Controller {

    /**
     * Declares class-based actions.
     */
    public function actions() {
        return array(
            // captcha action renders the CAPTCHA image displayed on the contact page
            'captcha' => array(
                'class' => 'CCaptchaAction',
                'backColor' => 0xFFFFFF,
            ),
            // page action renders "static" pages stored under 'protected/views/site/pages'
            // They can be accessed via: index.php?r=site/page&view=FileName
            'page' => array(
                'class' => 'CViewAction',
            ),
        );
    }


    /**
     * This is the action to handle external exceptions.
     */
    public function actionError() {
        if ($error = Yii::app()->errorHandler->error) {
            if (Yii::app()->request->isAjaxRequest)
                echo $error['message'];
            else
                $this->render('error', $error);
        }
    }

    

    /**
     * Displays the login page
     */
    public function actionLogin() {
        
        $auth = new SimpleSAML_Auth_Simple('sp1');
        if (!$auth->isAuthenticated()) {
            $auth->requireAuth(array('ReturnTo' => 'http://sp1.anfho.com/index.php/site/registro',
                'KeepPost' => FALSE,));
        } else {
            $this->render('index');
        }
    }

    /**
     * La accion es llamada desde el IDP.
     */
    public function actionRegistro() {
        $auth = new SimpleSAML_Auth_Simple('sp1');
        $atributos = $auth->getAttributes();
        if (isset($atributos['username']) && isset($atributos['username'][0])) {
            $identity = new UserIdentity($atributos['username'][0], $atributos['username'][0]);
            Yii::app()->user->login($identity, 0);
        }
        $this->render('index');
    }

    /**
     * Logs out the current user and redirect to homepage.
     */
    public function actionLogout() {
        Yii::app()->user->logout();
        $this->redirect('http://idp.anfho.com/simplesaml/saml2/idp/SingleLogoutService.php?ReturnTo=http://sp1.anfho.com');
    }

}
