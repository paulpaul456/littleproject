<?php
require '../__admin_required.php';
require '../__connect_db.php';
$page_name = 'restaurant_list';
$page_title = '餐廳列表';

$value = isset($_GET['search_value']) ? $_GET['search_value']: '';

$page = isset($_GET['page']) ? intval($_GET['page']) : 1;


$per_page = 5; // 每一頁要顯示幾筆

$up="up";
$down="down";


$change=isset($_GET['change'])?$_GET['change']:'';

// $params = [];
$where = ' WHERE 1 ';
if (!empty($value)) {
    // $params['value'] = $value;
    $value1 = $pdo->quote("%$value%");
    $where .= " AND (`restaurant_id` LIKE $value1 OR `password` LIKE $value1 OR `mobile` LIKE $value1 OR `name` LIKE $value1) ";
}

$t_sql = "SELECT COUNT(1) FROM `restaurant` $where";






$t_stmt = $pdo->query($t_sql);



$totalRows = $t_stmt->fetch(PDO::FETCH_NUM)[0]; // 拿到總筆數

$notice="查無搜尋結果";


if($totalRows==0){
    header('Location: restaurant_list.php?notice=' . "查無搜尋結果" );
    
    exit;
}

//$totalRows = $pdo->query($t_sql)->fetch(PDO::FETCH_NUM)[0]; // 拿到總筆數

$totalPages = ceil($totalRows / $per_page); // 取得總頁數

if ($page < 1) {
    header('Location: restaurant_list.php?page=' . 1 .'&search_value=' . $value  );
    exit;
}
if ($page > $totalPages) {
    header('Location: restaurant_list.php?page=' . $totalPages . '&search_value=' . $value );
    exit;
}


if($value =='' ){


    if($change==$down){
        $sql = sprintf(
            "SELECT * FROM `restaurant` ORDER BY `restaurant_id` DESC LIMIT %s, %s",
            ($page - 1) * $per_page,
            $per_page
        );

    }else{
        $sql = sprintf(
            "SELECT * FROM `restaurant` ORDER BY `restaurant_id` ASC LIMIT %s, %s",
            ($page - 1) * $per_page,
            $per_page
        );

    }
       

    $stmt = $pdo->query($sql);
}else{      

        if($change==$down){
            $sql = "SELECT * FROM `restaurant` $where ORDER BY `restaurant_id` DESC LIMIT " . ($page - 1) * $per_page . "," . $per_page;
        }else{
            $sql = "SELECT * FROM `restaurant` $where ORDER BY `restaurant_id` ASC LIMIT " . ($page - 1) * $per_page . "," . $per_page;
        }

       
        
        
        
        
        
        $stmt = $pdo->query($sql);
}


?>

<?php include  '../__html_head.php' ?>
<?php include  '../__html_body.php' ?>
<style>
    tbody tr.active {
            background: lightblue;
        }
</style>



    <div style="display:flex; justify-content:center;align-items:center;">
    

    <input type="text" class="form-control" id="search_value" name="search_value"
                placeholder="<?=isset($_GET['notice'])?$_GET['notice']: ''?>" style="margin:0 10px; transition: 0.5s; width:150px;z-index:100;">

        <a id="search_search" style="line-height:50% transition: 0.5s;" href="javascript:search()">Search</a>     

    </div>

    
   

    <div style="margin-top: 2rem;">
        <div aria-label="Page navigation example" <?=isset($_GET['notice'])? "hidden": ''?>>
            <ul class="pagination">
            <li class="page-item">
                    <a class="page-link" href="?page=<?= $page - 5 ?>&search_value=<?=$value?>&change=<?=$change?>">
                    <i class="fas fa-angle-double-left"></i>
                    </a>
                </li>
                <li class="page-item">
                    <a class="page-link" href="?page=<?= $page - 1 ?>&search_value=<?=$value?>&change=<?=$change?>">
                        <i class="fas fa-chevron-left"></i>
                    </a>
                </li>
                <?php
                $p_start = $page - 3;
                $p_end = $page + 3;

                if($p_start <= 0) $p_end += -($p_start) + 1;                //控制每次顯示多少個分頁
                            if($p_end > $totalPages) $p_start -= -($totalPages -$p_end);


              
                for ($i = $p_start; $i <= $p_end; $i++) :
                    if ($i < 1 or $i > $totalPages) continue;
                    ?>
                    <li class="page-item <?= $i == $page ? 'active' : '' ?>">
                        <a class="page-link" href="?page=<?= $i ?>&search_value=<?=$value?>&change=<?=$change?>"><?= $i ?></a>
                    </li>
                <?php endfor; ?>
                <li class="page-item">
                    <a class="page-link" href="?page=<?= $page + 1 ?>&search_value=<?=$value?>&change=<?=$change?>">
                        <i class="fas fa-chevron-right"></i>
                    </a>
                </li>
                <li class="page-item">
                    <a class="page-link" href="?page=<?= $page + 5 ?>&search_value=<?=$value?>&change=<?=$change?>">
                    <i class="fas fa-angle-double-right"></i>
                    </a>
                </li>
            </ul>
        </div>
        

        <table class="table  table-bordered">

            <thead>

                <tr>
                    <th scope="col" style="vertical-align:left;">
                        <label class='checkbox-inline checkboxeach'>
                            <input id='checkAll' type='checkbox' name='checkboxall' value='1'></label>選取
                    </th>
                    <th scope="col"><a href="javascript:delete_all()"><i class="fas fa-trash-alt delete_all"></i></a></th>


                    
                    <th scope="col">

                    <a href="restaurant_list.php?change=<?php if($change==$up or $change==''){echo $down;}  ?>&search_value=<?=$value?>&page=<?= $page ?>">change</a>                               
                                  
                    
                    </th>
                    
                    <th scope="col">餐廳名</th>
                    <th scope="col">電話</th>
                    <th scope="col">地址</th>
                    <th scope="col">休息日</th>
                    <th scope="col">營業時間</th>
                    <th scope="col">葷素</th>
                    <th scope="col">帳號</th>
                    <th scope="col">密碼</th>
                    <th scope="col">代客烹煮價碼</th>
                    <th scope="col">代客烹煮日</th>
                    <th scope="col">代客烹煮時間</th>
                    <th scope="col">平均客單價</th>
                    <th scope="col">網站</th>
                    <th scope="col">餐廳圖</th>

                    <th scope="col">套餐品項</th>
                    <th scope="col"><i class="fas fa-edit"></i></th>
                </tr>
            </thead>
            <tbody>
                <?php while(isset($_GET['notice'])?$r=[]:$r = $stmt->fetch()) {  ?>
                    <tr>

                        <td class="box_td">
                            <label class=' checkbox-inline checkboxeach'>
                                <input id="<?= 'readtrue' . $r['restaurant_id'] ?>" type='checkbox' name=<?= 'readtrue' . $r['restaurant_id'] . '[]' ?> value='<?= $r['restaurant_id'] ?>'> <!-- 選取框 -->
                            </label>
                        </td>
                        


                        <td>
                            <a href="javascript:delete_one(<?= $r['restaurant_id'] ?>)"><i class="fas fa-trash-alt"></i></a>
                        </td>
                        <td><?= $r['restaurant_id'] ?></td>
                        <td><?= htmlentities($r['name']) ?></td>
                        <td><?= htmlentities($r['mobile']) ?></td>
                        <td><?= htmlentities($r['address']) ?></td>
                        <td><?= htmlentities($r['holiday']) ?></td>
                        <td><?= htmlentities($r['businesstime']) ?></td>
                        <td><?= htmlentities($r['vegetarian']) ?></td>
                        <td><?= htmlentities($r['user']) ?></td>
                        <td><?= htmlentities($r['password']) ?></td>
                        <td><?= htmlentities($r['cook']) ?></td>
                        <td><?= htmlentities($r['cooktime']) ?></td>
                          
                        <td><?php
                                $x = json_decode($r['cookhour'], JSON_UNESCAPED_UNICODE);
                                if (isset($x)) {

                                    foreach ($x as $y) {

                                        echo  "$y" . " ,";
                                    }
                                }

                        ?></td>

                        <td><?= htmlentities($r['pct']) ?></td>
                        <td><?= htmlentities($r['website']) ?></td>
                        <td>
                        <a class="example-image-link" href="<?= 'uploads/' . $r['my_file'] ?>" data-lightbox="example-2" data-title="Optional caption."> <img width="50px;" src="<?= 'uploads/' . $r['my_file'] ?>" alt=""></a>
                           
                        </td>              
                        




                        <td><?php
                                $a = json_decode($r['setoption'], JSON_UNESCAPED_UNICODE);
                                if (isset($a)) {

                                    foreach ($a as $b) {

                                        echo  "$b" . " ,";
                                    }
                                }

                                ?></td>
                        <td>
                            <a href="restaurant_edit.php?restaurant_id=<?= $r['restaurant_id'] ?>"><i class="fas fa-edit"></i></a>
                        </td>
                    </tr>
                <?php } ?>


            </tbody>
        </table>
    </div>


    <script>
    
        let checkAll = $('#checkAll'); //控制所有勾選的欄位
        let checkBoxes = $('tbody .checkboxeach input'); //其他勾選欄位
        


        checkAll.click(function() {
            for (let i = 0; i < checkBoxes.length; i++) {
                checkBoxes[i].checked = this.checked;
            }
        })


       
    </script>
    <script>
    //可顯示勾選列顏色

      let dataCount=$("tbody tr").length;
        console.log(dataCount);


      $("tbody :checkbox").click(function(){
          let checked = $(this).prop("checked")
          console.log(checked);
          let checkedCount=$("tbody :checked").length;
          console.log(checkedCount);

          if(checked){
              $(this).closest("tr").addClass("active")
          }else{
              $(this).closest("tr").removeClass("active")
          }
          if(dataCount==checkedCount){
                $("#checkAll").prop("checked", true)
            }else{
                $("#checkAll").prop("checked", false)
            }

      })



      $("#checkAll").click(function () {
            let checkAll = $(this).prop("checked");
            // console.log(checkAll);

            $("tbody :checkbox").prop("checked", checkAll);
            if(checkAll){
                $("tbody tr").addClass("active");
            }else{
                $("tbody tr").removeClass("active");
            }
        })
  </script>

    <script>
        function delete_one(restaurant_id) {
            if (confirm(`確定要刪除編號為 ${restaurant_id} 的資料嗎?`)) {
                location.href = 'restaurant_delete.php?restaurant_id=' + restaurant_id;
            }
        }

        function delete_all() {
            let sids = [];
            checkBoxes.each(function() {
                if ($(this).prop('checked')) {
                    sids.push($(this).val())
                }
            });
            if (!sids.length) {
                alert('沒有選擇任何資料');
            } else {
                if(confirm('確定要刪除這些資料嗎？')){
                    location.href = 'data_delete_all.php?sids=' + sids.toString();
                }

            }
        }

    </script>


    <script>
    const search_value = document.querySelector('#search_value');


    const search_search = document.querySelector('#search_search');



    function search() {
        document.location.href=`restaurant_list.php?search_value=${search_value.value}`;

    }
    
    
    
    
    

    
    
    
    
    
    </script>


<script src="../assets/js/lightbox.js"></script>






<?php include  '../__html_foot.php' ?>