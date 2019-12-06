<?php require '../__admin_required.php'?>
<?php require '../__connect_db.php' ?>
<?php
$page_name = "farmer_product_read";
$page_title ='商品清單';

$value = isset($_GET['search_value']) ? $_GET['search_value']: '';
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;

$per_page = 10; // 每一頁要顯示幾筆
//搜尋
$where = ' WHERE 1 ';
if (!empty($value)) {
    // $params['value'] = $value;
    $value1 = $pdo->quote("%$value%");
    $where .= " AND (d.`name` LIKE $value1 OR d.`price` LIKE $value1 OR d.`writing` LIKE $value1 OR d.`content` LIKE $value1) ";
}

$t_sql = "SELECT COUNT(1) FROM `farmer_product` d JOIN `farmers` p ON d.farmer_sid=p.farmer_id $where";
$t_stmt = $pdo->query($t_sql);


$totalRows = $t_stmt->fetch(PDO::FETCH_NUM)[0]; // 拿到總筆數

$notice="查無搜尋結果";


if($totalRows==0){
    header('Location:farmer_product_read.php?notice=' . "查無搜尋結果" );
    
    exit;
}

// $t_sql = "SELECT COUNT(1) FROM `farmer_product`";


// $t_stmt = $pdo->query($t_sql);
// $totalRows = $t_stmt->fetch(PDO::FETCH_NUM)[0]; // 拿到總筆數
//$totalRows = $pdo->query($t_sql)->fetch(PDO::FETCH_NUM)[0]; // 拿到總筆數

$totalPages = ceil($totalRows/$per_page); // 取得總頁數

//echo "$totalRows <br>";
//echo "$totalPages <br>";
//exit;
if($page<1){
  header('Location: farmer_product_read.php?page=' . 1 .'&search_value=' . $value  );
  exit;  //直接離開不在跑下面
}
if($page>$totalPages){
    header('Location: farmer_product_read.php?page='. $totalPages. '&search_value=' . $value);
    exit;
  }

//小農名單加產品名單

if($value =='' ){
        
  $sql = sprintf(
      "SELECT d.*,p.`farmer_id`,p.`name` farmer_name FROM `farmer_product` d JOIN `farmers` p ON d.farmer_sid=p.farmer_id LIMIT %s, %s",
      ($page - 1) * $per_page,
      $per_page
  );
  $stmt = $pdo->query($sql);
}else{      
    $sql = "SELECT d.*,p.`farmer_id`,p.`name` farmer_name FROM `farmer_product` d JOIN `farmers` p ON d.farmer_sid=p.farmer_id $where ORDER BY d.`name` DESC LIMIT " . ($page - 1) * $per_page . "," . $per_page;
    $stmt = $pdo->query($sql);
}

// $sql = sprintf("SELECT d.*,p.`farmer_id`,p.`name` farmer_name FROM `farmer_product` d JOIN `farmers` p ON d.farmer_sid=p.farmer_id ORDER BY `sid` LIMIT %s, %s",
//         ($page-1)*$per_page,
//             $per_page
// );
// $stmt = $pdo->query($sql);




?>
<?php include '../__html_head.php' ?>
<?php include '../__html_body.php' ?>

<style>

</style>

<!-- div -->
<div class="content mt-0 mb-2" >

<div style="display:flex; justify-content:center;align-items:center;" class="mb-2">
    

    <input type="text" class="form-control" id="search_value" name="search_value"
                placeholder="<?=isset($_GET['notice'])?$_GET['notice']: ''?>" style="margin:0 10px; transition: 0.5s; width:150px;z-index:100;">

        <a id="search_search" style="line-height:50% transition: 0.5s;" href="javascript:search()"><i class="fas fa-search fa-2x mt-1"></i></a>     

    </div>

                    <!-- <form>
                      <div class="row justify-content-center">
                        <div class="input-group no-border col-md-4">
                            <input type="text"  class="form-control" name="search_value" placeholder="">
                            <div class="input-group-append">
                            <a id="search_search" style="line-height:50% transition: 0.5s;" href="javascript:search()"><i class="fas fa-search fa-2x mt-1"></i></a> 
                                <div class="input-group-text">
                                   
                                </div>
                            </div>
                         </div>
                      </div>
                        
                    </form> -->

  <!-- 展示列表 -->
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header row">
                <h4 class="card-title ml-4">商品資訊</h4>
                <a href="farmer_product_insert.php" class="ml-1">
                        <i class="fas fa-plus"></i>
                </a>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table">
                    <thead class=" text-primary">
                      <th scope="col" style="vertical-align:left;">
                        <label class='checkbox-inline checkboxeach'>
                            <input id='checkAll' type='checkbox' name='checkboxall' value='1'></label>全選
                      </th>
                      <th scope="col"><a href="javascript:delete_all()"><i class="fas fa-trash-alt delete_all"></i></a></th>
                      <!-- <th><input type="checkbox">全選</th> -->
                      <th> 編號</th>
                      <th>商品名</th>
                      <th>小農名</th>
                      <th>圖片</th>
                      <th>價格</th>
                      <th>庫存</th>
                      <th>上傳日期</th>
                      <th>編輯</th>
                      <th>刪除</th>
                      
                    </thead>
                    <tbody>
                    <tr>
                      
                    <?php while($r=$stmt->fetch()){  ?>
                      <td> <label class=' checkbox-inline checkboxeach'>
                                <input id="<?= 'readtrue' . $r['sid'] ?>" type='checkbox' name=<?= 'readtrue' . $r['sid'] . '[]' ?> value='<?= $r['sid'] ?>'> <!-- 選取框 -->
                      </label> </td>
                   <!-- <td> <input type="checkbox" ></td> -->
                   <td></td>
                   <td><?= $r['sid'] ?></td>
                   <td><?= $r['name'] ?></td>
                   <td><?= $r['farmer_name']  ?></td>
                   <td> 
                     <?php
                  //  $r['picture']
                    $pic=json_decode($r['picture'], JSON_UNESCAPED_UNICODE);
                    if(isset($pic)){
                       
                      foreach($pic as $phot){
                        // echo " <img src=uploads/"."$phot" . " , "."\""."alt=\"\" width=\"150\">" ;
                        echo "<a href=\"uploads/"."$phot"."\""."data-lightbox=\"ex1\"><img src=uploads/"."$phot" . " , "."\""."alt=\"\" width=\"150\"></a>" ;
                      }
                    } 
                    
                    ?></td>
                   <td><?= $r['price'] ?></td>
                   <td><?= $r['stock'] ?></td>
                   <td><?= $r['created_at'] ?></td>
                   <td>
                     <a href="javascript:edit_one(<?= $r['sid'] ?>)"><i class="fas fa-pen"></i></a>&nbsp;&nbsp;
                       
                   </td>
                   <td>
                     <a href="javascript:delete_one(<?= $r['sid'] ?>)"><i class="fas fa-trash-alt "></i></a>
                   </td>
                     </tr> 
                    
                     <?php } ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>

  </div>

  <!-- 頁數按鈕 -->
<nav aria-label="Page navigation example " >
  <ul class="pagination justify-content-center">
  <li class="page-item">
    <a class="page-link" href="?page=1">
    <i class="fas fa-angle-double-left"></i></a></li>
  <li class="page-item">
    <a class="page-link" href="?page=<?=$page-1?>">
    <i class="fas fa-chevron-left"></i></a></li>
  <?php 
  $p_start=$page-3;
  $p_end=$page+3;
  for($i=$p_start; $i<=$p_end;$i++): 
  if($i<1 or $i>$totalPages)continue;
  ?>
    <li class="page-item <?= $i==$page? 'active' : '' ?>">
    <a class="page-link" href="?page=<?= $i ?>"><?= $i?></a></li>
<?php endfor; ?>
    <li class="page-item">
    <a class="page-link" href="?page=<?=$page+1?>">
    <i class="fas fa-chevron-right"></i></a></li>
    <li class="page-item">
    <a class="page-link" href="?page=<?=$totalPages?>">
    <i class="fas fa-angle-double-right"></i></a></li>
  </ul>
</nav>

  
</div>







<script src="../assets/js/lightbox.js"></script>



<script>
let checkAll = $('#checkAll'); //控制所有勾選的欄位
let checkBoxes = $('tbody .checkboxeach input'); //其他勾選欄位


checkAll.click(function() {
            for (let i = 0; i < checkBoxes.length; i++) {
                checkBoxes[i].checked = this.checked;
            }
        })


        function delete_all() {
            let sids = [];
            checkBoxes.each(function() {
                if ($(this).prop('checked')) {
                    sids.push($(this).val())
                }
            });
            if (!sids.length) {
                alert('沒有選擇任何資料');
            } else 
            {
               Notiflix.Confirm.Show(
                 '! 提醒 !',
                 '確定要刪除這些資料嗎?',
                 '確認',
                 '返回',
             function() {
               location.href = 'farmer_product_delete_all.php?sids=' + sids.toString();
             }
            );   
           
            }               
            //       {
            //     if(confirm('確定要刪除這些資料嗎？')){
            //         location.href = 'farmer_product_delete_all.php?sids=' + sids.toString();
            //     }

            // }
        }
            

  
//修改 刪除fn
  function edit_one(sid) {
           Notiflix.Confirm.Show(
        '! 提醒 !',
        '確定要進行修改嗎?',
        '確認',
        '返回',
        function() {
          location.href = 'farmer_product_edit.php?sid=' + sid;
        }
        );   
           
        }               

  //確認改顏色
    Notiflix.Confirm.Init({
    width: "300px",
    okButtonBackground: "#ce4e4e",
    titleColor: "#e81616",
    titleFontSize: "20px",
    fontFamily: "Arial",
    useGoogleFont: false,
      });     
  function delete_one(sid) {
          Notiflix.Confirm.Show(
        '! 提醒 !',
        '確定要進行刪除嗎?',
        '確認刪除',
        '返回',
        function() {
          location.href = 'farmer_product_delete.php?sid=' + sid;
        }
        );   
           
        }      

      //搜尋
        function search() {
        document.location.href=`farmer_product_read.php?search_value=${search_value.value}`;

    }
    

        
  </script>
          


<?php include '../__html_foot.php' ?>