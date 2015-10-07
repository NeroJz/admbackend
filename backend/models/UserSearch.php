<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\User;

/**
 * UserSearch represents the model behind the search form about `backend\models\User`.
 */ 
class UserSearch extends User
{

    public $pi;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'pi_id', 'status', 'online_status', 'created_at', 'updated_at'], 'integer'],
            [['username','pi', 'auth_key', 'password_hash', 'password_reset_token'], 'safe'],
            
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
        $query = User::find();

        $query->joinWith('pi');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

       /* $query->andFilterWhere([
            'id' => $this->id,
            'pi_name' => $this->pi_id,
           // 'status' => $this->status,
           // 'online_status' => $this->online_status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);
        */

        $query->andFilterWhere(['like', 'personal_information.pi_name', $this->pi])
              ->andFilterWhere(['like', 'status', 10])
              ->andFilterWhere(['like', 'username', $this->username]);

        return $dataProvider;
    }


}
