<?php

namespace backend\models;

/**
 * This is the ActiveQuery class for [[UserWorking]].
 *
 * @see UserWorking
 */
class UserWorkingQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return UserWorking[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return UserWorking|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}