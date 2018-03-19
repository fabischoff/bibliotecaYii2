<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Livro;

/**
 * LivroSearch represents the model behind the search form of `app\models\Livro`.
 */
class LivroSearch extends Livro {

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['id'], 'integer'],
            [['titulo', 'numero_pagina', 'editora_id','localizacao', 'status_leitura','data_cadastro'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios() {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params) {
        $query = Livro::find()->joinWith('editora');
        

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate())
        {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'status_leitura' => $this->status_leitura
//            'editora_id' => $this->editora_id,
        ]);

        $query->andFilterWhere(['like', 'titulo', $this->titulo])//ver pesquisa case insensitive mysql
                ->andFilterWhere(['like', 'numero_pagina', $this->numero_pagina])
                ->andFilterWhere(['like', 'localizacao', $this->localizacao])
                ->andFilterWhere(['like', 'data_cadastro', $this->data_cadastro])
                ->andFilterWhere(['like', 'editora.nome', $this->editora_id]);
                
        
//    echo $query->createCommand()->getRawSql();die;

        return $dataProvider;
    }

}
