<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\EducationLevel;

/**
 * EducationLevelSearch represents the model behind the search form about `backend\models\EducationLevel`.
 */
class EducationLevelSearch extends EducationLevel
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['el_id'], 'integer'],
            [['el_code', 'el_name'], 'safe'],
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
        $query = EducationLevel::find();

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
            'el_id' => $this->el_id,
        ]);

        $query->andFilterWhere(['like', 'el_code', $this->el_code])
            ->andFilterWhere(['like', 'el_name', $this->el_name]);

        return $dataProvider;
    }
}
