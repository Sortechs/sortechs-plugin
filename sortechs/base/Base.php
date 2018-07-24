<?php
/**
 * Created by PhpStorm.
 * User: mohammad
 * Date: 7/19/18
 * Time: 3:00 PM
 */
namespace Sortechs\base;
class Base{



    public function render($view,array $params=[]){

        $render = new View();
        $render->render($view.'.twig',twig_array_merge($params,[
            'page_title'=>$this->getPageTitle(),
            'icon'=>SORTECHS_ICON,
            'logo'=>SORTECHS_LOGO,
        ]));
    }

    /**@var $page_title string*/
    private $page_title;

    /**
     * @return mixed
     */
    public function getPageTitle()
    {
        return $this->page_title;
    }

    /**
     * @param mixed $page_title
     */
    public function setPageTitle($page_title)
    {
        $this->page_title .=' | '. $page_title;
    }

    protected function test(){
        echo 'sad';
    }

}