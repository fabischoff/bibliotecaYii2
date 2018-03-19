<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Bairro */

$this->title = "Atualizar Bairro: {$model->nome}";
$this->params['breadcrumbs'][] = ['label' => 'Bairros', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->nome, 'url' => ['view', 'id' => $model->nome, 'cidade_id' => $model->nome]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="bairro-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
