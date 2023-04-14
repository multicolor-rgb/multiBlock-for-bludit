<?php
global $L;
?>
<style>
.mb_title{
    width: 100%;
    padding: 10px;
}

.mb_textarea{
    width: 100%;
    height: 400px;
    padding: 10px ;
    box-sizing: border-box;
}

.mb_submit{
    background: #000;
    width:150px;
    color:#fff;
    padding: 10px 15px;
    border:none;

}

.mb_buttons{
    margin-right: 0;
margin-left: auto;
width: auto;
display: flex;
justify-content: end;
gap: 5px;
}




.mb_inputs{
    margin: 0 !important;
    padding: 0 !important;
    list-style-type: none;
    width: 100%;
    display: block;
 
    box-sizing: border-box !important;
}

.mb_inputs li,.info{
    display: grid;
    grid-template-columns: 25px 1fr 1fr 1fr 1fr 30px;
    gap: 10px;
    justify-content: space-between;
    align-items: center;
padding: 10px;
box-sizing: border-box;
}

.info{
    text-align: center;
    background: #fafafa;
    border:solid 1px #ddd;
    
margin-top:20px;}

.info p{
    margin: 0;
    padding: 0;

}

.mb_inputs li p{
    font-size: 12px;
    margin: 0 !important;
    padding: 0 !important;
    text-align: center;
    font-weight: bold;
}

.mb_inputs li:nth-child(odd){
    background: rgba(0,0,0,0.04);

}

.mb_inputs li input,.mb_inputs li select{
    width: 100%;
padding: 5px;
}


.mb_addbtndiv{
    width: 100%;
    margin-top: 20px;

    
}

.mb_close{
    background-color: red;
    font-size: 14px;
    color:#fff; 
    border:none;
    height: 100%;
}


.mb_newinput{
 
    display: inline-block;
    border:none;
    padding:10px 15px;
    cursor: pointer;
}


.mb_inputs li input, .mb_inputs li select{
    box-sizing: border-box;
}

input{
    box-sizing: border-box;
}

</style>

<h3>MultiBlock - <?php echo $L->get("add-new-category");?></h3>

<form method="POST" action="<?php echo DOMAIN_ADMIN;?>/plugin/multiblock"  >
<input type="hidden" id="jstokenCSRF" name="tokenCSRF" value="<?php echo $tokenCSRF;?>">

<input type="text" style="display:none" value="<?php if(isset($_GET['categoryname'])){echo str_replace(" ","-",$_GET['categoryname']);};?>" name="check">
<input type="text" required placeholder="<?php echo $L->get("category-place-holder");?>" class="mb_title" name="categoryname" value="<?php if(isset($_GET['categoryname'])){echo str_replace('-',' ',@$_GET['categoryname']);};?>">
<input type="hidden" id="jstokenCSRF" name="tokenCSRF" value="<?php echo $tokenCSRF;?>">


<hr>

 

<div class="mb_buttons"  style="width:100%;background:#fafafa;display:flex; justify-content:flex-end;padding:5px;box-sizing:border-box;border:solid 1px #ddd;margin-bottom:20px;">
<button class="mb_btngeneral btn btn-primary"><?php echo $L->get("general-btn");?></button>
<button class="mb_btntemplate btn btn-primary"><?php echo $L->get("template-btn");?></button>
<a href="<?php echo DOMAIN_BASE;?>/admin/plugin/multiblock" class="backtolist btn btn-danger"><?php echo $L->get("back-btn");?></a>
</div>






<div class="mb_general">


<div class="mb_addbtndiv">

<button class="mb_newinput btn btn-primary"><?php echo $L->get("add-new-btn");?> ➕</button>

</div>


<div class="info"> 

 

<p><?php echo $L->get("id");?></p>
<p><?php echo $L->get("field-name");?></p>
<p><?php echo $L->get("slug");?></p>
 <p><?php echo $L->get("default-value");?></p>
<p><?php echo $L->get("field-type");?></p>

 

</div>

<ul id="mb_inputs" class="mb_inputs">
 


<?php

 
if(isset($_GET['categoryname'])){
    $cat = file_get_contents(PATH_CONTENT.'multiBlock/category/'.str_replace(" ","-",$_GET['categoryname']).'.json');

 
$multicategory = json_decode($cat);


 $count = 0;
 


foreach ($multicategory as $category){

 echo '
 <li>
 <p>'.@$category->key.'</p>
<input type="text" required class="mb_input" placeholder="'.$L->get("field-name").'" value="'.@$category->title.'" name="title[]">
<input type="text" required class="mb_input" placeholder="'.$L->get("slug").'" value="'.@$category->label.'" name="label[]">
<input type="text" class="mb_input" value="'.@$category->value.'" placeholder="'.$L->get("default-value").'" name="value[]" >
<select class="mb_input meselect-'.$count.'" name="select[]"  >
<option>text</option>
<option>wysywig</option>
<option>textarea</option>
<option>color</option>
<option>date</option>
<option>image</option>
<option>dropdown</option>
<option>link</option>
</select>
<button class="mb_close">X</button>
</li>
 <script>document.querySelector(".meselect-'.$count.'").value="'.@$category->select.'"</script>
 ';

 $count++;

}

};

 

;?>



</ul>
</div>


<div class="mb_template">
<b><?php echo $L->get("template1");?></b>

<div style="width:100%;height:auto;padding:15px;background:#fafafa;border:solid 1px #ddd;margin:10px 0;font-size:12px !important;box-sizing:border-box">

<b><?php echo $L->get("template2");?></b><br>
<code style="border:solid 1px #ddd;background:#fafafa;padding:5px;display:inline-block;margin:10px 0;"> &#60;?php mbvaluetext('valuename');?&#62; </code> <br>

<b><?php echo $L->get("template3");?></b><br>

<code style="border:solid 1px #ddd;background:#fafafa;padding:5px;display:inline-block;margin:10px 0;"> &#60;?php mbvalue('valuename');?&#62; </code> <br>

<b><?php echo $L->get("template4");?></b><br>
<code style="border:solid 1px #ddd;background:#fafafa;padding:5px;display:inline-block;margin:10px 0;"> &#60;?php mborder();?&#62; </code> <br>

<br>

 

<b><?php echo $L->get("dropdown-placeholder");?></b><br>

<code style="border:solid 1px #ddd;background:#fafafa;padding:5px;display:inline-block;margin:10px 0;"> &#60;?php mbdropdown('valuename');?&#62; </code> <br>


<b><?php echo $L->get("dropdown-value");?></b>
 <br>


 <code style="border:solid 1px #ddd;background:#fafafa;padding:5px;display:inline-block;margin:10px 0;">    example 1|example 2|example 3</code> <br>

    
 <br>



 <b><?php echo $L->get("thumb-placeholder");?></b><br>

<code style="border:solid 1px #ddd;background:#fafafa;padding:5px;display:inline-block;margin:10px 0;"> &#60;?php mbthumb('imageslug',300 <?php echo $L->get("different-width");?>);?&#62; </code> <br>






<hr>
<br>

<b><?php echo $L->get("template5");?></b>
 
<br>

<code style="border:solid 1px #ddd;background:#fafafa;padding:5px;display:inline-block;margin:10px 0;"> &#60;?php getMultiBlock('categoryname');?&#62; </code> <br>

<br>

<b><?php echo $L->get("TEMPLATE6");?></b>
 <br>

<code style="border:solid 1px #ddd;background:#fafafa;padding:5px;display:inline-block;margin:10px 0;"> &#60;?php getMultiBlock('categoryname' , '#idContainer or .classContainer');?&#62; </code> <br>

</div>

<textarea name="template" class="mb_textarea">
    <?php

if(isset($_GET['categoryname'])){
   echo file_get_contents(PATH_CONTENT.'multiBlock/category/'.str_replace(" ","-",$_GET['categoryname']).'.txt');
}

;?>
</textarea>
</div>


<div style="width:100%;background:#fafafa;display:flex; justify-content:flex-end;padding:5px;box-sizing:border-box;border:solid 1px #ddd;margin-top:20px;">

<input type="submit"  name="savecat" class="mb_submit btn btn-dark" value="<?php echo $L->get("save-cat");?>">

</div>


</form>




<script>

document.querySelector('.mb_template').style.display="none";



document.querySelector('.mb_btntemplate').addEventListener('click',(btn)=>{
btn.preventDefault();

if(document.querySelector('.mb_template').style.display=="none"){
document.querySelector('.mb_template').style.display="block";
document.querySelector('.mb_general').style.display="none";
}else if( document.querySelector('.mb_template').style.display=="block"){
    document.querySelector('.mb_template').style.display="none";
    document.querySelector('.mb_general').style.display="block";

}

});



document.querySelector('.mb_btngeneral').addEventListener('click',(btn)=>{
btn.preventDefault();

if(document.querySelector('.mb_template').style.display=="block"){
document.querySelector('.mb_template').style.display="none";
document.querySelector('.mb_general').style.display="block";
}else if( document.querySelector('.mb_template').style.display=="none"){
    document.querySelector('.mb_template').style.display="block";
    document.querySelector('.mb_general').style.display="none";

}

});





let count = 0;



document.querySelector('.mb_newinput').addEventListener('click',(btn)=>{
btn.preventDefault();

    const former = `<li >
 <p>auto</p>
 <input type="text" required class="mb_input" placeholder="<?php echo $L->get('field-name');?>" name="title[]">
<input type="text" required class="mb_input" placeholder="<?php echo $L->get('slug');?>" name="label[]">
<input type="text" class="mb_input" placeholder="<?php echo $L->get('default-value');?>" name="value[]" >
<select class="mb_input" name="select[]" >
    <option>text</option>
    <option>wysywig</option>
    <option>textarea</option>
    <option>color</option>
    <option>date</option>
    <option>image</option>
    <option>dropdown</option>
    <option>link</option>
</select>
<button class="mb_close">X</button>
</li>`;

count++;

document.querySelector('.mb_inputs').insertAdjacentHTML('beforeend',former);


document.querySelectorAll('.mb_close').forEach(closebtn=>{
    closebtn.addEventListener('click',x=>{
        x.preventDefault();
        closebtn.parentElement.remove();
    })
})


});


 if(document.querySelector('.mb_inputs li')){
document.querySelector('.mb_inputs li').addEventListener('click',()=>{

    document.querySelectorAll('.mb_input').forEach(x=>{
  });

 })
};


document.querySelectorAll('.mb_close').forEach(closebtn=>{
    closebtn.addEventListener('click',x=>{
        x.preventDefault();
        closebtn.parentElement.remove();
    })
})

</script>


<script src="<?php echo $this->domainPath();?>/js/Sortable.min.js"></script>

<script>
var el = document.getElementById('mb_inputs');
var sortable = Sortable.create(el,{
    animation:200,
});







</script>

 