<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "post".
 *
 * @property integer $id
 * @property string $title
 * @property string $lead_photo
 * @property string $lead_text
 * @property string $content
 * @property string $created_at
 * @property string $updated_at
 * @property integer $category_id
 * @property integer $view_count
 * @property integer $on_top
 * @property integer $comments_count
 * @property integer $status
 * @property integer $sort
 *
 * @property Category $category
 * @property PostTag[] $postTags
 */
class Post extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'post';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'content', 'category_id'], 'required'],
            [['lead_text', 'content'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['category_id', 'view_count', 'on_top', 'comments_count', 'status', 'sort'], 'integer'],
            [['title'], 'string', 'max' => 128],
            [['lead_photo'], 'string', 'max' => 500],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['category_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'lead_photo' => 'Lead Photo',
            'lead_text' => 'Lead Text',
            'content' => 'Content',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'category_id' => 'Category ID',
            'view_count' => 'View Count',
            'on_top' => 'On Top',
            'comments_count' => 'Comments Count',
            'status' => 'Status',
            'sort' => 'Sort',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPostTags()
    {
        return null;//$this->hasMany(PostTag::className(), ['post_id' => 'id']);
    }
}
