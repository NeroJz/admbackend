<?php

namespace api\modules\v1\models;

/**
 * This is the ActiveQuery class for [[SocialMedia]].
 *
 * @see SocialMedia
 */
class SocialMediaQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return SocialMedia[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return SocialMedia|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}