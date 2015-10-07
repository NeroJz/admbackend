<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\JobSpecialisation;

/**
 * JobSpecialisationSearch represents the model behind the search form about `backend\models\JobSpecialisation`.
 */
class JobSpecialisationSearch extends JobSpecialisation
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['js_id', 'js_status'], 'integer'],
            [['js_name'], 'safe'],
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
        $query = JobSpecialisation::find();

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
            'js_id' => $this->js_id,
            'js_status' => $this->js_status,
        ]);

        $query->andFilterWhere(['like', 'js_name', $this->js_name]);

        return $dataProvider;
    }
}
