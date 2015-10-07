<?php

namespace backend\models;

/**
 * This is the ActiveQuery class for [[WorkingInformation]].
 *
 * @see WorkingInformation
 */
class WorkingInformationQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return WorkingInformation[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return WorkingInformation|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}