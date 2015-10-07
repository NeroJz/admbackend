<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\University;

/**
 * UniversitySearch represents the model behind the search form about `backend\models\University`.
 */
class UniversitySearch extends University
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['uni_id', 'uni_status'], 'integer'],
            [['uni_code', 'uni_name'], 'safe'],
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
        $query = University::find();

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
            'uni_id' => $this->uni_id,
            'uni_status' => $this->uni_status,
        ]);

        $query->andFilterWhere(['like', 'uni_code', $this->uni_code])
            ->andFilterWhere(['like', 'uni_name', $this->uni_name]);

        return $dataProvider;
    }
}
