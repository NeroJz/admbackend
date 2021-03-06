<?php

namespace api\modules\v1\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\SocialMediaPlatform;

/**
 * SocialmediaPlatformSearch represents the model behind the search form about `backend\models\SocialmediaPlatform`.
 */
class SocialmediaPlatformSearch extends SocialmediaPlatform
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sp_id'], 'integer'],
            [['sp_logo', 'sp_name', 'sp_description'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = SocialmediaPlatform::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'sp_id' => $this->sp_id,
        ]);

        $query->andFilterWhere(['like', 'sp_logo', $this->sp_logo])
            ->andFilterWhere(['like', 'sp_name', $this->sp_name])
            ->andFilterWhere(['like', 'sp_description', $this->sp_description]);

        return $dataProvider;
    }
}
