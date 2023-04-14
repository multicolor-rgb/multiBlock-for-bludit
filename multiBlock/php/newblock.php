<style>
    /*listfile */


    .listfile {
        width: 100%;
        height: 300px;
        overflow-y: scroll;
        background: #ddd;
        margin-top: 20px;
        color: #000;
        padding: 10px;
        display: grid;
        grid-template-columns: repeat(5, minmax(150px, 1fr));
        gap: 10px;
        align-items: flex-start;
    }

    .thisphoto {
        text-align: center;
        cursor: pointer;
        width: 100%;
        display: block;
        word-break: break-all;
        color: #000 !important;
        text-decoration: none !important;
        font-weight: 300 !important;
        font-size: 11px !important;
    }

    .thisphoto:hover {
        background: rgba(0, 0, 0, 0.1);
        font-weight: 300 !important;
        font-weight: 300 !important;
        text-decoration: none !important;
        font-style: normal !important;
    }
</style>

<?php


if (isset($_GET['namefile'])) {
    $datas = file_get_contents(PATH_CONTENT . 'multiBlock/' . str_replace(" ", "-", @$_GET['newmulticategory']) . '/' . @str_replace(" ", "-", $_GET['namefile']) . '.json');
    $dater = json_decode($datas);
}; ?>

<style>
    .mbformer input {
        width: 100%;
        padding: 10px;
        box-sizing: border-box;
        margin: 10px 0;
    }

    .mbformer h4 {
        font-size: 1.2rem;
        font-weight: 400;

    }

    .mb_img {
        margin: 10px 0;
        display: grid;
        grid-template-columns: 80px 1fr 200px;
        gap: 15px;
        align-items: center;
    }

    .mb_img img {
        border: solid 1px #ddd;
        outline: solid 1px #ddd;
        outline-offset: 5px;
    }

    .mb_img .mb_fotobtn {}
</style>

<h3><?php echo $L->get("edit-block"); ?></h3>

<form method="POST" action="<?php echo DOMAIN_ADMIN; ?>plugin/multiblock?newblock=&newmulticategory=<?php echo @$_GET['newmulticategory']; ?>&choosecat" class="mbformer">
    <input type="hidden" id="jstokenCSRF" name="tokenCSRF" value="<?php echo $tokenCSRF; ?>">

    <div style="background:#fafafa;border:solid 1px #ddd; padding:10px;">
        <?php echo $L->get('section'); ?>: <input type="text" name="cat" class="cat" disabled="disabled" style="width:200px;border:none;margin:0;font-size:13px;padding:0;" value="<?php echo @$_GET['newmulticategory']; ?>">
    </div>

    <input type="text" style="display:none" name="nameolder" class="namefileolder" placeholder="title" value="<?php echo str_replace("-", " ", @$_GET['namefile']); ?>">

    <h4 style="margin-top:20px"><?php echo $L->get("block-title"); ?></h4>

    <input type="text" required="required" name="name" class="namefile" placeholder="title" value="<?php echo str_replace("-", " ", @$_GET['namefile']); ?>">

    <hr>

    <h4 style="margin-top:20px;margin-bottom:10px;"><?php echo $L->get("options-mb"); ?></h4>

    <?php

    if (isset($_GET['newmulticategory'])) {

        $cat = file_get_contents(PATH_CONTENT . '/multiBlock/category/' . str_replace(" ", "-", $_GET['newmulticategory']) . '.json');
        $multicategory = json_decode($cat);


        $multicategory = json_decode($cat);


        $count = 0;



        foreach ($multicategory as $category) {
            $nis = str_replace(" ", "", $category->label);



            if (isset($dater)) {
                $valer = $dater->$nis;
            } else {
                $valer = $category->value;
            }






            if ($category->select == 'wysywig') {


                echo '<p style="margin: 0;
  margin:0;
margin-top: 20px;
font-weight: 400px;
font-size: 15px;
margin-bottom:5px;">' . $category->title . ' :</p>
 
        <textarea id="post-content" name="' . str_replace(" ", "", $category->label) . '" style="width:100%;display:block;height:250px;" class="mbinput">' . html_entity_decode($valer) . '</textarea>
        
 
';
            } elseif ($category->select == 'image') {



                echo '<span class="formedit">';
                echo '<p style="margin: 0;
  margin-top: 0px;
margin-top: 20px;
font-weight: 400px;
font-size: 15px;">' . $category->title . ' :</p>


        <div class="mb_img">

        <img src="' . $valer . '" style="width:80px;height:80px;object-fit:cover;">


        <input type="text" class="mb_foto foto mbinput" name="' . str_replace(" ", "", $category->label) . '" value="' . $valer . '">
        
        <button class="mb_fotobtn choose-image btn btn-primary btn-sm" style="height:40px">' . $L->get("choose-image") . '</button>

        </div>
    
        ';



                echo "
  
 <div class='listfile'>
  ";


                foreach (glob(PATH_ROOT . "/bl-content/uploads/pages/*/*.{jpg,png,gif,bmp,jpeg,webp}", GLOB_BRACE) as $images) {
                    $newimagedir = str_replace(PATH_UPLOADS, "", $images);


                    $newurl = str_replace(PATH_ROOT, DOMAIN_BASE, $images);


                    $path_parts = pathinfo($images);

                    $roter = str_replace(PATH_ROOT, DOMAIN, $path_parts['dirname']) . '/thumbnails/' . $path_parts['basename'];



                    $img = '
     <a href="' . $newurl . '" class="thisphoto">
     <img src="' . $roter . '" style="width:100%;height:150px;object-fit:cover">
     <br>
     
     <p>' . str_replace(DOMAIN_BASE . '/bl-content/uploads/', '', $newurl) . '</p>
    
     </a>
        
        ';

                    echo $img;
                };



                echo "
 </div>

 </span>

 ";
            } elseif ($category->select == 'textarea') {



                echo '<p style="margin: 0;
  margin-top: 0px;
margin-top: 20px;
font-weight: 400px;
font-size: 15px;display:inline-block;">' . $category->title . ' :</p>


 
            <textarea class="mbinput" style="width:100%;height:250px;" name="' . str_replace(" ", "", $category->label) . '">' . html_entity_decode($valer) . '</textarea>';
            } elseif ($category->select == 'dropdown') {






                $ars = explode('|', $category->value);

                echo '<p style="margin: 0;
        margin-top: 0px;
      margin-top: 20px;
      font-weight: 400px;
      font-size: 15px;display:inline-block;">' . $category->title . ' :</p>';

                echo '<select style="width:100%;padding:10px;" class="' . str_replace(" ", "", $category->label) . '" name="' . str_replace(" ", "", $category->label) . '">';

                foreach ($ars as $sel) {



                    echo '<option value="' . str_replace(" ", "^", $sel) . '" >' . $sel . '</option>';
                }

                echo '</select>';


                echo '<script>
   
   document.querySelector("select.' . str_replace(" ", "", $category->label) . '").value = "' . str_replace(" ", "^", $valer) . '"; </script>';
            } elseif ($category->select == 'link') {


                echo '
        <p style="margin: 0;
  margin:0;
margin-top: 20px;
font-weight: 400px;
font-size: 15px;">' . $category->title . ' :</p> 
        <select style="width:100%;padding:15px;display:block;border:solid 1px #ddd; background:#fff;margin-top:10px;" class="' . str_replace(" ", "", $category->label) . '" name="' . str_replace(" ", "", $category->label) . '">';

                foreach (glob(PATH_PAGES . '*', GLOB_ONLYDIR) as $page) {


                    $path_parts = pathinfo($page);



                    echo "<option value='" . DOMAIN . '/' . $path_parts['filename'] . "'  >" . $path_parts['filename'] . "</option>";
                };

                echo '</select>';


                echo '<script> document.querySelector("select.' . $category->label . '").value = "' . $valer . '"; </script>';
            } else {





                echo '<p style="margin: 0;
  margin:0;
margin-top: 20px;
font-weight: 400px;
font-size: 15px;">' . $category->title . ' :</p>


        <input class="mbinput" type="' . $category->select . '" name="' . str_replace(" ", "", $category->label) . '" value="' . html_entity_decode($valer) . '">
        
        ';
            }
        }
    };; ?>

    <div style="backgorund:#fafafa;border:solid 1px #ddd;padding:10px;box-sizing:border-box;display:flex;margin-top:10px;">
        <input type="submit" name="saveblock" class="btn btn-dark" style="width:200px;background:#000;color:#fff;margin:0; border:none;" value="<?php echo $L->get("update"); ?>">
    </div>
</form>




<script src="https://cdn.ckeditor.com/4.19.1/standard/ckeditor.js"></script>

<script type="text/javascript">
    document
        .querySelectorAll(`#post-content`)
        .forEach(c => {

            var editor = CKEDITOR.replace(c);

        });
</script>

<script>
    if (document.querySelector('.mb_foto') !== null) {

        document
            .querySelectorAll('.formedit')
            .forEach((e, i) => {
                e
                    .querySelector('.listfile')
                    .style
                    .display = 'none';
                e
                    .querySelector('.choose-image')
                    .addEventListener('click', y => {
                        y.preventDefault();
                        e
                            .querySelector('.listfile')
                            .style
                            .display = 'grid';
                    })

                e
                    .querySelectorAll('.thisphoto')
                    .forEach(x => {
                        x.addEventListener('click', g => {
                            g.preventDefault();
                            const namer = x.getAttribute('href');
                            e
                                .querySelector('.foto')
                                .value = namer;
                            e
                                .querySelector('.listfile')
                                .style
                                .display = 'none'
                        })
                    })
            })

    }
</script>