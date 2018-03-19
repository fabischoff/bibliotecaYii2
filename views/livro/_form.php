<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Editora;

/* @var $this yii\web\View */
/* @var $model app\models\Livro */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="livro-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?php // $form->field($model, 'id')->textInput()   ?>

    <?= $form->field($model, 'titulo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'numero_pagina')->textInput() ?>
    
    <?= $form->field($model, 'localizacao')->textInput() ?>

    <?= $form->field($model, 'status_leitura')->checkbox() ?>
    
    <?= $form->field($model, 'data_cadastro')->textInput() ?>

    <?= $form->field($model, 'editora_id')->dropDownList(ArrayHelper::map(Editora::find()->all(), 'id', 'nome')) ?>

    <?php if ($model->capa != ""): ?>

        <?= Html::img($model->capa, ['width' => '', 'height' => '100']); ?>

        <?php
    endif;
    ?>


    <?= $form->field($model, 'capa' )->fileInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Salvar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
