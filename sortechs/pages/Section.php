<?php
/**
 * Created by PhpStorm.
 * User: mohammad
 * Date: 7/19/18
 * Time: 8:17 PM
 */
namespace Sortechs\pages;
use Sortechs\base\Base;
use Sortechs\base\Model;
use Sortechs\base\Sections;
use Sortechs\Helpers\Arrays;

class Section extends Base{

    public function section(){
        $params = [];
        $this->setPageTitle('Sections');
        $credentials = Model::get_credentials();
        if(!empty($credentials)){
            if(isset($_POST) and isset($_POST['category'])){
                $section = new Sections();
                foreach ($_POST['category'] as $item) {
                    $cat =get_the_category_by_ID($item);
                    if(!empty($cat)){
                          $response =$section->addSection($cat);
                          if(isset($response->response->section->created) and $response->response->section->created){
                              $sortechs_id = $response->response->section->data->id;
                              Model::create_add_new_category($item,$sortechs_id);
                          }
                    }
                }
            }

            $category = Arrays::convert_object_to_array(get_categories());
            $sortechs_cat = Model::get_sortechs_category();
            $category = Arrays::category_helper_checker($category,$sortechs_cat);
            $params['categorys'] = $category;
            $this->render('section',$params);
        }else{
            $this->render('not_authorization');
        }
    }
}