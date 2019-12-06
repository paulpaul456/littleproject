<?php if ($page_name !== 'adminhome'):?>
<div class="col-md-5 col-lg-4 col-sm-5 mt-5 pt-4 pr-0 d-inline-block">
            <nav aria-label="breadcrumb " role="navigation">
             <ol class="breadcrumb" style="background-color: transparent;">
                 <li class="breadcrumb-item"><a href="../Admin/adminHome.php">Home</a></li>
                 <?php if($page_name =='data_list'): ?>
                     <li class="breadcrumb-item"><a href="data_insert.php">Insert</a></li>
                 <?php endif; ?>
                 <li class="breadcrumb-item active" aria-current="page"><span><?=$page_name?></span></li>
            </ol>
            </nav>
            </div>
<?php endif; ?>