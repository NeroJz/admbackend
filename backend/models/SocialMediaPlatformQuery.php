<?php

namespace backend\models;

/**
 * This is the ActiveQuery class for [[SocialmediaPlatform]].
 *
 * @see SocialmediaPlatform
 */
class SocialmediaPlatformQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return SocialmediaPlatform[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return SocialmediaPlatform|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}