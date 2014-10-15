<?php
$players = glob('/home/minecraft/minecraft_server/world/playerdata/*.dat');
foreach($players as $p){
    $uuid = str_replace("-","",substr($p, strrpos($p,'/')+1,-4));
    $data = file_get_contents("https://sessionserver.mojang.com/session/minecraft/profile/$uuid");
    $profile = json_decode($data);
    //var_dump($profile);
    if(isset($profile->id)){
        echo "{$profile->id} = {$profile->name}\n";
        //http://overviewer.org/avatar/$profile->name
    }
}
