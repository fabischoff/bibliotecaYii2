<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Livro */

$this->title = "Atualizar Livro: {$model->titulo}";
$this->params['breadcrumbs'][] = ['label' => 'Livros', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => 'Título: '.$model->titulo, 'url' => ['view', 'id' => $model->id, 'editora_id' => $model->editora_id]];
$this->params['breadcrumbs'][] = 'Atualizar';
?>
<div class="livro-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
