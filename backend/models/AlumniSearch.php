<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Alumni;

/**
 * AlumniSearch represents the model behind the search form about `backend\models\Alumni`.
 */
class AlumniSearch extends Alumni
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['alumni_id', 'e_jantina'], 'integer'],
            [['e_nama', 'e_kp', 'e_alamat', 'e_poskod', 'e_alamat_tetap', 'e_poskod_tetap', 'e_tel_rumah', 'e_tel_hp', 'e_emel1', 'e_emel2', 'e_program', 'e_fakulti', 'e_tahun_tamat'], 'safe'],
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
        $query = Alumni::find();

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
            'alumni_id' => $this->alumni_id,
            'e_jantina' => $this->e_jantina,
        ]);

        $query->andFilterWhere(['like', 'e_nama', $this->e_nama])
            ->andFilterWhere(['like', 'e_kp', $this->e_kp])
            ->andFilterWhere(['like', 'e_alamat', $this->e_alamat])
            ->andFilterWhere(['like', 'e_poskod', $this->e_poskod])
            ->andFilterWhere(['like', 'e_alamat_tetap', $this->e_alamat_tetap])
            ->andFilterWhere(['like', 'e_poskod_tetap', $this->e_poskod_tetap])
            ->andFilterWhere(['like', 'e_tel_rumah', $this->e_tel_rumah])
            ->andFilterWhere(['like', 'e_tel_hp', $this->e_tel_hp])
            ->andFilterWhere(['like', 'e_emel1', $this->e_emel1])
            ->andFilterWhere(['like', 'e_emel2', $this->e_emel2])
            ->andFilterWhere(['like', 'e_program', $this->e_program])
            ->andFilterWhere(['like', 'e_fakulti', $this->e_fakulti])
            ->andFilterWhere(['like', 'e_tahun_tamat', $this->e_tahun_tamat]);

        return $dataProvider;
    }
}
