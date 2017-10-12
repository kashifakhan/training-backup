<?php

namespace frontend\modules\pricefalls\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\modules\pricefalls\models\PricefallsProducts;

/**
 * PricefallsProductsSearch represents the model behind the search form about `frontend\modules\pricefalls\models\PricefallsProducts`.
 */
class PricefallsProductsSearch extends PricefallsProducts
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'merchant_id', 'product_id', 'inventory'], 'integer'],
            [['title', 'description', 'images', 'created_at', 'updated_at'], 'safe'],
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
        $query = PricefallsProducts::find();

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
        $query->andFilterWhere([
            'merchant_id' => Yii::$app->user->identity->merchant_id,
        ]);
        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
           // 'merchant_id' => $this->merchant_id,
            'product_id' => $this->product_id,
            'inventory' => $this->inventory,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'images', $this->images]);

        return $dataProvider;
    }
}
