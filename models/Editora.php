<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "editora".
 *
 * @property int $id
 * @property string $nome
 *
 * @property Livro[] $livros
 */
class Editora extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'editora';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            //[['id', 'nome'], 'required'],
            [['nome'], 'required'],
            [['id'], 'integer'],
            [['nome'], 'string', 'max' => 255],
            [['id'], 'unique'],
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
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLivros()
    {
        return $this->hasMany(Livro::className(), ['editora_id' => 'id']);
    }
}
