<?php 
namespace frontend\modules\walmart\components;

use frontend\modules\walmart\controllers\FeedValidatorController;
use yii\base\Component;
use frontend\modules\walmart\components\Data;
use frontend\modules\walmart\models\WalmartAttributeMap;
use Yii;

class WalmartProductValidate extends Component
{
	const MIN_LENGTH_SKU = 1;
	const MAX_LENGTH_SKU = 50;
	const MIN_LENGTH_NAME = 1;
	const MAX_LENGTH_NAME = 200;
	const MAX_LENGTH_BRAND = 60;
    const MAX_LENGTH_LONG_DESCRIPTION = 4000;

	public static function checkProductBeforeUpload($productUploadData, $productData, $categoryData)
	{
		$categoryId = $productData['category'];
		if($categoryData['parent_id'] != '0')
			$categoryId = $categoryData['parent_id'];

		//check if variantAttributeNames are present in the variant product
		if(isset($productUploadData['Product'][$categoryId]['variantAttributeNames']))
		{
			$variantAttributeNames = $productUploadData['Product'][$categoryId]['variantAttributeNames'];
			if(isset($variantAttributeNames['_value']) && !count($variantAttributeNames['_value']))
			{
				return ["status"=>false, "message"=>"Value for Attribute 'variantAttributeNames' is Missing"];
			}
		}
		
		if($categoryData && count($categoryData['attributes']))
		{
			$required_attributes = $categoryData['attributes'];
			$category_id = $productData['category'];
			$parent_id = '';
			if($categoryData['parent_id'] != '0')
				$parent_id = $categoryData['parent_id'];

			if($parent_id == '')
			{
				if(isset($productUploadData['Product'][$category_id]))
				{
					foreach ($required_attributes as $code=>$attribute) 
					{
						if(!in_array($code, $categoryData['required_attrs']))
							continue;

						if(is_array($attribute))
						{
							$data = $productUploadData['Product'][$category_id];
							foreach ($attribute as $key => $value) {
								if(isset($data[$value]))
								{
									$data = $data[$value];
									continue;
								}
								else
								{
									return ["status"=>false, "message"=>"Value for Attribute ".addslashes(implode('/', $attribute))." is Missing"];
								}
							}
						}
						else
						{
							if(isset($productUploadData['Product'][$category_id][$attribute]))
							{
								continue;
							}
							else
							{
								return ["status"=>false, "message"=>"Value for Attribute '".addslashes($attribute)."' is Missing"];
							}
						}
					}
				}
				else
				{
					return ["status"=>false, "message"=>"Category Node '".addslashes($category_id)."' is Missing"];
				}
				return ["status"=>true];
			}
			else
			{
				if(isset($productUploadData['Product'][$parent_id]) && 
					isset($productUploadData['Product'][$parent_id][$category_id]))
				{
					foreach ($required_attributes as $code=>$attribute)
					{
						if(!in_array($code, $categoryData['required_attrs']))
							continue;

						if(is_array($attribute))
						{
							$data = $productUploadData['Product'][$parent_id];
							foreach ($attribute as $key => $value) {
								if(isset($data[$value]))
								{
									$data = $data[$value];
									continue;
								}
								elseif(isset($data[$category_id][$value]))
								{
									$data = $data[$category_id][$value];
									continue;
								}
								else
								{
									return ["status"=>false, "message"=>"Value for Attribute ".addslashes(implode('/', $attribute))." is Missing"];
								}
							}
						}
						else
						{
							if(isset($productUploadData['Product'][$parent_id][$category_id][$attribute]) || 
								isset($productUploadData['Product'][$parent_id][$attribute]))
							{
								continue;
							}
							else
							{
								return ["status"=>false, "message"=>"Value for Attribute '".addslashes($attribute)."' is Missing"];
							}
						}
					}
				}
				else
				{
					return ["status"=>false, "message"=>"Category Node '".addslashes($parent_id)."' OR '".addslashes($category_id)."' is Missing"];
				}
				return ["status"=>true];
			}
		}
		else
		{
			return ["status"=>true];
		}
	}

	/*public static function getWalmartCategoryData($category_id, $flag=false)
	{
		$query = 'SELECT `title`,`parent_id`,`attributes`,`attribute_values` FROM `walmart_category` WHERE `category_id`="'.$category_id.'" LIMIT 0,1';
        $records = Data::sqlRecords($query, 'one');
        
        if($records)
        {
            $attributes = [];
            if($records['attributes'] != '') {
                $_attributes = json_decode($records['attributes'], true);

                foreach ($_attributes as $_value) {
                    if(is_array($_value)) {
                        $key = key($_value);

                        $attr_id = $key;
                        $sub_attr = reset($_value);
                        if(is_array($sub_attr)) {
                            foreach ($sub_attr as $wal_attr_code) {
                                if($wal_attr_code != $key){
                                    $attr_id .= '->'.$wal_attr_code;
                                }
                            }
                        }

                        $attributes[$attr_id] = $_value[$key];
                    }
                    else {
                        $attributes[$_value] = $_value;
                    }
                }
            }

            if($flag)
            	return $attributes;

            if($records['parent_id'] != '0')
            {
            	$parentCatReqAttr = self::getWalmartCategoryData($records['parent_id'], true);
            	$attributes['parent'] = ['id'=>$records['parent_id'], 'required_attributes'=>$parentCatReqAttr];
            }
            return $attributes;
        }
        else
        {
        	return false;
        }
	}*/

	public static function validateProductXml($productData,$uploadType ="MPItem")
    {
        $timeStamp = (string)time();
        $productToUpload = [
            'MPItemFeed' => [
                '_attribute' => [
                    'xmlns' => 'http://walmart.com/',
                    'xmlns:xsi' => 'http://www.w3.org/2001/XMLSchema-instance',
                    'xsi:schemaLocation' => 'http://walmart.com/ MPItem.xsd',
                ],
                '_value' => [
                    0 => [
                        'MPItemFeedHeader' => [
                            'version' => '2.1',
                            'requestId' => $timeStamp,
                            'requestBatchId' => $timeStamp,
                        ],
                    ]

                ],
            ]
        ];

        $productToUpload['MPItemFeed']['_value'][1][$uploadType] = $productData;

        $xml = new Generator();
        $xml->arrayToXml($productToUpload);

        $xmlPath = Yii::getAlias('@webroot').'/var/Xml/'.MERCHANT_ID;
        $xsdPath = Yii::getAlias('@webroot').'/frontend/modules/walmart/components/Xml/walmart_xsd/MPItemFeed.xsd';

        FeedValidatorController::createXmlFiles($xml, $xmlPath);

        $path = $xmlPath.'/'.'Feed.xml';

        $xmlValidator = new XmlValidator();

        $xmlValidator->setXMLFile($path);

        $xmlValidator->setXSDFile($xsdPath);
        try {
            if($xmlValidator->validate()) {

                return ['status'=>true];
            }
        } catch(\Exception $e) {
            return ['error'=>true, 'message'=>$e->getMessage()];
        }

    }

    public static function validatev3ProductXml($productData)
    {
        $timeStamp = (string)time();
        $productToUpload = [
            'MPItemFeed' => [
                '_attribute' => [
                    'xmlns' => 'http://walmart.com/'
                ],
                '_value' => [
                    0 => [
                        'MPItemFeedHeader' => [
                            'version' => '3.1',
                            'requestId' => $timeStamp,
                            'requestBatchId' => $timeStamp,
                        ]
                    ]
                ]
            ]
        ];

        $productToUpload['MPItemFeed']['_value'][1]['MPItem'] = $productData;

        $xml = new Generator();
        $xml->arrayToXml($productToUpload);

        /*$xmlPath = Yii::getAlias('@webroot').'/var/Xml/'.MERCHANT_ID;
        $fileName = 'v3feed.xml';
        FeedValidatorController::createXmlFiles($xml, $xmlPath, $fileName);
        $xml = $xmlPath.'/'.$fileName;*/

        $xml = $xml->__toString();

        $xsdPath = Yii::getAlias('@webroot').'/frontend/modules/walmart/components/Xml/v3item_xsd/MPItemFeed.xsd';

        $xmlValidator = new XmlValidator();

        //$xmlValidator->setXMLFile($xml);
        $xmlValidator->setXMLString($xml);

        $xmlValidator->setXSDFile($xsdPath);
        try {
        	//if($xmlValidator->validate()) {
        	if($xmlValidator->validateString()) {
                return ['status'=>true];
            }
        } catch(\Exception $e) {
            return ['status'=>false, 'error'=>$e->getMessage()];
        }

    }
}