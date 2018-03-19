<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel app\models\LivroSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Livros';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="livro-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Cadastrar Livro', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php
    $options = [
        ['id' => 0, "valor" => "Não"],
        ['id' => 1, "valor" => "Sim"]
    ];
    ?>

    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
//            'id',
            'titulo',
            'numero_pagina',
            'localizacao',
            [
                'attribute' => 'editora_id',
                'value' => 'editora.nome'
            ],
            [
                'attribute' => 'status_leitura',
                'value' => function($model, $key, $index, $column) {
                    return $model->status_leitura == 0 ? "Não" : "Sim";
                },
                'filter' => Html::activeDropDownList(
                        $searchModel, 'status_leitura', ArrayHelper::map($options, 'id', 'valor'
                        ), ['class' => 'form-control', 'prompt' => '']),
            ],
            'data_cadastro',            
            ['attribute' => 'capa',
                "format" => "html",
                'value' => function($model) {
                    return Html::img($model->capa, [
                                'width' => '80px',
                                'height' => '80px']);
                },
            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]);
    ?>
</div>
