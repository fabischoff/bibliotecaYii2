<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Bairro;

/**
 * BairroSearch represents the model behind the search form of `app\models\Bairro`.
 */
class BairroSearch extends Bairro {

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['id'], 'integer'],
            [['nome', 'cidade_id'], 'safe'],
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
        $query = Bairro::find()->joinWith('cidade');

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
//            'cidade_id' => $this->cidade_id,
        ]);

        $query->andFilterWhere(['like', 'nome', $this->nome])
                ->andFilterWhere(['like', 'cidade.nome', $this->cidade_id]);
        

        return $dataProvider;
    }

}
