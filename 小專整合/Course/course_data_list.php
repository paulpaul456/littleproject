<?php
require '../__connect_db.php';
$page_name = 'course_data_list';
$page_title = '課程';
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;       //用戶設定要第幾頁

$per_page = 10; // 每一頁要顯示幾筆

$t_sql = "SELECT COUNT(`course_id`) FROM `course` ";


//$t_stmt = $pdo->query($t_sql);
//$totalRows = $t_stmt->fetch(PDO::FETCH_NUM)[0]; // 拿到總筆數

$totalRows = $pdo->query($t_sql)->fetch(PDO::FETCH_NUM)[0]; // 拿到總筆數           //query(); 叫他直接執行sql
$totalPages = ceil($totalRows/$per_page);


//防止有人亂輸入值
if($page < 1){                                              //小於1轉回第一頁
    header('Location: course_data_list.php');
    exit;
}
if($page > $totalPages){
    header('Location: course_data_list.php?page='. $totalPages);   //大於總頁數，轉回最後一頁
    exit;
}

$sql = sprintf("SELECT `course`.*, `restaurant`.`name` r_name, `class_room`.`name` cr_name FROM `course` 
JOIN `restaurant` ON `course`.`restaurant_id` = `restaurant`.`restaurant_id`
JOIN `class_room` ON `course`.`room_sid` = `class_room`.`room_sid`
 ORDER BY `course_id` asc LIMIT %s, %s",     //LIMIT 填兩個值代表要顯示幾頁到幾頁，第一個值是索引值(從哪開始)，第二個值是顯示幾筆
    ($page-1)*$per_page,
    $per_page
);
$stmt = $pdo->query($sql);


?>
<?php include  '../__html_head.php' ?>
<?php include  '../__html_body.php' ?>
    <div class="content mt-n1">
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
                                    <a class="page-link" href="?page=<?= $page-1 ?>">
                                        <i class="fas fa-chevron-left"></i>
                                    </a>
                                </li>
                                <?php
                                $p_start = $page-5;
                                $p_end = $page+5;

                                for($i=$p_start; $i<=$p_end; $i++){
                                    if($i<1 or $i>$totalPages) continue;
                                    ?>
                                    <li class="page-item <?= $i==$page ? 'active' : '' ?>">
                                        <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
                                    </li>
                                <?php } ?>
                                <li class="page-item">
                                    <a class="page-link" href="?page=<?= $page+1 ?>">
                                        <i class="fas fa-chevron-right"></i>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th scope="col"><i class="fas fa-trash-alt"></i></th>
                                    <th scope="col">#</th>
                                    <th scope="col">課程名稱</th>
                                    <th scope="col">開課單位</th>
                                    <th scope="col">教室地點</th>
                                    <th scope="col">課程日期</th>
                                    <th scope="col">課程時段</th>
                                    <th scope="col">開課人數</th>
                                    <th scope="col">課程內容</th>
                                    <th scope="col">注意事項</th>
                                    <th scope="col">課程示意照片</th>
                                    <th scope="col">課程成立時間</th>
                                    <th scope="col"><i class="fas fa-edit"></i></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php while($r=$stmt->fetch()){  ?>
                                    <tr>
                                        <!-- 防止XSS attack (可以在你的欄位用JS操作，EX給你個爛芭樂)-->
                                        <td><a href="javascript:delete_one(<?= $r['course_id'] ?>)"><i class="fas fa-trash-alt"></i></a>
                                        </td>
                                        <td><?= htmlentities($r['course_id']) ?></td>
                                        <td><?= htmlentities($r['course_name']) ?></td>
                                        <td><?= htmlentities($r['r_name']) ?></td>
                                        <td><?= htmlentities($r['cr_name']) ?></td>
                                        <td><?= htmlentities($r['course_date']) ?></td>
                                        <td><?= htmlentities($r['course_time']) ?></td>
                                        <td><?= htmlentities($r['course_number_limit']) ?></td>
                                        <td><?= htmlentities($r['course_content']) ?></td>
                                        <td><?= htmlentities($r['course_note']) ?></td>
                                        <td>
                                            <a class="example-image-link" href="<?= 'uploads/'.$r['my_file'] ?>" data-lightbox="example-2" data-title="Optional caption.">
                                            <img src="<?= 'uploads/'.$r['my_file'] ?>" alt="" style="width:500px;" >
                                            </a>
                                        </td>
                                        <td><?= htmlentities($r['created_at']) ?></td>
                                        <td><a href="course_data_edit.php?course_id=<?= $r['course_id'] ?>"><i class="fas fa-edit"></i></a>
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
        <script>
            function delete_one(course_id) {
                if(confirm(`確定要刪除編號為 ${course_id} 的資料嗎?`)){
                    location.href = 'course_data_delete.php?course_id=' + course_id;
                }
            }
        </script>
        <script src="../assets/js/lightbox.js"></script>
    </div>
<?php include  '../__html_foot.php' ?>