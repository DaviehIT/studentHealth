<?php

namespace dashboard\models\searches;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use dashboard\models\MedicalRecords;

/**
 * MedicalRecordsSearches represents the model behind the search form of `dashboard\models\MedicalRecords`.
 */
class MedicalRecordsSearches extends MedicalRecords
{
    /**
     * {@inheritdoc}
     */
    public $globalSearch;
    public function rules()
    {
        return [
            [['id', 'patient_id', 'staff_id', 'is_deleted', 'created_at', 'updated_at'], 'integer'],
            [['diagnosis', 'treatment', 'prescription'], 'safe'],
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
        $query = MedicalRecords::find();

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
            'patient_id' => $this->globalSearch,
            'staff_id' => $this->globalSearch,
            'is_deleted' => $this->globalSearch,
            'created_at' => $this->globalSearch,
            'updated_at' => $this->globalSearch,
        ]);

        $query->orFilterWhere(['like', 'diagnosis', $this->globalSearch])
            ->orFilterWhere(['like', 'treatment', $this->globalSearch])
            ->orFilterWhere(['like', 'prescription', $this->globalSearch]);
        }else{
                $query->andFilterWhere([
            'id' => $this->id,
            'patient_id' => $this->patient_id,
            'staff_id' => $this->staff_id,
            'is_deleted' => $this->is_deleted,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'diagnosis', $this->diagnosis])
            ->andFilterWhere(['like', 'treatment', $this->treatment])
            ->andFilterWhere(['like', 'prescription', $this->prescription]);
        }
        return $dataProvider;
    }
}
