<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\LivroSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="livro-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'titulo') ?>

    <?= $form->field($model, 'numero_pagina') ?>
    
    <?= $form->field($model, 'localizacao') ?>
    
    <?= $form->field($model, 'status_leitura') ?>
    
    <?= $form->field($model, 'data_cadastro') ?>

    <?= $form->field($model, 'editora_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
