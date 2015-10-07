<?php

namespace api\modules\v1\models;

/**
 * This is the ActiveQuery class for [[MessageRooms]].
 *
 * @see MessageRooms
 */
class MessageRoomsQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return MessageRooms[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return MessageRooms|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}