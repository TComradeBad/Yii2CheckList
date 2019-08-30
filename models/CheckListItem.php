<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "check_list_item".
 *
 * @property int $id
 * @property int $check_list_id
 * @property string $name
 * @property int $done
 * @property string $created_at
 *
 * @property CheckList $checkList
 */
class CheckListItem extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'check_list_item';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['check_list_id', 'done'], 'integer'],
            [['created_at'], 'safe'],
            [['name'], 'string', 'max' => 255],
            [['check_list_id'], 'exist', 'skipOnError' => true, 'targetClass' => CheckList::className(), 'targetAttribute' => ['check_list_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'check_list_id' => 'Check List ID',
            'name' => 'Name',
            'done' => 'Done',
            'created_at' => 'Created At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCheckList()
    {
        return $this->hasOne(CheckList::className(), ['id' => 'check_list_id']);
    }
}
