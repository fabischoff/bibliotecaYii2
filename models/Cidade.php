<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cidade".
 *
 * @property int $id
 * @property string $cidadecol
 *
 * @property Bairro[] $bairros
 */
class Cidade extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cidade';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nome'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nome' => 'Cidade',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBairros()
    {
        return $this->hasMany(Bairro::className(), ['cidade_id' => 'id']);
    }
}
