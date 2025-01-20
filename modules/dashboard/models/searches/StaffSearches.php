<?php

namespace dashboard\models\searches;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use dashboard\models\Staff;

/**
 * StaffSearches represents the model behind the search form of `dashboard\models\Staff`.
 */
class StaffSearches extends Staff
{
    /**
     * {@inheritdoc}
     */
    public $globalSearch;
    public function rules()
    {
        return [
            [['id', 'department_id', 'is_deleted', 'created_at', 'updated_at'], 'integer'],
            [['first_name', 'last_name', 'phone', 'email', 'address', 'role'], 'safe'],
            ['globalSearch', 'safe']
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = Staff::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [ 'defaultPageSize' => \Yii::$app->params['defaultPageSize'], 'pageSizeLimit' => [1, \Yii::$app->params['pageSizeLimit']]],
            'sort'=> ['defaultOrder' => ['created_at'=>SORT_DESC]]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        if(isset($this->globalSearch)){
                $query->orFilterWhere([
            'id' => $this->globalSearch,
            'department_id' => $this->globalSearch,
            'is_deleted' => $this->globalSearch,
            'created_at' => $this->globalSearch,
            'updated_at' => $this->globalSearch,
        ]);

        $query->orFilterWhere(['like', 'first_name', $this->globalSearch])
            ->orFilterWhere(['like', 'last_name', $this->globalSearch])
            ->orFilterWhere(['like', 'phone', $this->globalSearch])
            ->orFilterWhere(['like', 'email', $this->globalSearch])
            ->orFilterWhere(['like', 'address', $this->globalSearch])
            ->orFilterWhere(['like', 'role', $this->globalSearch]);
        }else{
                $query->andFilterWhere([
            'id' => $this->id,
            'department_id' => $this->department_id,
            'is_deleted' => $this->is_deleted,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'first_name', $this->first_name])
            ->andFilterWhere(['like', 'last_name', $this->last_name])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'role', $this->role]);
        }
        return $dataProvider;
    }
}
