<?php
require  '../__admin_required.php';
require  '../__connect_db.php';
$page_name = 'farmer';
$page_title = 'Farmer';

?>
<?php include  '../__html_head.php'?>
<style>


</style>
<?php include  '../__html_body.php'?>
<div class="col-md-6 col-lg-7 col-sm-6 ml-2 d-inline-block">
    <div class="row justify-content-end align-items-center">
        <div class="form-group" style="display:flex ; margin:0">
            
            <input type="text" class="form-control search_move" id="search_value" name="search_value"
                placeholder="Value" style="margin:0 10px; transition: 0.5s;">
        </div>
        
        <a id="search_advance" style="line-height:50% transition: 0.5s;" hidden ><i class="fas fa-lg fa-search"></i></a>
        <a id="search_search" style="line-height:50% transition: 0.5s;"  ><i class="fas fa-lg fa-search"></i></a>

    </div>
</div>
<div class="content mt-n2">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header row">
                    <h4 class="card-title ml-4">Members</h4>
                    <a href="farmer_create.php" class="ml-1">
                        <i class="fas fa-plus"></i>
                    </a>
                </div>
                <div class="card-body pt-1">
                    <div class="">
                        <table class="table">
                            <thead class=" text-primary">
                                <tr>
                                    <th><a id="id_desc" href="javascript: false;">ID<i id="icon_desc"
                                                class="fas fa-caret-down"></i></a></th>
                                    <th>StoreName</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Password</th>
                                    <th>Mobile</th>
                                    <th class="text-center">Edit</th>
                                    <th class="text-center">Del</th>
                                </tr>
                            </thead>
                            <tbody id="t_content">

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <nav aria-label="Page navigation" id="test1">
        <ul class="pagination justify-content-center">
        </ul>
    </nav>
</div>
</div>
</div>
<?php include  __DIR__.'/__js_addnotice.php'?>
<?php include  __DIR__.'/__js_script.php'?>
<?php include  '../__html_foot.php'?>