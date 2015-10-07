<?php

namespace backend\models;

/**
 * This is the ActiveQuery class for [[PersonalInformation]].
 *
 * @see PersonalInformation
 */
class PersonalInformationQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return PersonalInformation[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return PersonalInformation|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}