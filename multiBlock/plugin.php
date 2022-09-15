<?php
    class multiBlock extends Plugin {
        public function adminView(){
            global $security;
            $tokenCSRF = $security->getTokenCSRF();
 global $L;

            if(isset($_GET['addnew'])){

                include($this->phpPath().'php/addnew.php');


            }elseif(isset($_GET['newblock'])){

                include($this->phpPath().'php/newmultiblock.php');

      
            }elseIf(isset($_GET['createblock'])){



                include($this->phpPath().'php/newblock.php');






            }else{


                if(isset($_GET['allok'])){
                    echo' 
                    
<div class=" ok alert alert-success d-flex align-items-center" role="alert">

    <div>
        <b>'.$_GET['allok'].'</b> MultiBlock Category created!
    </div>
</div>


<script> setTimeout(()=>{document.querySelector(".ok").classList.remove("d-flex");document.querySelector(".ok").classList.add("d-none")},1500)

</script>


                    ';
                }


                include($this->phpPath().'php/category.php');
            }
            
            
         
            echo '<div class="bg-light col-md-12 my-3  d-flex py-2 justify-content-between text-center border">
      
            <p class="lead m-0">buy me ☕ if you want saw new plugins:)  </p>
            
            <a href="https://www.paypal.com/donate/?hosted_button_id=TW6PXVCTM5A72">
            <img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/btn/btn_donate_LG.gif"  />
            </a>
            
            </div> ';

            

        }



        public function adminSidebar()
        {

            global $L;

            $pluginName = Text::lowercase(__CLASS__);
            $url = HTML_PATH_ADMIN_ROOT.'plugin/'.$pluginName;
            
            $url2 = HTML_PATH_ADMIN_ROOT.'plugin/'.$pluginName.'?newblock';
            $html = '<a id="current-version" class="nav-link" href="'.$url2.'">'.$L->get('multiblock').' 🧱</a>';
            $html .= '<a id="current-version" class="nav-link" href="'.$url.'">'.$L->get('multiblocksettings').' 🧱</a>';

            return $html;

         
        }

  

    

        public function adminController(){

         
            

if(isset($_POST['savecat'])){

  
    $costa ='[';
     
        foreach ($_POST['label'] as $key => $value) {
         
            if($key > 0){
                $costa .= ',';
            }
    
            $costa .= json_encode([
                'key' => $key, 'title'=> $_POST['title'][$key],
                'label' => str_replace(" ","-",strtolower($_POST['label'][$key])),
                'value' => $_POST['value'][$key],
                'select' => $_POST['select'][$key],
            ],true);
         
    
    
        };
    
        $costa .=']';
     
    
        if(isset($_POST['savecat'])){
            $categoryname = str_replace(" ","-",$_POST['categoryname']);
        }else{
            $categoryname = str_replace(" ","-",$_GET['categoryname']);
        }
    
        $templatedata = @$_POST['template'];
    
    
    
        $folder        = PATH_CONTENT . '/multiBlock/category/';
    $filename      = $folder . $categoryname.'.json';
    $template    = $folder . $categoryname.'.txt';
    $chmod_mode    = 0755;
    $folder_exists = file_exists($folder) || mkdir($folder, $chmod_mode,true);
     
    // Save the file (assuming that the folder indeed exists)
    if ($folder_exists) {
      file_put_contents($filename, $costa);
      file_put_contents($template, $templatedata);
      //echo("<meta http-equiv='refresh' content='0'>");
    
    } if($_POST['check']!==$_POST['categoryname'] & !empty($_POST['check']) ){
     
        rename(PATH_CONTENT . '/multiBlock/category/'.str_replace(" ","-",$_POST['check']).'.json', PATH_CONTENT . '/multiBlock/category/'.str_replace(" ","-",$_POST['categoryname']).'.json');
        rename(PATH_CONTENT . '/multiBlock/category/'.str_replace(" ","-",$_POST['check']).'.txt', PATH_CONTENT . '/multiBlock/category/'.str_replace(" ","-",$_POST['categoryname']).'.txt');
    
    
    };
 
    
    
    
    
    };



    

if(isset($_GET['deletecat'])){
    
 

    unlink(PATH_CONTENT."multiBlock/category/".$_GET['deletecat'].".json");
    unlink(PATH_CONTENT."multiBlock/category/".$_GET['deletecat'].".txt");
   
    echo '<script> location.replace("'.DOMAIN.'/admin/plugin/multiblock");</script>';


    function removeDir($path) {
        $dir = new DirectoryIterator($path);
        foreach ($dir as $fileinfo) {
        if ($fileinfo->isFile() || $fileinfo->isLink()) {
        unlink($fileinfo->getPathName());
        } elseif (!$fileinfo->isDot() && $fileinfo->isDir()) {
        removeDir($fileinfo->getPathName());
        }
        }
        rmdir($path);
        }


        $katalog = PATH_CONTENT."multiBlock/".$_GET['deletecat']."/";
        removeDir($katalog);
    

};














$coner = 0;

if(isset($_POST['saveblock'])){

    $costa ='{';
 
    foreach ($_POST as $key => $value) {
     
        if($coner > 0){
            $costa .= ',';
        }

      $costa .= '"'.$key.'":"'.trim(preg_replace('/\s\s+/', ' ',htmlentities($value))).'"';
      

        $coner++;

    };

    $costa .='}';

    $owncategory = $_GET['newmulticategory'];

    $name = str_replace(" ","-", $_POST['name']);


$folder        = PATH_CONTENT . 'multiBlock/'.$owncategory.'/';
$filename      = $folder .$name.'.json';
$chmod_mode    = 0755;
$folder_exists = file_exists($folder) || mkdir($folder, $chmod_mode);
 
// Save the file (assuming that the folder indeed exists)
if ($folder_exists) {
  file_put_contents($filename, $costa);



} if($_POST['nameolder']!==''){ if($_POST['nameolder']!==$_POST['name']){
 
        rename($folder.str_replace(" ","-",$_POST['nameolder']).'.json', $folder.str_replace(" ","-",$_POST['name']).'.json');
        
        //echo("<meta http-equiv='refresh' content='0'>");

        };
}

 
//echo("<meta http-equiv='refresh' content='0'>");

}







if(isset($_GET['delthisbtn'])){

    
    unlink(PATH_CONTENT."multiBlock/".str_replace(" ","-",$_GET['newmulticategory'])."/".$_GET['delthis'].".json");
 
 
 
    
}





if(isset($_POST['saveorder'])){

 
    $owncategory = $_GET['newmulticategory'];
    $arrayinfo = $_POST['array'];

 

$folder        = PATH_CONTENT. 'multiBlock/'.$owncategory.'/';
$filename      = $folder.'order.txt';
$chmod_mode    = 0755;
$folder_exists = file_exists($folder) || mkdir($folder, $chmod_mode);
 
// Save the file (assuming that the folder indeed exists)
if ($folder_exists) {
  file_put_contents($filename, $arrayinfo);
 
}



};



       }

    };








//function






function getMultiBlock($category,$orderid=''){


	global $getmb;

	$getmb;


	$orders = @file_get_contents(GSDATAOTHERPATH.'multiBlock/'.$category.'/order.txt');
 
	 
	function mbOrder(){
		global $counterOrder; if($counterOrder==''){
			$counterOrder = 0;
		};

		echo "data-id='".$counterOrder."' ";
		$counterOrder++;
	
	};



	function mbvaluetext($value){
  global $getmb;
			echo $getmb->$value;	
		 
	 };
	
	
	function mbvalue($value){
  
		global $getmb;
		echo html_entity_decode( $getmb->$value);	
	 
	 };
	
 
 
    foreach (glob(PATH_CONTENT."multiBlock/".$category."/*.json") as $mbBlock) {
$info = pathinfo($mbBlock);
        $name = basename($mbBlock,'.'.$info['extension']);
        $template = PATH_CONTENT.'multiBlock/category/'.$category.'.txt';
 
 
		$mbjson = file_get_contents($mbBlock);
  
		global $getmb;
	
		$getmb = json_decode($mbjson);
		
	
	include($template); } if($orderid!==''){

	echo"
<script>

const arraylist = '".@file_get_contents(PATH_CONTENT . 'multiBlock/'.$category.'/order.txt')."';
 
const arraychange = arraylist.split(','); arraychange.forEach((x,i)=>{
if(document.querySelector(`".$orderid." [data-id='`+x+`']`)!== null){
  document.querySelector('".$orderid."').append(document.querySelector(`[data-id='`+x+`']`)); 
} 
 });

</script>";
		

	}



};







?>