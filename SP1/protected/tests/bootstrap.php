<?php

// change the following paths if necessary
$yiit=dirname(__FILE__).'/../../../../yii/framework/yiit.php';
$config=dirname(__FILE__).'/../config/test.php';

require_once($yiit);
require_once(dirname(__FILE__).'/WebTestCase.php');
//crea una nueva aplicacion basados en la configuracion para las pruebas.
Yii::createWebApplication($config);
