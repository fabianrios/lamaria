<?php

  $tmp_name = $_FILES["file"]["tmp_name"];
  $name = $_FILES["file"]["name"];
  $type = $_FILES["file"]["type"];
  $uploaddir = 'uploads';
  $size = $_FILES["file"]["size"];
  
if ($_FILES["file"]["error"] > 0)
  {
  echo "Error: " . $_FILES["file"]["error"] . "<br />";
  }
else
  {
  echo "Upload: " . $name . "<br />";
  echo "Type: " . $type . "<br />";
  echo "Size: " . display_filesize($size);
  echo " TempStored in: " . $tmp_name;
	  if(move_uploaded_file($tmp_name, "$uploaddir/$name")){
	  	echo "File transfer succesfull.";
	  }
  }

function display_filesize($filesize){
    
    if(is_numeric($filesize)){
    $decr = 1024; $step = 0;
    $prefix = array('Byte','KB','MB','GB','TB','PB');
        
    while(($filesize / $decr) > 0.9){
        $filesize = $filesize / $decr;
        $step++;
    } 
    return round($filesize,2).' '.$prefix[$step];
    } else {

    return 'NaN';
    }
    
}

	$handle = opendir(dirname(realpath(__FILE__)).'/'.$uploaddir.'/');

	while($file = readdir($handle)){
		if($file !== '.' && $file !== '..' && $file !== '.com.apple.timemachine.supported' && $file !== '.DS_Store'){
			echo '<img src="'.$uploaddir.'/'.$file.'" border="0" />';
		}
	}

?>


