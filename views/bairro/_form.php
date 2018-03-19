<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Cidade;

/* @var $this yii\web\View */
/* @var $model app\models\Bairro */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="bairro-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nome')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cidade_id')->dropDownList(ArrayHelper::map(Cidade::find()->all(), 'id', 'nome')) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
