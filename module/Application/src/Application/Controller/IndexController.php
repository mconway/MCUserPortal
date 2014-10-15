<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController
{
    public function indexAction()
    {
        $players = $this->getPlayerList();
        return new ViewModel(array('players' => $players));
    }

    private function getPlayerList(){
        $players = glob('/home/minecraft/minecraft_server/world/playerdata/*.dat');
	$playerList = array();
        foreach($players as $p){
            $uuid = str_replace("-","",substr($p, strrpos($p,'/')+1,-4));
            $data = file_get_contents("https://sessionserver.mojang.com/session/minecraft/profile/$uuid");
            $profile = json_decode($data);
            //var_dump($data);
            if(isset($profile->id)){
                $playerList[$profile->id] = $profile->name; 
                //echo "{$profile->id} = {$profile->name}\n";
            //    //http://overviewer.org/avatar/$profile->name
            }
        }
        return $playerList;
    }
}
