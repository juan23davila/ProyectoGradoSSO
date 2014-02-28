<?php
/* @var $this UsuarioController */
/* @var $model Usuario */
/* @var $form CActiveForm */
?>


<?php if (Yii::app()->user->hasFlash('Correo')): ?>

    <div class="flash-success">
        <?php echo Yii::app()->user->getFlash('Correo'); ?>
    </div>
<?php endif; ?>

<div class="wide form">



    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'action' => Yii::app()->createUrl($this->route),
        'method' => 'post',
    ));
    ?>
    
    <div class="row">
        <p>Ingresar un correo electronico con el que registro su cuenta, de no recordarlo comunicarse con el centro de atención.</p>
        <?php echo $form->label($model, "correo"); ?>
        <input type="email" name="Usuario[correo]" id="Usuario[correo]" required/>
    </div>


    <div class="row buttons">
    <?php echo CHtml::submitButton('Recuperar Contraseña'); ?>
    </div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->