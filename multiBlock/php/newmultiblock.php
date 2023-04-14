<style>
    .mb_category {
        width: 100%;
        padding: 10px;
        border: none;
        background: #fafafa;
        border: solid 1px #ddd;
    }

    .cats {
        display: grid;
        grid-template-columns: 1fr 150px;
        gap: 10px;
        border: none;
    }



    .mb_catlist ul {
        display: flex;
        flex-direction: column;
        margin-top: 30px;
        margin: 0 !important;
        padding: 0 !important;
    }

    .mb_catlist ul li {
        display: grid;
        grid-template-columns: 1fr 50px 50px;
        justify-content: space-between;
        align-items: center;
        padding: 10px;
    }

    .mb_catlist p {
        font-size: 15px;
        margin: 0 !important;
        padding: 0 !important;
        font-weight: 400;
    }

    .mb_catlist li:nth-child(odd) {
        background: rgba(0, 0, 0, 0.04);
    }






    .button-3 {
        padding: 10px 15px;
        background: #000;
        color: #fff;
        border: none;
    }
</style>

<h3><?php echo $L->get("multiblock-section"); ?></h3>

<form method="get" class="cats">

    <input type="hidden" name="newblock">

    <select class="mb_category" name="newmulticategory">



        <?php

        foreach (glob(PATH_CONTENT . "/multiBlock/category/*.json") as $filename) {

            $info = pathinfo($filename);
            $namevalue = str_replace(' ', '-', basename($filename, '.' . $info['extension']));
            $name = str_replace('-', ' ', basename($filename, '.' . $info['extension']));

            echo '<option value="' . $namevalue . '">' . $name . '</option>';
        }; ?>

    </select>

    <input type="submit" name="choosecat" class="choosecat btn btn-primary" value="<?php echo $L->get("choosesection"); ?>">

</form>











<div id="mb_catlist_list" class="mb_catlist">




    <?php


    $counterlist = 0;

    if (isset($_GET['newmulticategory']) || isset($_GET['refresh'])) {


        echo '<div style="width:100%;margin-top:20px;">

<form method="get">
<input type="hidden" value="' . @$_GET["newmulticategory"] . '" name="newmulticategory">
<input type="hidden" name="createblock">
<input type="submit" class="addnewblock btn btn-primary" value="' . $L->get("add-new-btn2") . ' ➕"> 

</form>

</div>';


        echo '<br>
<h3>' . $L->get("multiblockin") . '</h3>
<br>
<ul id="mb_catlist_list" class="mb_catlist_list">
';


        foreach (glob(PATH_CONTENT . "/multiBlock/" . str_replace(" ", "-", $_GET['newmulticategory']) . "/*.json") as $filename) {

            $info = pathinfo($filename);
            $namevalue = str_replace(' ', '-', basename($filename, '.' . $info['extension']));
            $name = str_replace('-', ' ', basename($filename, '.' . $info['extension']));


            echo '<li data-id="' . $counterlist . '"><p>' . $name . '</p>
        

        <a href="' . DOMAIN_ADMIN . 'plugin/multiblock?newmulticategory=' . str_replace(" ", "-", $_GET['newmulticategory']) . '&createblock=&namefile=' . $name . '" class="mb_edit btn btn-sm btn-dark" style="width:45px;">' . $L->get("edit") . '</a>

        <form method="get"   onclick="return confirm(`' . $L->get('question') . '`);" 
        style="display:inline-flex" 
      >

      <input type="hidden" name="newblock">
        <input type="text"  style="display:none;" name="newmulticategory" value="' . @$_GET['newmulticategory'] . '">
        <input type="text"  style="display:none;" name="delthis" value="' . basename($filename, '.' . $info['extension']) . '">

        <input type="submit" name="delthisbtn" value="' . $L->get('delete') . '" class="mb_edit mb_edit_delete btn btn-sm btn-danger"> 
        </form>
        
        </li>';

            $counterlist++;
        }
    }
    echo '</ul>';


    if (isset($_GET['newmulticategory'])) {

        echo '
 
    <form method="post" style="margin-top:20px;" action="' . DOMAIN_ADMIN . 'plugin/multiblock?newblock&newmulticategory=' . $_GET['newmulticategory'] . '">
    <input type="hidden" id="jstokenCSRF" name="tokenCSRF" value="' . $tokenCSRF . '">

    <input type="text" style="display:none" class="array" name="array" value="' . @file_get_contents(PATH_CONTENT . 'multiBlock/' . $_GET['newmulticategory'] . '/order.txt') . '">
    <input type="submit" class="button-3 btn btn-dark" value="' . $L->get('save-order') . ' 🎢" name="saveorder">
    </form>
    ';
    }; ?>




    <script>
        const arraylist = '<?php echo @file_get_contents(PATH_CONTENT . 'multiBlock/' . $_GET['newmulticategory'] . '/order.txt'); ?>';
        const arraychange = arraylist.split(',');



        arraychange.forEach((x, i) => {
            if (document.querySelector(`.mb_catlist_list li[data-id="${x}"]`) !== null) {
                document.querySelector('.mb_catlist_list').append(document.querySelector(`.mb_catlist_list li[data-id="${x}"]`));
            }
        });
    </script>


</div>





<script>
    <?php

    if (isset($_GET['choosecat'])) {

        echo "document.querySelector('.mb_category').value = '" . @$_GET['newmulticategory'] . "';";

        echo "document.querySelector('.addnewblock').setAttribute('href','" . DOMAIN_ADMIN. "plugin/multiblock?newblock&newmulticategory=" . @$_GET['newmulticategory'] . "')";
    }; ?>
</script>


<script src="<?php echo $this->domainPath(); ?>/js/Sortable.min.js"></script>

<script>
    var el = document.querySelector('.mb_catlist_list');
    var sortable = Sortable.create(el, {
        dataIdAttr: 'data-id',
        animation: 200,

        onStart: function(evt) {

            document.querySelector('.array').value = sortable.toArray();

        },


        onUpdate: function(evt) {

            document.querySelector('.array').value = sortable.toArray();

        }



    });
</script>