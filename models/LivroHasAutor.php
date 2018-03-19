<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "livro_has_autor".
 *
 * @property int $livro_id
 * @property int $autor_id
 *
 * @property Autor $autor
 * @property Livro $livro
 */
class LivroHasAutor extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'livro_has_autor';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['livro_id', 'autor_id'], 'required'],
            [['livro_id', 'autor_id'], 'integer'],
            [['livro_id', 'autor_id'], 'unique', 'targetAttribute' => ['livro_id', 'autor_id']],
            [['autor_id'], 'exist', 'skipOnError' => true, 'targetClass' => Autor::className(), 'targetAttribute' => ['autor_id' => 'id']],
            [['livro_id'], 'exist', 'skipOnError' => true, 'targetClass' => Livro::className(), 'targetAttribute' => ['livro_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'livro_id' => 'Livro ID',
            'autor_id' => 'Autor ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAutor()
    {
        return $this->hasOne(Autor::className(), ['id' => 'autor_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLivro()
    {
        return $this->hasOne(Livro::className(), ['id' => 'livro_id']);
    }
}
