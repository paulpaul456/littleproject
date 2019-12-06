<?php if ($page_name !== 'adminhome'):?>
<div class="col mt-5 pt-4">
            <nav aria-label="breadcrumb " role="navigation">
             <ol class="breadcrumb" style="background-color: transparent;">
                <li class="breadcrumb-item"><a href="../Admin/adminHome.php">Home</a></li>
                <?php if($page_name =='data_list'): ?>
                <li class="breadcrumb-item"><a href="data_insert.php">Insert</a></li>
                <?php endif; ?>
                 <li class="breadcrumb-item active" aria-current="page"><?= $page_name?> </li>
            </ol>
            </nav>
            </div>
<?php endif; ?>