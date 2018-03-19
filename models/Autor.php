<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "autor".
 *
 * @property int $id
 * @property string $nome
 *
 * @property LivroHasAutor[] $livroHasAutors
 * @property Livro[] $livros
 */
class Autor extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'autor';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'nome'], 'required'],
            [['id'], 'integer'],
            [['nome'], 'string', 'max' => 45],
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
    public function getLivroHasAutors()
    {
        return $this->hasMany(LivroHasAutor::className(), ['autor_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLivros()
    {
        return $this->hasMany(Livro::className(), ['id' => 'livro_id'])->viaTable('livro_has_autor', ['autor_id' => 'id']);
    }
}
