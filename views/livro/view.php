<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\BaseUrl;

/* @var $this yii\web\View */
/* @var $model app\models\Livro */

$this->title = $model->titulo;
$this->params['breadcrumbs'][] = ['label' => 'Livros', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<?php // $endereco_imagem = '/var/www/html/biblioteca/imagens/';    ?>

<div class="livro-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>

        <?= Html::a('Atualizar', ['update', 'id' => $model->id, 'editora_id' => $model->editora_id], ['class' => 'btn btn-primary']) ?>
        <?=
        Html::a('Apagar', ['delete', 'id' => $model->id, 'editora_id' => $model->editora_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Remover este item?',
                'method' => 'post',
            ],
        ])
        ?>
    </p>

    <?=
    DetailView::widget([
        'model' => $model,
        'attributes' => [
//            'id',
            'titulo',
            'numero_pagina',
            [
                'attribute' => 'status_leitura',
                'value' => function ($model) {
                    return $model->status_leitura ? 'Sim' : 'Não';
                }
            ],
            [
                'attribute' => 'editora_id',
                'value' => function ($model) {
                    return $model->editora->nome;
                }
            ],
            'localizacao',
            [
                'attribute' => 'capa',
                'value' => $model->capa,
                'format' => ['image'],
            ],
            'data_cadastro'
        ],
    ])
    ?>

</div>

