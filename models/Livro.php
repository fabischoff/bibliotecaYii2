<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "livro".
 *
 * @property int $id
 * @property string $titulo
 * @property int $numero_pagina
 * @property int $editora_id
 * @property bool $status_leitura
 *
 * @property Editora $editora
 * @property LivroHasAutor[] $livroHasAutors
 * @property Autor[] $autors
 */
class Livro extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'livro';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
//            [['id', 'titulo', 'editora_id'], 'required'],
            [['titulo', 'editora_id'], 'required'],
            [['id', 'editora_id'], 'integer'],
            [['titulo'], 'string', 'max' => 255],
            [['localizacao'], 'string', 'max' => 255],
            [['numero_pagina'], 'integer'],
            [['capa'], 'file', 'extensions' => 'jpg, gif, jpeg, png'],
            [['id', 'editora_id'], 'unique', 'targetAttribute' => ['id', 'editora_id']],
            ['status_leitura','boolean','strict' => FALSE],
            [['data_cadastro', 'to_date'], 'date'],
            [['editora_id'], 'exist', 'skipOnError' => true, 'targetClass' => Editora::className(), 'targetAttribute' => ['editora_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
//            'id' => 'ID',
            'titulo' => 'Título',
            'numero_pagina' => 'Número de Páginas',
            'editora_id' => 'Editora',
            'status_leitura' => 'Livro lido',
            'capa' => 'capa',
            'localizacao' => 'localização',
            'data_cadastro' => 'Data do cadastro'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEditora() {
        return $this->hasOne(Editora::className(), [
                    'id' => 'editora_id'
                    
            ]);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLivroHasAutors() {
        return $this->hasMany(LivroHasAutor::className(), ['livro_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAutors() {
        return $this->hasMany(Autor::className(), ['id' => 'autor_id'])->viaTable('livro_has_autor', ['livro_id' => 'id']);
    }

}
