<?php 

global $L;

;?>

<style>


 

.mb_catlist{
display: flex;
flex-direction: column;
margin-top: 40px;
margin: 0 !important;
padding: 0 !important;
}

.mb_catlist li{
    display: flex;
    justify-content: space-between;
    align-items: center;
padding: 10px;
}

.mb_catlist p{
    font-size:15px;
    margin: 0 !important;  
    padding: 0 !important;
    font-weight: 400;
}

.mb_catlist li:nth-child(odd){
    background: #ddd;
}

.mb_edit{
    height:40px;
    margin: 0 !important;

}


</style>

<h3>MultiBlock</h3>

 <form method="get" action="#" class="mb-3" >
<input type="hidden" name="addnew">
 <input type="submit" value="<?php echo $L->get("add-new-btn2");?> ➕" class="mb_add btn btn-primary btn-lg">
</form>
 

<ul class="mb_catlist">
    

    <?php 

foreach (glob(PATH_CONTENT."/multiBlock/category/*.json") as $filename) {
 
 
 
    $info = pathinfo($filename);
    echo '<li><p>'.str_replace('-',' ',basename($filename,'.'.$info['extension'])).'</p> <div style="
    display: flex;
align-items: center;
gap: 5px;
    "> 
    <form method="get" class="d-inline-block">

    <input  type="hidden" name="addnew">
    <input type="hidden" name="categoryname" value="'.basename($filename,'.'.$info['extension']).'">
    <input  class="mb_edit btn btn-primary" type="submit" value="'.$L->get("edit").'">
    </form>


    <form method="get" action="#" onclick="return confirm(`Are you sure?`);" style="display:inline-flex" >
  <input type="hidden" name="deletecat" value="'.basename($filename,'.'.$info['extension']).'">
    <input type="submit" value="'.$L->get("delete").'" class="mb_edit mb_edit_delete btn btn-danger"> 
    </form>
    </div>
    </li>';

}

;?>

 
</ul>


<form  method="GET" style="background:#fafafa;padding:10px;border:solid 1px #ddd;margin-top:10px;">
            <input type="submit" value="<?php echo $L->get('cache-thumbnail');?>" class="cleanthumb btn btn-danger btn-sm"   name="cleanthumb">
            </form>