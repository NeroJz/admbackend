<?php


namespace api\modules\v1\models;

/**
 * This is the ActiveQuery class for [[UserSocialmedia]].
 *
 * @see UserSocialmedia
 */
class UserSocialmediaQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return UserSocialmedia[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return UserSocialmedia|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}