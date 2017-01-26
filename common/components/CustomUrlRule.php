<?php
namespace common\components;
use Yii;
use yii\web\UrlRule;
use yii\web\UrlRuleInterface;
use common\models\Categorie;
use common\models\Site;
use common\models\Country;
use common\models\Review;


class CustomUrlRule extends UrlRule
{
    public $countries;
    public function parseRequest($manager, $request)
    {

        $this->countries = Country::find()->asArray()->all();
        $request->setUrl(mb_strtolower($request->getUrl()));
        $request->setPathInfo(mb_strtolower($request->getPathInfo()));

        if (substr_count($request->getUrl(),'/') == 1) {
            $request->setUrl($request->getUrl().'/');
            $request->setPathInfo($request->getPathInfo().'/');
        }

         
        if (substr_count($request->getUrl(),'/') != 2) {
            $request->setUrl(rtrim($request->getUrl(), '/'));
            $request->setPathInfo(rtrim($request->getPathInfo(), '/'));
        }
   
        $id = null;
        $countryId = 0;
        $filter_by= 1;
     
        $return = parent::parseRequest($manager, $request);
        
        $category = $return[1]['controller'];
        $slug = $return[1]['controller'];
        $sort = $return[1]['action'];

        foreach(Categorie::find()->asArray()->all() as $categorie) {

            if (mb_strtolower($categorie['title']) == $category) {

                $return[0] = 'site/category';
                switch ($sort) {
                    case null:
                    $filter_by = 1;
                    break;
                    case '':
                    $filter_by = 1;
                    break;
                    case 'no-deposit':
                    $filter_by = 0;
                    break;
                    case 'codes':
                    $filter_by = 2;
                    break;
                    default:
                        foreach(Review::find()->asArray()->all() as $review) {
                            if ($sort) {
                                if ((mb_strtolower($review['slug']) === $sort)&&($review['category_id'] == $categorie['id'])&&($review['type'] == 1))
                                {

                                    $return[0] = 'site/review';
                                    $request->queryParams = ['id'=> $review['id']];
                                    break 3;
                                }
                            }
                        }
                }
                
                $request->queryParams = ['id'=> $categorie['id'],'filter_by' => $filter_by, 'sort_by' => '1', 'os_id' => '0'];

                if (!empty($this->countries)) {

                    $ip = Yii::$app->geoip->ip($_SERVER['HTTP_X_REAL_IP']);
                    foreach ($this->countries as $country) {
                       if ($ip->country == $country['title']) {
                            $countryId = $country['id'];
                        }
                    }
                }

                $request->queryParams = ['id'=> $categorie['id'],'filter_by' => $filter_by, 'sort_by' => '1', 'country_id' => $countryId ,'os_id' => '0'];
                break;
            }
            if ($category != null)
            {
                $return[0] = $category.'/'.$sort;
            }

        }

        foreach(Review::find()->asArray()->all() as $review) {

            if ($slug) {
                if ((mb_strtolower($review['slug']) === $slug)&&($review['type'] == 2))
                {
                    $return[0] = 'site/review';
                    $request->queryParams = ['id'=> $review['id']];
                    break;
                }
            }

            //if ($slug != null)
            //{
            //   $return[0] = $slug.'/'.$sort;
            /// }

        }

        foreach(Site::find()->asArray()->all() as $site) {

            if (mb_strtolower($site['slug']) == $category) {
                if  ((mb_strtolower($category) == 'sitemap')||(mb_strtolower($category) == 'contact')) {
                    $return[0] = 'site/'.mb_strtolower($category);
                } else {
                    $return[0] = 'site/page';
                    $request->queryParams = ['category'=> mb_strtolower($site['category']),'slug' => $return[1]['controller']];
                 }
                break;
            }
        }

        return $return;
    }
}
