<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Institution;

/**
 * InstitutionSearch represents the model behind the search form about `backend\models\Institution`.
 */
class InstitutionSearch extends Institution
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['inst_id'], 'integer'],
            [['inst_code', 'inst_name'], 'safe'],
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
        $query = Institution::find();

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
            'inst_id' => $this->inst_id,
        ]);

        $query->andFilterWhere(['like', 'inst_code', $this->inst_code])
            ->andFilterWhere(['like', 'inst_name', $this->inst_name]);

        return $dataProvider;
    }
}
