<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\WorkingInformation;

/**
 * WorkingInformationSearch represents the model behind the search form about `backend\models\WorkingInformation`.
 */
class WorkingInformationSearch extends WorkingInformation
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['wi_id'], 'integer'],
            [['wi_company_name', 'wi_position', 'wi_year_of_service_from', 'wi_year_of_service_to'], 'safe'],
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
        $query = WorkingInformation::find();

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
            'wi_id' => $this->wi_id,
        ]);

        $query->andFilterWhere(['like', 'wi_company_name', $this->wi_company_name])
            ->andFilterWhere(['like', 'wi_position', $this->wi_position])
            ->andFilterWhere(['like', 'wi_year_of_service_from', $this->wi_year_of_service_from])
            ->andFilterWhere(['like', 'wi_year_of_service_to', $this->wi_year_of_service_to]);

        return $dataProvider;
    }
}
