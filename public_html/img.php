<?php
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL); 
include_once("gd/ThumbLib.inc.php");
include_once("gd/GdThumb.inc.php");


$sFIle = $_GET["file"]; 
$sFIle = explode(",", $sFIle); 
$nMode = $sFIle[0]; 
$nPath = $sFIle[1]; 
$nFile = $sFIle[2];
$nW = $sFIle[3];
$nH = $sFIle[4];
if(isset($sFIle[5])){
  $wm = $sFIle[5];
}



if ($nPath==1){$nPath="uploads/content";}
if ($nPath==2){$nPath="uploads";}
$PathFile = "$nPath/$nFile";
  $thumb = PhpThumbFactory::create($PathFile);
  if ($nMode==2){$thumb->adaptiveResize($nW, $nH);}
  if(isset($wm)){
      // $thumb->showWatermask();
      
  }else{
      $thumb->show();

  }
  //$thumb->save("images/imgCache/".$nFile);


/*if(file_exists("images/imgCache/".$nFile) and $nFile!="no_photo.jpg"){
  $thumb = PhpThumbFactory::create("images/imgCache/".$nFile);
  $thumb->showCache("images/imgCache/".$nFile);
}else{
  $thumb = PhpThumbFactory::create($PathFile);
  if ($nMode==1){$thumb->cropFromCenter($nW, $nH);}
  elseif ($nMode==2){$thumb->adaptiveResize($nW, $nH);}
  if(isset($wm)){
      $thumb->showWatermask();
      
  }else{
      $thumb->show();

  }
  $thumb->save("images/imgCache/".$nFile);
}*/







?>