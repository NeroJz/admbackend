<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Socialmedia;

/**
 * SocialmediaSearch represents the model behind the search form about `backend\models\Socialmedia`.
 */
class SocialmediaSearch extends Socialmedia
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sm_id', 'sp_id'], 'integer'],
            [['sm_content'], 'safe'],
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
        $query = Socialmedia::find();

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
            'sm_id' => $this->sm_id,
            'sp_id' => $this->sp_id,
        ]);

        $query->andFilterWhere(['like', 'sm_content', $this->sm_content]);

        return $dataProvider;
    }
}
