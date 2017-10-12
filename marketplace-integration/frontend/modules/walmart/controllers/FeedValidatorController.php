<?php
namespace frontend\modules\walmart\controllers;

use Yii;
use yii\web\Controller;
use frontend\modules\walmart\components\XmlValidator;

class FeedValidatorController extends Controller
{
    public function actions()
    {
        $this->layout = 'main';
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionValidate()
    {
        $post = Yii::$app->request->post();
        if (isset($post['xmldata'])) {
            $xmldata = $post['xmldata'];

            $xmlPath = Yii::getAlias('@webroot') . '/frontend/modules/walmart/components/Xml/Feed.xml';
            $xsdPath = Yii::getAlias('@webroot') . '/frontend/modules/walmart/components/Xml/walmart_xsd/MPItemFeed.xsd';

            self::createXmlFile($xmldata, $xmlPath);

            $xmlValidator = new XmlValidator();

            $xmlValidator->setXMLFile($xmlPath);


            $xmlValidator->setXSDFile($xsdPath);
            try {
                if ($xmlValidator->validate()) {
                    return json_encode(['success' => true, 'message' => 'Xml Validated Successfully.']);
                }
            } catch (\Exception $e) {
                return json_encode(['error' => true, 'message' => $e->getMessage()]);
            }
        } else {
            return json_encode(['error' => true, 'message' => 'Invalid Xml Data.']);
        }
    }

    protected static function createXmlFile($xmlData, $path)
     {
         $fileOrig = fopen($path, 'w');
         fwrite($fileOrig, $xmlData);
         fclose($fileOrig);
     }

    //by shivam

    public static function createXmlFiles($xmlData, $path, $fileName='Feed.xml')
    {
        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }
        $filepath = $path.'/'.$fileName;

        $fileOrig = fopen($filepath, 'w');
        fwrite($fileOrig, $xmlData);
        fclose($fileOrig);
    }

    /* V3 Item xml validation */
    public function actionV3validator()
    {
        return $this->render('v3validator');
    }

    public function actionV3validate()
    {
        $post = Yii::$app->request->post();
        if (isset($post['xmldata'])) {
            $xmldata = $post['xmldata'];

            $xmlPath = Yii::getAlias('@webroot') . '/frontend/modules/walmart/components/Xml/v3feed.xml';
            $xsdPath = Yii::getAlias('@webroot') . '/frontend/modules/walmart/components/Xml/v3item_xsd/MPItemFeed.xsd';

            self::createXmlFile($xmldata, $xmlPath);

            $xmlValidator = new XmlValidator();

            $xmlValidator->setXMLFile($xmlPath);


            $xmlValidator->setXSDFile($xsdPath);
            try {
                if ($xmlValidator->validate()) {
                    return json_encode(['success' => true, 'message' => 'Xml Validated Successfully.']);
                }
            } catch (\Exception $e) {
                return json_encode(['error' => true, 'message' => $e->getMessage()]);
            }
        } else {
            return json_encode(['error' => true, 'message' => 'Invalid Xml Data.']);
        }
    }
}
