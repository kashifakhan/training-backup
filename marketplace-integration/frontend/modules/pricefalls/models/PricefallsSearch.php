<?php

namespace frontend\modules\pricefalls\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\modules\pricefalls\models\Pricefalls;

/**
 * PricefallsSearch represents the model behind the search form about `frontend\modules\pricefalls\models\Pricefalls`.
 */
class PricefallsSearch extends Pricefalls
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['shopname', 'api_key', 'api_secret', 'token'], 'safe'],
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
        $query = Pricefalls::find();

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
            'id' => $this->id,
        ]);

        $query->andFilterWhere(['like', 'shopname', $this->shopname])
            ->andFilterWhere(['like', 'api_key', $this->api_key])
            ->andFilterWhere(['like', 'api_secret', $this->api_secret])
            ->andFilterWhere(['like', 'token', $this->token]);

        return $dataProvider;
    }
}
