<?php

namespace dashboard\models\searches;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use dashboard\models\PharmacyInventory;

/**
 * PharmacyInventorySearches represents the model behind the search form of `dashboard\models\PharmacyInventory`.
 */
class PharmacyInventorySearches extends PharmacyInventory
{
    /**
     * {@inheritdoc}
     */
    public $globalSearch;
    public function rules()
    {
        return [
            [['id', 'quantity', 'is_deleted', 'created_at', 'updated_at'], 'integer'],
            [['medicine_name', 'batch_number', 'expiry_date', 'manufacturer'], 'safe'],
            [['unit_price'], 'number'],
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
        $query = PharmacyInventory::find();

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
            'quantity' => $this->globalSearch,
            'expiry_date' => $this->globalSearch,
            'unit_price' => $this->globalSearch,
            'is_deleted' => $this->globalSearch,
            'created_at' => $this->globalSearch,
            'updated_at' => $this->globalSearch,
        ]);

        $query->orFilterWhere(['like', 'medicine_name', $this->globalSearch])
            ->orFilterWhere(['like', 'batch_number', $this->globalSearch])
            ->orFilterWhere(['like', 'manufacturer', $this->globalSearch]);
        }else{
                $query->andFilterWhere([
            'id' => $this->id,
            'quantity' => $this->quantity,
            'expiry_date' => $this->expiry_date,
            'unit_price' => $this->unit_price,
            'is_deleted' => $this->is_deleted,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'medicine_name', $this->medicine_name])
            ->andFilterWhere(['like', 'batch_number', $this->batch_number])
            ->andFilterWhere(['like', 'manufacturer', $this->manufacturer]);
        }
        return $dataProvider;
    }
}
