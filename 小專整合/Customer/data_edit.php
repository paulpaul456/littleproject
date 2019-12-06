<?php
require '../__admin_required.php';
require '../__connect_db.php';
$page_name = 'member_edit';
$page_title = '編輯資料';

$data1 = [
  '1' => '男',
  '2' => '女',
];





$customer_id = isset($_GET['customer_id']) ? intval($_GET['customer_id']) : 0;
if(empty($customer_id)) {
    header('Location: data_list.php');
    exit;
}

$sql = "SELECT * FROM `customer_information` WHERE `customer_id`=$customer_id";
$stmt = $pdo->query($sql);
$row = $stmt->fetch();
if(empty($row)) {
    header('Location: data_list.php');
    exit;
}
//$gender_b = empty($row['gender']) ? '男' : $row['gender'];
?>






<?php include '../__html_head.php' ?>
<?php include '../__html_body.php' ?>
<style>
    small.form-text {
        color: red;
    }
</style>

<div class="content">
        <div class="row">
            <div class="col">
                <div class="alert alert-primary" role="alert" id="info-bar" style="display: none"></div>
            </div>
        </div>
        <div class="row">
          <div class="col-md-4">
            <div class="card card-user">
              <div class="image">
                <img src="assets/img/damir-bosnjak.jpg" alt="...">
              </div>
              <div class="card-body">
                <div class="author">
                  <a href="#">
                    <img class="avatar border-gray" src="<?='uploads/'.$row['my_file'] ?>" alt="...">
                    <h5 class="title"><?= htmlentities($row['name']) ?></h5>
                  </a>
                  <!-- <p class="description">
                    @chetfaker
                  </p> -->
                </div>
                <p class="description text-center">
                    <?= htmlentities($row['about_me']) ?>
                </p>
              </div>
              <div class="card-footer">
                <hr>
                <div class="button-container">
                  <div class="row">
                    <div class="col-lg-3 col-md-6 col-6 ml-auto">
                      <h5>12
                        <br>
                        <small>Files</small>
                      </h5>
                    </div>
                    <div class="col-lg-4 col-md-6 col-6 ml-auto mr-auto">
                      <h5>2GB
                        <br>
                        <small>Used</small>
                      </h5>
                    </div>
                    <div class="col-lg-3 mr-auto">
                      <h5>24,6$
                        <br>
                        <small>Spent</small>
                      </h5>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-8">
            <div class="card card-user">
              <div class="card-header">
                <h5 class="card-title">Edit Profile</h5>
              </div>
              <div class="card-body">
              <form name="form1" onsubmit="return checkForm()">
                <input type="hidden" name="customer_id" value="<?= $row['customer_id'] ?>">
                  <div class="row">
                    <div class="col-md-6 px-1">
                        <div class="form-group">
                            <label for="name">** 姓名</label>
                            <input type="text" class="form-control" id="name" name="name" value="<?= htmlentities($row['name']) ?>">
                            <small id="nameHelp" class="form-text"></small>
                        </div>
                    </div>
                    <div class="col-md-6 pl-1">
                        <div class="form-group">
                            <label for="email">電子郵箱</label>
                            <input type="text" class="form-control" id="email" name="email" value="<?= htmlentities($row['email']) ?>">
                            <small id="emailHelp" class="form-text"></small>
                        </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-4 pr-1">
                          <div class="form-group">
                              <label for="password">密碼</label>
                              <input type="text" class="form-control" id="password" name="password" value="<?= htmlentities($row['password']) ?>">
                              <small id="passwordHelp" class="form-text"></small>
                          </div>
                      </div>
                    <div class="col-md-4 pr-1">
                        <div class="form-group">
                            <label for="mobile">手機</label>
                            <input type="text" class="form-control" id="mobile" name="mobile" value="<?= htmlentities($row['mobile']) ?>">
                            <small id="mobileHelp" class="form-text"></small>
                        </div>
                    </div>
                    <div class="col-md-4 pl-1">
                        <div class="form-group">
                            <label for="birthday">生日</label>
                            <input type="text" class="form-control" id="birthday" name="birthday" value="<?= htmlentities($row['birthday']) ?>">
                            <small id="birthdayHelp" class="form-text"></small>
                        </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="address">地址</label>
                            <input type="text" class="form-control" id="address" name="address" value="<?= htmlentities($row['address']) ?>">
                            <small id="addressHelp" class="form-text"></small>
                        </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="about_me">關於我</label>
                            <input type="text" class="form-control" id="about_me" name="about_me" value="<?= htmlentities($row['about_me']) ?>">
                            <small id="about_meHelp" class="form-text"></small>
                        </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                          <?php
                          $i=0;
                          foreach($data1 as $k=>$v){ ?>
                              <div class="form-check-inline">
                                  <input class="form-check-input" type="radio" name="gender"
                                      id="gender-b-<?= $k ?>" value="<?= $v ?>"
                                      <?= $row['gender'] ==$v ? 'checked' : '' ?>
                                  >
                                  <label class="form-check-label" for="gender-b-<?= $k ?>"><?= $v ?></label>
                              </div>
                          <?php
                          $i++;
                          }; ?>
                      </div>

                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                    
                        <div class="form-group">
                            <!-- <label for="my_file">選擇上傳的圖檔</label> -->
                            <input type="file" onchange="previewFile()" class="form-control-file" id="my_file" name="my_file" style="display: none">
                        </div>

                        <div class="form-group">
                            <button type="button" class="btn btn-info" onclick="selUpload()">選擇上傳的圖檔</button>
                            <img id="pre_img" src="" >
                        </div>

    
                    
                    </div>
                  </div>
                  <div class="row">
                    <div class="update ml-auto mr-auto">
                      <button type="submit" class="btn btn-primary btn-round" id="submit_btn">修改個人資料</button>
                  </div>
                </form>
                
              </div>
            </div>
          </div>
        </div>
      </div>

    <script>
     //preview picture
     function previewFile() {
            var preview = document.querySelector('#pre_img');
            var file    = document.querySelector('input[type=file]').files[0];
            var reader  = new FileReader();

            reader.addEventListener("load", function () {
                preview.src = reader.result;
            }, false);

            if (file) {
                reader.readAsDataURL(file);
            }
        }
    
    </script>






    <script>
        let info_bar = document.querySelector('#info-bar');
        const submit_btn = document.querySelector('#submit_btn');
        let i, s, item;
        const required_fields = [
            {
                id: 'name',
                pattern: /^\S{2,}/,
                info: '請填寫正確的姓名'
            },
            {
                id: 'email',
                pattern: /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i,
                info: '請填寫正確的 email 格式'
            },
            {
                id: 'mobile',
                pattern: /^09\d{2}\-?\d{3}\-?\d{3}$/,
                info: '請填寫正確的手機號碼格式'
            },
        ];

        // 拿到對應的 input element (el), 顯示訊息的 small element (infoEl)
        for(s in required_fields){
            item = required_fields[s];
            item.el = document.querySelector('#' + item.id);
            item.infoEl = document.querySelector('#' + item.id + 'Help');
        }

        //   /[A-Z]{2}\d{8}/i  統一發票

        function checkForm(){
            // 先讓所有欄位外觀回復到原本的狀態
            for(s in required_fields) {
                item = required_fields[s];
                item.el.style.border = '1px solid #CCCCCC';
                item.infoEl.innerHTML = '';
            }
            info_bar.style.display = 'none';
            info_bar.innerHTML = '';

            submit_btn.style.display = 'none';

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

            // 光箱問答
            Notiflix.Confirm.Init({
                width: "350px",
                okButtonBackground: "#ce4e4e",
                titleColor: "#e81616",
                titleFontSize: "20px",
                fontFamily: "Arial",
                useGoogleFont: false,
            });

            let fd = new FormData(document.form1);

            if(isPass) {
                fetch('data_edit_api.php', {
                    method: 'POST',
                    body: fd,
                })
                    .then(response => {
                        return response.json();
                    })
                    .then(json => {
                        console.log(json);

                        //觸發函式
                        Notiflix.Confirm.Show(
                                // Notice Content
                                '! WARNING !',
                                'Are You Sure ?',
                                '回會員列表',
                                '繼續編輯',
                                // ok button callback
                        
                                    function () {
                                        location.href="data_list.php";
                                    },
                               

                                // cancel button callback
                                    function() {   
                                        location.href="<?= 'data_edit.php?customer_id='.$customer_id ?>";          //沒下是跳轉到哪一筆，所以沒職時會跳轉到data_list
                                    }
                            );

                        submit_btn.style.display = 'block';
                        info_bar.style.display = 'block';
                        info_bar.innerHTML = json.info;
                        if (json.success) {
                            info_bar.className = 'alert alert-success';
                        } else {
                            info_bar.className = 'alert alert-danger';
                        }
                    });
            } else {
                submit_btn.style.display = 'block';
            }
            return false; // 表單不出用傳統的 post 方式送出
        }
    </script>


    <!-- 上傳圖片的 -->
    <script>
        //可以先隱藏外觀，再用一個假的按鈕去觸發被藏起來的那個

        function selUpload(){
            document.querySelector('#my_file').click();
        }

        //可以去搜尋FileReader.readAsURL ，可做預覽圖示效果
    </script>
</div>





















<?php include '../__html_foot.php' ?>
