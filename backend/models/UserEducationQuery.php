<?php

namespace backend\models;

/**
 * This is the ActiveQuery class for [[UserEducation]].
 *
 * @see UserEducation
 */
class UserEducationQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return UserEducation[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return UserEducation|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}