<?php

namespace frontend\modules\pricefalls\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\modules\pricefalls\models\PricefallsProductVariants;

/**
 * PricefallsProductVariantsSearch represents the model behind the search form about `frontend\modules\pricefalls\models\PricefallsProductVariants`.
 */
class PricefallsProductVariantsSearch extends PricefallsProductVariants
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'merchant_id', 'product_id', 'variant_id', 'barcode'], 'integer'],
            [['title', 'description', 'price', 'status', 'attribute_options', 'weight_unit', 'image', 'created_at', 'updated_at'], 'safe'],
            [['weight'], 'number'],
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
        $query = PricefallsProductVariants::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'merchant_id' => $this->merchant_id,
            'product_id' => $this->product_id,
            'variant_id' => $this->variant_id,
            'weight' => $this->weight,
            'barcode' => $this->barcode,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'price', $this->price])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'attribute_options', $this->attribute_options])
            ->andFilterWhere(['like', 'weight_unit', $this->weight_unit])
            ->andFilterWhere(['like', 'image', $this->image]);

        return $dataProvider;
    }
}
