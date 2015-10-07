<?php

namespace backend\models;

/**
 * This is the ActiveQuery class for [[RoomsConversations]].
 *
 * @see RoomsConversations
 */
class RoomsConversationsQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return RoomsConversations[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return RoomsConversations|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}