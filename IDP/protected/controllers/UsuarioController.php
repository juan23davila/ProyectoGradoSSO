<?php

class UsuarioController extends Controller {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column2';

    /**
     * @return array action filters
     */
    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
            'postOnly + delete', // we only allow deletion via POST request
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules() {
        return array(
            array('allow', // allow all users to perform 'index' and 'view' actions
                'actions' => array('enviarCorreo', 'recuperarContrasena'),
                'users' => array('*'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('create', 'update', 'cambiarContrasena'),
                'users' => array('@'),
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('admin', 'delete', 'index', 'view'),
                'users' => array('anfho'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id) {
        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }

    public function actionRecuperarContrasena() {

        $model = new Usuario;

        if (isset($_POST['Usuario'])) {
            $correo = $_POST['Usuario']['correo'];
            $respuesta = $this->enviarRecuperacionCorreo($correo);
            Yii::app()->user->setFlash('Correo', $respuesta);
            $this->refresh();
        }
        $this->render('recuperar', array(
            'model' => $model,
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $model = new Usuario;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Usuario'])) {
            $model->attributes = $_POST['Usuario'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->id));
        }

        $this->render('create', array(
            'model' => $model,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id) {
        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Usuario'])) {
            $model->attributes = $_POST['Usuario'];
            $model->fecha_modificacion = date(Y / m / d);
            //TODO modificar la fecha_modificacion en la base de datos.
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->id));
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id) {
        $this->loadModel($id)->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
        $dataProvider = new CActiveDataProvider('Usuario');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new Usuario('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Usuario']))
            $model->attributes = $_GET['Usuario'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    public function actionCambiarContrasena() {
        $correo = "";
        if (isset($_POST['Usuario'])) {
            $correo = $_POST['Usuario']['correo'];
        } else {
            $correo = $_REQUEST['correo'];
        }

        $modelo = Usuario::model()->find("correo=:correo", array(":correo" => $correo));


        if ($modelo != null) {
            if (isset($_POST['Usuario'])) {
                if ($_POST['password'] == $_POST['Usuario']['password']) {

                    $modelo->password = $_POST['Usuario']['password'];
                    if ($modelo->save()) {
                        Yii::app()->user->setFlash('contrasena', "Tu contraseña fue modificada");
                        
                    } else {
                        Yii::app()->user->setFlash('contrasena', "Tu contraseña NO fue modificada");
                    }
                }else{
                 Yii::app()->user->setFlash('contrasena', "Los campos deben coincidir");   
                }
            } else {
                Yii::app()->user->setFlash('contrasena', "Tu contraseña NO fue modificada");
            }
           
            $this->render('cambiar', array(
                'model' => $modelo,
            ));
        } else {
            $this->actionIndex();
        }
        //$_GET['correo'];
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Usuario the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = Usuario::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    private function enviarRecuperacionCorreo($correo) {
        $message = "<h1>COSA</h1>";
        $mail = new PHPMailer;
        $mail->isSMTP();                                      // Set mailer to use SMTP
        $mail->Host = 'smtp.gmail.com';                       // Specify main and backup server
        $mail->SMTPAuth = true;                               // Enable SMTP authentication
        $mail->Username = 'anfho93@gmail.com';                   // SMTP username
        $mail->Password = 'Andres1993';               // SMTP password
        $mail->SMTPSecure = 'tls';                            // Enable encryption, 'ssl' also accepted
        $mail->Port = 587;                                    //Set the SMTP port number - 587 for authenticated TLS
        $mail->setFrom('anfho93@gmail.com', 'Anfho');     //Set who the message is to be sent from
        $mail->addReplyTo('anfho93@gmail.com', 'First Last');  //Set an alternative reply-to address
        $mail->addAddress($correo);  // Add a recipient
        $mail->WordWrap = 50;                                // Set word wrap to 50 characters
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = 'Recuperacion de contraseñas SSO Uniquindio';

        if ($this->isUsuario($correo)) {
            $password = $this->darContrasenaUsuario($correo);
            $mail->msgHTML('tu password es ' . $password . "Te recomendamos cambiarla en el siguiente" . '<a href="http://idp.anfho.com/index.php/usuario/cambiarContrasena?correo=' . $correo . '">LINK</a>"');
            if (!$mail->send()) {
                return 'El mensaje no fue enviado' . 'Mailer Error: ' . $mail->ErrorInfo;
            }
            return 'Se envio un mensaje al correo electronico con la informacion necesaria para recuperar tu contraseña.';
        } else {
            return "No eres un usuario de este proveedor de identidad.";
        }
    }

    private function isUsuario($correo) {
        $model = Usuario::model()->find('correo=:correo', array(':correo' => $correo));
        if ($model == null) {
            return false;
        } else {
            return true;
        }
    }

    private function darContrasenaUsuario($correo) {
        $user = Usuario::model()->find("correo=:correo", array(":correo" => $correo));
        return $user->password;
    }

    /**
     * Performs the AJAX validation.
     * @param Usuario $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'usuario-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
