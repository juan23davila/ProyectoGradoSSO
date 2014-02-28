<?php
/* @var $this UsuarioController */
/* @var $model Usuario */
/* @var $form CActiveForm */
?>


<?php if (Yii::app()->user->hasFlash('contrasena')): ?>

    <div class="flash-success">
        <?php echo Yii::app()->user->getFlash('contrasena'); ?>
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
        <p>Ingrese nueva contraseña.</p>

        <?php echo $form->labelEx($model, 'password'); ?>
        <?php echo $form->passwordField($model, 'password', array('size' => 45, 'maxlength' => 45)); ?>
        <?php echo $form->error($model, 'password'); ?>

    </div>
    <div class="row">
        <p>Repita la nueva contraseña.</p>
        <?php echo $form->labelEx($model, 'password'); ?>
        <input  type="password"  size="45" maxlength="45" required name="password"/>
        <?php echo $form->error($model, 'password'); ?>

    </div>
    <div class="row" style="display: none;">
        <p>Repita la nueva contraseña.</p>
        <?php echo $form->labelEx($model, 'correo'); ?>
        <?php echo $form->passwordField($model, 'correo', array( 'hidden'=>true)); ?>

    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton('Cambiar Contraseña'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- search-form -->