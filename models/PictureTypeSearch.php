<?php
namespace app\models;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PictureType;

/**
 * PictureTypeSearch represents the model behind the search form about `app\models\PictureType`.
 */
class PictureTypeSearch extends PictureType
{

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
                [
                        [
                                'picture_type_id',
                                'has_fixed_resolution',
                                'width',
                                'height'
                        ],
                        'integer'
                ],
                [
                        [
                                'class_name',
                                'folder',
                                'possible_formats',
                                'default_file_name',
                                'default_format'
                        ],
                        'safe'
                ]
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
        $query = PictureType::find();
        
        $dataProvider = new ActiveDataProvider([
                'query' => $query
        ]);
        
        $this->load($params);
        
        if (! $this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
        
        $query->andFilterWhere(
                [
                        'picture_type_id' => $this->picture_type_id,
                        'has_fixed_resolution' => $this->has_fixed_resolution,
                        'width' => $this->width,
                        'height' => $this->height,
                        'default_file_name' => $this->default_file_name,
                        'default_format' => $this->default_format
                ]);
        
        $query->andFilterWhere([
                'like',
                'class_name',
                $this->class_name
        ])
            ->andFilterWhere([
                'like',
                'folder',
                $this->folder
        ])
            ->andFilterWhere(
                [
                        'like',
                        'possible_formats',
                        $this->possible_formats
                ])
            ->andFilterWhere(
                [
                        'like',
                        'default_file_name',
                        $this->default_file_name
                ])
            ->andFilterWhere(
                [
                        'like',
                        'default_format',
                        $this->default_format
                ]);
        
        return $dataProvider;
    }
}
