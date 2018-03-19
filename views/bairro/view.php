<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Bairro */

$this->title = $model->nome;
$this->params['breadcrumbs'][] = ['label' => 'Bairros', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bairro-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['Atualizar', 'id' => $model->nome, 'cidade_id' => $model->nome], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['Apagar', 'id' => $model->nome, 'cidade_id' => $model->nome], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
//            'id',
            'nome',
            'cidade_id',
        ],
    ]) ?>

</div>
