
<?php require '../__admin_required.php';?>
<?php require '../__connect_db.php' ?>

<?php

$page_name = "farmer_product_insert";
$page_title ='商品新增';

// 分類的選項取出
$class_sql = "SELECT `class_sid`,`name` FROM `product_class`";
$class_stmt = $pdo->query($class_sql);
$classRows = $class_stmt->fetchALL();

$level1 = [];
foreach($classRows as $cr){
      $level1[] = $cr;
}


// 認證的選項取出
$p_sql = "SELECT `sid`, `name` FROM `product_approve`";
$p_stmt = $pdo->query($p_sql);
$pRows = $p_stmt->fetchALL();

$level = [];
foreach($pRows as $pr){
      $level[] = $pr;
}

// tag的選項取出
$t_sql = "SELECT `sid`, `name` FROM `tag`";
$t_stmt = $pdo->query($t_sql);
$tRows = $t_stmt->fetchALL();

// $tlevel = [];
// foreach($tRows as $tr){
//   if($tr['sid']<10){
//       $tlevel[] = $tr;
// }    
// }
?>



<?php include '../__html_head.php' ?>
<?php include '../__html_body.php' ?>

<!-- form div -->
<!-- 新增商品卡片 -->
    <div class="content mt-0 ">
        <div class="row justify-content-center">
          <div class="col-md-12 col-lg-10">
            <div class="card card-user">
              <div class="card-header">
                <h5 class="card-title ml-3">新增商品</h5>
              </div>
      <!-- return checkform() method="post"-->
              <div class="card-body">
                <form name="product_form" onsubmit="return checkform()" enctype="multipart/form-data" >
                  <div class="row">
                  <div class="col-md-4 pr-1" style="display: none">
                      <div class="form-group">
                        <label>小農用戶</label>
                        <input type="text" class="form-control" placeholder="session()" name="user" value="123">
                      </div>
                    </div>
                    <div class="col-md-4 pr-1">
                      <div class="form-group">
                        <label><span class="text-danger">*</span>商品名稱</label>
                        <input type="text" class="form-control" placeholder="我是商品(限50字)" name="name" id="name">
                        <small id="nameHelp" class="form-text text-danger"></small>
                      </div>
                    </div>
                    <div class="col-md-4 px-1">
                      <div class="form-group">
                        <label><span class="text-danger">*</span>價錢</label>
                        <input type="text" class="form-control" placeholder="價位售價" name="price" id="price">
                        <small id="priceHelp" class="form-text text-danger"></small>
                      </div>
                    </div>
                    <div class="col-md-4 pl-1">
                      <div class="form-group">
                        <label for="exampleInputEmail1"><span class="text-danger">*</span>規格</label>
                        <input type="text" class="form-control" placeholder="EX:250g/袋(30字)" name="specification" id="specification">
                        <small id="specificationHelp" class="form-text text-danger"></small>
                      </div>
                    </div>
                 
                  </div>
                  <div class="row">
                    <div class="col-md-2 pr-1">
                      <div class="form-group">
                        <label for="where">產地</label> <br>
                        <select name="place" id="place" class="custom-select custom-select-m">
                          <option></option>
                          <option>北部</option>
                          <option>中部</option>
                          <option>南部</option>
                          <option>東部</option>
                          <option>離島</option>
                        </select>
                      </div>
                    </div>

                    <div class="col-md-2 pr-1">
                      <div class="form-group">
                        <label for="classify">種類</label><br>
                        <select name="class_sid" id="class_sid" class="custom-select custom-select-m">
                          <option></option>
                          <?php foreach($level1 as $cr): ?>
                          <option value="<?= $cr['class_sid']?>"><?= $cr['name']?></option>
                          <?php endforeach;?> 
    
                          
                        </select>
                      </div>
                    </div>

                    <div class="col-md-2 pr-1">
                      <div class="form-group">
                        <label for="classify">五行顏色</label><br>
                        <select name="color" id="color" class="custom-select">
                          <option></option>
                          <option>黑</option>
                          <option>白</option>
                          <option>黃</option>
                          <option>綠</option>
                          <option>紅</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-2 pr-1">
                      <div class="form-group">
                        <label for="classify">驗證標章</label><br>
                        <select class="custom-select custom-select-m" name="approve_sid">
                            <option selected>--驗證標章--</option>
                            <?php foreach($level as $pr): ?>
                          <option value="<?= $pr['sid']?>"><?= $pr['name']?></option>
                          <?php endforeach;?>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-4 pl-1">
                      <div class="form-group py-1">
                        <label><span class="text-danger">*</span>庫存</label>
                        <input type="number" class="form-control" placeholder="商品庫存量" name="stock" id="stock">
                        <small id="stockHelp" class="form-text text-danger"></small>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>小標</label>
                        <input type="text" class="form-control" placeholder="芋頭園芋頭香(100字)" name="subtitle">
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label><span class="text-danger">*</span>成分</label>
                        <input type="text" class="form-control" placeholder="白色的粉10g 藍色的粉20g(250字)" name="content" id="content">
                        <small id="contentHelp" class="form-text text-danger"></small>
                      </div>
                    </div>
                  </div>
                  
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label><span class="text-danger">*</span>內文</label>
                        <textarea class="form-control textarea" placeholder="好吃營養又好玩健康又好美自然又好真(250字)" name="writing" id="writing"></textarea>
                        <small id="writingHelp" class="form-text text-danger"></small>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                      <div class="col-md-12">
                        <label for="tag">TAG標籤</label> <br>
                        <div class="my-4">
                          <?php foreach($tRows as $tr): ?>
                           <input class="mx-1" name="tag[]" type="checkbox" value="<?= $tr['sid']?>"><?= $tr['name']?>
                          <?php endforeach;?>
                         
                        </div>
                      </div>  
                  </div>

                  <div class="row">
                      <div class="col-md-12">
                          <label class="">照片(限3張)</label><br>
                          <div class="custom-file">
                              <input type="file" class="custom-file-input" id="picture" name="picture[]" multiple>
                              <label class="custom-file-label" for="customFile">選擇照片檔案</label>
                          </div>
                          <div id="list1" class="border border-dark" placeholder=""></div>
                      </div>
                    </div>
                      
                  <div id="info-bar"></div> 

                  <div class="row">
                    <div class="update ml-auto mr-auto">
                      <button type="submit" class="btn btn-primary btn-round" id="submit">上傳</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>

  

      
  <script>

let info_bar = document.querySelector('#info-bar');
let submit = document.querySelector('#submit');

// let i, s, item;
//前台檢查
const required_fields = [
            {
                id: 'name',
                pattern: /^\S/,
                info: '請填寫商品名'
            },
            {
                id: 'price',
                pattern: /^\d/,
                info: '請填寫價格'
            },
            {
                id: 'specification',
                pattern: /^\S{2,}/,
                info: '請填寫商品規格'
            },
            {
                id: 'stock',
                pattern: /^\d/,
                info: '請填寫商品庫存'
            },
            {
                id: 'content',
                pattern: /^\S{2,}/,
                info: '請填寫商品成分'
            },
            {
                id: 'writing',
                pattern: /^\S{2,}/,
                info: '請填寫商品內文'
            },
        ];
        // 拿到對應的 input element (el), 顯示訊息的 small element (infoEl)
        for(s in required_fields){
            item = required_fields[s];
            item.el = document.querySelector('#' + item.id);
            item.infoEl = document.querySelector('#' + item.id + 'Help');

            
        }
        
    function checkform(){ 
 
           // 先讓所有欄位外觀回復到原本的狀態
      for(s in required_fields) {
                item = required_fields[s];
                item.el.style.border = '1px solid #CCCCCC';
                item.infoEl.innerHTML = '';
            }
            info_bar.style.display = 'none';
            info_bar.innerHTML = '';
            submit.style.display = 'block';

            // 檢查必填欄位, 欄位值的格式
            let isPass = true;

            for(s in required_fields) {
                item = required_fields[s];

                if(! item.pattern.test(item.el.value)){
                    item.el.style.border = '1px solid red';
                    item.infoEl.innerHTML = item.info;
                    isPass = false;
                }
            }

      
      let fd = new FormData(document.product_form);

      

        if(isPass){
               fetch('farmer_product_insert_api.php', {
                method: 'POST',
                body: fd,
            })
              .then(response=>{
                    return response.json();
                })
                .then(json=>{
                    console.log(json);
                    submit.style.display = 'block';
                    info_bar.style.display = 'block';
                    info_bar.innerHTML = json.info;
                    if(json.success){
                        info_bar.className = 'alert alert-success';   
                        name.className = 'alert alert-success ';
                        setTimeout(function(){location.href = 'farmer_product_read.php';},1000);
                        
                    } else {
                        submit.style.display = 'block';
                        info_bar.className = 'alert alert-danger'
                        name.className = 'alert alert-warning ';
                    }
                });
           }else {
                submit.style.display = 'block';
            }
            

            return false; // 表單不出用傳統的 post 方式送出
            
    }

  

  //圖片預覽
  function handleFileSelect(evt) {
    var files = evt.target.files; // FileList object

    // Loop through the FileList and render image files as thumbnails.
    for (var i = 0, f; f = files[i]; i++) {

      // Only process image files.
      if (!f.type.match('image.*')) {
        continue;
      }

      var reader = new FileReader();

      // Closure to capture the file information.
      reader.onload = (function(theFile) {
        return function(e) {
          // Render thumbnail.
          var span = document.createElement('span');
          span.innerHTML = ['<img width="200" class="thumb" src="', e.target.result,
                            '" title="', escape(theFile.name), '"/>'].join('');
          document.getElementById('list1').insertBefore(span, null);
        };
      })(f);

      // Read in the image file as a data URL.
      reader.readAsDataURL(f);
    }
  }

  document.getElementById('picture').addEventListener('change', handleFileSelect, false);

  </script>   

<?php include '../__html_foot.php' ?>