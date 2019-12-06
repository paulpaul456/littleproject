<?php
require  '../__connect_db.php';
$page_name = 'room_data_city_list';
$page_title = '區域資料列表';

$page = isset($_GET['page']) ? intval($_GET['page']) : 1;

$per_page = 10; //每一頁要顯示幾筆

$t_sql = "SELECT count(1) FROM `class_room`";

$t_stmt = $pdo->query($t_sql);


$totalRows = $pdo->query($t_sql)->fetch(PDO::FETCH_NUM)[0]; // 拿到總筆數
$totalPages = ceil($totalRows/$per_page);

if($page < 1){
    header('Location: data_list.php');
    exit;
}
if($page > $totalPages){
    header('Location: data_list.php?page='. $totalPages);
    exit;
}

$sql = sprintf("SELECT * FROM `country`  ORDER BY `country_sid` DESC LIMIT %s, %s",
    ($page-1)*$per_page,
    $per_page
);


$stmt = $pdo->query($sql);

//$rows = $stmt->fetchAll();

?>

<?php include  '../__html_head.php' ?>
<?php include  '../__html_body.php' ?>
<div class="container">
    <div style="margin-top: 2rem;">
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
                for($i=$p_start; $i<=$p_end; $i++):
                    if($i<1 or $i>$totalPages) continue;
                    ?>
                    <li class="page-item <?= $i==$page ? 'active' : '' ?>">
                        <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
                    </li>
                <?php endfor; ?>
                <li class="page-item">
                    <a class="page-link" href="?page=<?= $page+1 ?>">
                        <i class="fas fa-chevron-right"></i>
                    </a>
                </li>
            </ul>
        </nav>


        <div class="card">        
        <table class="table table-striped table-bordered">
            <thead>
            <tr>
                <th scope="col">編輯</th>
                <th scope="col">#</th>
                <th scope="col">縣市</th>
                <th scope="col">行政</th>
                <th scope="col">區域</th>
                <th scope="col">刪除</th>

            </tr>
            </thead>
            <tbody>
            <?php while($r=$stmt->fetch()){  ?>
                <tr>
                    <td>
                        <a href="javascript:delete_one(<?= $r['country_sid'] ?>)"><i class="fas fa-trash-alt"></i></a>
                    <td><?= $r['country_sid'] ?></td>
                    <td><?= htmlentities($r['city']) ?></td>
                    <td><?= htmlentities($r['dist']) ?></td>
                    <td><?= htmlentities($r['Orientation']) ?></td>
                    <td><a href="room_data_city_edit.php?sid=<?=$r['country_sid'] ?>"><i class="fas fa-edit"></i></a>
                    </td>
                </tr>
            <?php } ?>

            </tbody>
        </table>
        </div>    
    </div>

    <script>
        function delete_one(sid) {
            if(confirm(`確定要刪除編號為 ${sid} 的資料嗎?`)){
                location.href = 'room_data_city_delete.php?sid=' + sid;
            }
        }
    </script>

</div>
<?php include  '../__html_foot.php' ?>
