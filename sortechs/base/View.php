<?php
/**
 * Created by PhpStorm.
 * User: mohammad
 * Date: 7/19/18
 * Time: 2:11 PM
 */
namespace Sortechs\base;
use Twig_Environment;
use Twig_Loader_Filesystem;
class View{

    /**@var $twig Twig_Environment*/
    private $twig;

    public function __construct(){
        $loader = new Twig_Loader_Filesystem(SORTECHS__PLUGIN_DIR.'view/');
        $twig =  new Twig_Environment($loader);
        $this->setTwig($twig);
    }

    /**
     * @return Twig_Environment
     */
    public function getTwig(){
        return $this->twig;
    }

    /**
     * @param Twig_Environment $twig
     */
    public function setTwig($twig){
        $this->twig = $twig;
    }


    public function render($view,$params){
        echo $this->getTwig()->render($view,$params);
    }
}