<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "bairro".
 *
 * @property int $id
 * @property string $nome
 * @property int $cidade_id
 *
 * @property Cidade $cidade
 */
class Bairro extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'bairro';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nome'], 'required'],
            [['cidade_id'], 'integer'],
            [['nome'], 'string', 'max' => 255],
            [['cidade_id'], 'exist', 'skipOnError' => true, 'targetClass' => Cidade::className(), 'targetAttribute' => ['cidade_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nome' => 'Nome',
            'cidade_id' => 'Cidade',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCidade()
    {
        return $this->hasOne(Cidade::className(), ['id' => 'cidade_id']);
    }
}
