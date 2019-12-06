<?php
require '../__admin_required.php';
require '../__connect_db.php';
$page_name = 'member_list';
$page_title = '資料列表';

$page = isset($_GET['page']) ? intval($_GET['page']) : 1;       //用戶設定要第幾頁
$search = isset($_GET['search']) ? $_GET['search'] : '';        //search box

$per_page = 10; // 每一頁要顯示幾筆

$params = [];
$where = ' WHERE 1 ';
if (!empty($search)) {
    $params['search'] = $search;
    $search1 = $pdo->quote("%$search%");
    $where .= " AND (`name` LIKE $search1 OR `email` LIKE $search1 OR `mobile` LIKE $search1) ";
}

$count = "SELECT COUNT(1) FROM `customer_information` $where"; //用count計算出總筆數

$totalRows = $pdo->query($count)->fetch(PDO::FETCH_NUM)[0];
if($totalRows==0){
    $where = ' WHERE 1 ';
    $count = "SELECT COUNT(1) FROM `customer_information` $where";
    $totalRows = $pdo->query($count)->fetch(PDO::FETCH_NUM)[0];
}
//$t_sql = "SELECT COUNT(`customer_id`) FROM `customer_information` ";

//$t_stmt = $pdo->query($t_sql);
//$totalRows = $t_stmt->fetch(PDO::FETCH_NUM)[0]; // 拿到總筆數

//$totalRows = $pdo->query($t_sql)->fetch(PDO::FETCH_NUM)[0]; // 拿到總筆數           //query(); 叫他直接執行sql
$totalPages = ceil($totalRows / $per_page);


//防止有人亂輸入值
if ($page < 1) {                                              //小於1轉回第一頁
    header('Location: data_list.php?page=1'.'&search='.$search);
    exit;
}
if ($page > $totalPages) {
    header('Location: data_list.php?page=' . $totalPages .'&search='.$search);   //大於總頁數，轉回最後一頁
    exit;
}

$sql = "SELECT * FROM `customer_information` $where ORDER BY `customer_id` DESC LIMIT " . ($page - 1) * $per_page . "," . $per_page;
$stmt = $pdo->query($sql);


// $sql = sprintf(
//     "SELECT * FROM `customer_information` ORDER BY `customer_id` DESC LIMIT %s, %s",     //LIMIT 填兩個值代表要顯示幾頁到幾頁，第一個值是索引值(從哪開始)，第二個值是顯示幾筆
//     ($page - 1) * $per_page,
//     $per_page
// );
// $stmt = $pdo->query($sql);
// $stmt = $pdo->query("SELECT * FROM `address_book` ORDER BY `sid` DESC");

//$rows = $stmt->fetchAll();

?>
<?php include '../__html_head.php' ?>
<?php include '../__html_body.php' ?>
<div class="row d-flex justify-content-end" style="margin-right: 20px; margin-bottom: 20px">
    <div class="col-2 ">
    <form>
    <div class="input-group no-border ">
        <input type="text" name="search" value="" class="form-control" placeholder="Search...">
        <div class="input-group-append">
            <div class="input-group-text">
                <!-- <i class="nc-icon nc-zoom-split"></i> -->
            </div>
        </div>
    </div>
</form>
    </div>
</div>

<div class="content mt-n2">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title"> Table List</h4>
                </div>
                <div class="card-body">
                    <nav aria-label="Page navigation example">
                        <ul class="pagination">
                            <li class="page-item">
                                <a class="page-link" href="?page=<?= $page - 5 ?>&search=<?=$search?>">
                                    <i class="fas fa-angle-double-left"></i>
                                </a>
                            </li>
                            <li class="page-item">
                                <a class="page-link" href="?page=<?= $page - 1 ?>&search=<?=$search?>">
                                    <i class="fas fa-chevron-left"></i>
                                </a>
                            </li>
                            <?php
                            $p_start = $page - 2;
                            $p_end = $page + 2;
                            if($p_start <= 0) $p_end += -($p_start) + 1;                //控制每次顯示多少個分頁
                            if($p_end > $totalPages) $p_start -= -($totalPages -$p_end);

                            for ($i = $p_start; $i <= $p_end; $i++) {
                                if ($i < 1 or $i > $totalPages) continue;
                                $params['page'] = $i;
                                ?>
                                <li class="page-item <?= $i == $page ? 'active' : '' ?>">
                                    <a class="page-link" href="?page=<?=$i?>&search=<?=$search?>"><?= $i ?></a>
                                </li>
                            <?php } ?>
                            <li class="page-item">
                                <a class="page-link" href="?page=<?= $page + 1 ?>&search=<?=$search?>">
                                    <i class="fas fa-chevron-right"></i>
                                </a>
                            </li>
                            <li class="page-item">
                                <a class="page-link" href="?page=<?= $page + 5 ?>&search=<?=$search?>">
                                    <i class="fas fa-angle-double-right"></i>
                                </a>
                            </li>
                        </ul>
                    </nav>
                    <div class="table-responsive">
                        <table class="table">
                            <thead> 
                                <tr>
                                    <th scope="col" style="vertical-align:left;">
                                        <label class='checkbox-inline checkboxeach'>
                                            <input id='checkAll' type='checkbox' name='checkboxall' value='1'></label>選取
                                    </th>
                                    <th scope="col"><a href="javascript:delete_all()"><i class="fas fa-trash-alt delete_all"></i></a></th>
                                    <th scope="col">#</th>
                                    <th scope="col">姓名</th>
                                    <th scope="col">電子郵箱</th>
                                    <th scope="col">密碼</th>
                                    <th scope="col">手機</th>
                                    <th scope="col">生日</th>
                                    <th scope="col">地址</th>
                                    <th scope="col">性別</th>
                                    <th scope="col">個人圖檔</th>
                                    <th scope="col"><i class="fas fa-edit"></i></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($r = $stmt->fetch()) {  ?>
                                    <tr>
                                        <td class="box_td">
                                            <label class=' checkbox-inline checkboxeach'>
                                                <input id="<?= 'readtrue' . $r['customer_id'] ?>" type='checkbox' name=<?= 'readtrue' . $r['customer_id'] . '[]' ?> value='<?= $r['customer_id'] ?>'> <!-- 選取框 -->
                                            </label>
                                        </td>
                                        <!-- 防止XSS attack (可以在你的欄位用JS操作，EX給你個爛芭樂)-->
                                        <td><a href="javascript:delete_one(<?= $r['customer_id'] ?>)"><i class="fas fa-trash-alt"></i></a>

                                        </td>
                                        <td><?= htmlentities($r['customer_id']) ?></td>
                                        <td><?= htmlentities($r['name']) ?></td>
                                        <td><?= htmlentities($r['email']) ?></td>
                                        <td><?= htmlentities($r['password']) ?></td>
                                        <td><?= htmlentities($r['mobile']) ?></td>
                                        <td><?= htmlentities($r['birthday']) ?></td>
                                        <td><?= htmlentities($r['address']) ?></td>
                                        <td><?= htmlentities($r['gender']) ?></td>
                                        <td>
                                        <a class="example-image-link" href="<?= 'uploads/' . $r['my_file'] ?>" data-lightbox="example-2" data-title="Optional caption.">
                                        <img src="<?= 'uploads/' . $r['my_file'] ?>" alt="" style="width:50px;">
                                        </a>
                                        
                                        
                                        
                                        </td>
                                        <td><a href="data_edit.php?customer_id=<?= $r['customer_id'] ?>"><i class="fas fa-edit"></i></a>
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
    function delete_one(customer_id) {
        if (confirm(`確定要刪除編號為 ${customer_id} 的資料嗎?`)) {
            location.href = 'data_delete.php?customer_id=' + customer_id;
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
            if (confirm('確定要刪除這些資料嗎？')) {
                location.href = 'data_delete_all.php?sids=' + sids.toString();
            }

        }
    }
</script>
<script src="../assets/js/lightbox.js"></script>

</div>
<?php include '../__html_foot.php' ?>