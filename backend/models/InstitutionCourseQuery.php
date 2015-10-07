<?php

namespace backend\models;

/**
 * This is the ActiveQuery class for [[InstitutionCourse]].
 *
 * @see InstitutionCourse
 */
class InstitutionCourseQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return InstitutionCourse[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return InstitutionCourse|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}