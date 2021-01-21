<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "books".
 *
 * @property int $id
 * @property int $id_authors
 * @property string $title
 * @property string $genre
 *
 * @property Authors $authors
 */
class Books extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'books';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_authors', 'title', 'genre'], 'required'],
            [['id_authors'], 'integer'],
            [['title', 'genre'], 'string', 'max' => 255],
            [['id_authors'], 'exist', 'skipOnError' => true, 'targetClass' => Authors::className(), 'targetAttribute' => ['id_authors' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_authors' => 'Id Authors',
            'title' => 'Title',
            'genre' => 'Genre',
        ];
    }

    /**
     * Gets query for [[Authors]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAuthors()
    {
        return $this->hasOne(Authors::className(), ['id' => 'id_authors']);
    }
}
