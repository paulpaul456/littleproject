<?php require  '../__connect_db.php'; ?>
<?php
$page_name = "farmer_product_read";
$page_title ='商品清單';


$email = isset($_GET['email']) ? intval($_GET['email']) : 'wang12@gmail.com';
if(empty($email)) {
    header('Location: farmer_product_readaj.php');
    exit;
}

// $r=$stmt->fetch();

// foreach ($r['picture'] as $k => $v) {
// $pic = json_decode($v, JSON_UNESCAPED_UNICODE); 


?>
<?php include '../__html_head.php' ?>
<?php include '../__html_body.php' ?>

<script>
</script>
<!-- div -->
<div class="content mt-0">




<!-- 展示列表 -->
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title text-primary">商品資訊</h4>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table">
                    <thead class=" text-primary">
                      <th><input type="checkbox" id="checkAll"> 全選</th>                   
                      <th>商品名稱</th>
                      <th>庫存</th>
                      <th>價格</th>
                      <th>產地</th>
                      <th>商品圖</th>
                      <th>編輯區</th>
                    </thead>
                    <tbody id="t_content">
                    
                    
                   
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>



  <!-- 頁數按鈕 -->
<nav aria-label="Page navigation example justify-content-center" class="justify-content-center">
  <ul class="pagination pagination">
  
  </ul>
</nav>




  <script>

//ajax

const pagination = document.querySelector('.pagination');
const t_content = document.querySelector('#t_content');


const table_row_str = `
        <tr>
               
                <td><label class="  checkbox-inline  checkboxeach"><input type="checkbox"></label></td>
                <td><%= name %></td>
                <td><%= stock %></td>
                <td><%= price %></td>
                <td><%= place %></td>
                <td><%= picture %></td>
                <td><a href="javascript:edit_one(<%= picture %>)"><i class="fas fa-edit fa-2x"></i></a>&nbsp;&nbsp;
                       <a href="javascript:delete_one(<%= picture %>)"><i class="fas fa-trash-alt fa-2x"></i></a></td>
                
            </tr>
        `;

const pagination_str = `
          
            <li class="page-item <%= active %>">
                <a class="page-link" href="javascript:loadData(<%= i %>)"><%= i %></a>
            </li>
            
        `;

        const pagination_fn = _.template(pagination_str);
        const table_row_fn = _.template(table_row_str);

        function loadData(page=1){

            fetch('farmer_product_readaj.api.php?page=' + page)
                .then(response=>{
                    return response.json();
                })
                .then(json=>{
                    console.log(json);
                    let i, s, item;
                    let t_str = '';
                    for(s in json.rows){
                        item = json.rows[s];

                        t_str += table_row_fn(item)

                    }
                    t_content.innerHTML = t_str;

                    let p_str = '';
                    for(i=1; i<=json.totalPages; i++){
                        let active = i===json.page ? 'active' : '';
                        p_str += pagination_fn({i:i, active:active});
                    }
                    pagination.innerHTML = p_str;
                });
        }

        loadData();       
     

//全選
        let checkAll = $('#checkAll'); //控制所有勾選的欄位
        let checkBoxes = $('tbody .checkboxeach input'); //其他勾選欄位
      

        checkAll.click(function() {
            for (let i = 0; i < checkBoxes.length; i++) {
                checkBoxes[i].checked = this.checked;
            }
        })


  
  
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
        
  </script>
          


<?php include '../__html_foot.php' ?>