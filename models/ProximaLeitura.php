<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "proxima_leitura".
 *
 * @property int $id
 * @property int $finalizado
 * @property int $livro_id
 *
 * @property Livro $livro
 */
class ProximaLeitura extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'proxima_leitura';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['livro_id'], 'required'],
            [['livro_id'], 'integer'],
            [['finalizado'], 'string', 'max' => 1],
            [['livro_id'], 'exist', 'skipOnError' => true, 'targetClass' => Livro::className(), 'targetAttribute' => ['livro_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'finalizado' => 'Finalizado',
            'livro_id' => 'Livro ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLivro()
    {
        return $this->hasOne(Livro::className(), ['id' => 'livro_id']);
    }
}
