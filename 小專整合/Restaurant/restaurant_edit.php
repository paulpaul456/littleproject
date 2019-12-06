<?php


require '../__connect_db.php';
$page_name = 'restaurant_edit';
$page_title = '編輯資料';


$set = empty($_POST['set_or_not']) ? [] : $_POST['set_or_not'];

$data2 = [
    
    '1' => '湯',   
    '2' => '甜點',  
    '3' => '飲料',     
];


$data3=[
    '0'=>'素',
    '1'=>'葷',
    '2'=>'都有'
    
];

$data4=[
    '0'=>'11:00~14:00',
    '1'=>'14:00~17:00',
    '2'=>'17:00~20:00'
];



$sid = isset($_GET['restaurant_id']) ? intval($_GET['restaurant_id']) : 0;
if(empty($sid)) {
    header('Location: restaurant_list.php');
    exit;
}

$sql = "SELECT * FROM `restaurant` WHERE `restaurant_id`=$sid";
$row = $pdo->query($sql)->fetch();
if(empty($row)) {
    header('Location: restaurant_list.php');
    exit;
}

?>

<?php include  '../__html_head.php' ?>
<?php include '../__html_body.php' ?>
<style>
    small.form-text {
        color: red;
    }
    
</style>
<div class="container" style="margin-top:100px">
<div style="margin-top: 2rem;">
    <div class="row">
        <div class="col">
            <div class="alert alert-primary" role="alert" id="info-bar" style="display: none"></div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">編輯資料</h5>
                    <form name="form1" onsubmit="return checkForm()">
                        <input type="hidden" name="restaurant_id" value="<?= $row['restaurant_id'] ?>">
                        <div class="form-group">
                            <label for="name">餐廳名</label>
                            <input type="text" class="form-control" id="name" name="name" value="<?= htmlentities($row['name']) ?>">
                            <small id="nameHelp" class="form-text"></small>
                        </div>
                        <div class="form-group">
                            <label for="mobile">電話</label>
                            <input type="text" class="form-control" id="mobile" name="mobile" value="<?= htmlentities($row['mobile']) ?>">
                            <small id="mobileHelp" class="form-text"></small>
                        </div>
                        <div class="form-group">
                            <label for="address">地址</label>
                            <input type="text" class="form-control" id="address" name="address" value="<?= htmlentities($row['address']) ?>">
                            <small id="addressHelp" class="form-text"></small>
                        </div>
                        <div class="form-group">
                            <label for="holiday">公休日</label>
                            <input type="text" class="form-control" id="holiday" name="holiday" value="<?= htmlentities($row['holiday']) ?>">
                            <small id="holidayHelp" class="form-text"></small>
                        </div>
                        <div class="form-group">
                            <label for="businesstime">營業時間</label>
                            <input type="text" class="form-control" id="businesstime" name="businesstime" value="<?= htmlentities($row['businesstime']) ?>">
                            <small id="businesstimeHelp" class="form-text"></small>
                        </div>
                                           

                        <div class="form-group">
                            <label for="user">帳號</label>
                            <input type="text" class="form-control" id="user" name="user" value="<?= htmlentities($row['user']) ?>">
                            <small id="userHelp" class="form-text"></small>
                        </div>
                        <div class="form-group">
                            <label for="password">密碼</label>
                            <input type="text" class="form-control" id="password" name="password" value="<?= htmlentities($row['password']) ?>">
                            <small id="passwordHelp" class="form-text"></small>
                        </div>
                        <div class="form-group">
                            <label for="cook">代客烹煮價錢</label>
                            <input type="text" class="form-control" id="cook" name="cook" value="<?= htmlentities($row['cook']) ?>">
                            <small id="cookHelp" class="form-text"></small>
                        </div>
                        <div class="form-group">
                            <label for="cooktime">代客烹煮時間</label>
                            <input type="text" class="form-control" id="cooktime" name="cooktime" value="<?= htmlentities($row['cooktime']) ?>">
                            <small id="cooktimeHelp" class="form-text"></small>
                        </div>
                        <div class="form-group">
                            <label for="pct">平均客單價</label>
                            <input type="text" class="form-control" id="pct" name="pct" value="<?= htmlentities($row['pct']) ?>">
                            <small id="pctHelp" class="form-text"></small>
                        </div>
                        <div class="form-group">
                            <label for="website">網站</label>
                            <input type="text" class="form-control" id="website" name="website" value="<?= htmlentities($row['website']) ?>">
                            <small id="websiteHelp" class="form-text"></small>
                        </div>


                    
                        <div class="form-group">
                        <label class="form-check-label" for="cookhour<?= $k ?>"><?= "代客烹煮時段" ?></label>
                            <?php foreach($data4 as $k=>$v): ?>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="cookhour[]"
                                    id="cookhour<?= $k ?>" value="<?= $v ?>"
                                    <?= in_array($v,json_decode($row['cookhour'], JSON_UNESCAPED_UNICODE))?'checked' :'' ?>
                                >
                                <label class="form-check-label" for="cookhour<?= $k ?>"><?= $v ?></label>
                            </div>
                            <?php endforeach; ?>
                         </div>

                        

                        <div class="form-group">
                            <?php foreach($data2 as $k=>$v){ ?>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="setoption[]"
                                    id="setoption<?= $k ?>" value="<?= $v ?>" 
                                    <?= in_array($v,json_decode($row['setoption'], JSON_UNESCAPED_UNICODE))?'checked' :'' ?>
                                   
                                >
                                <label class="form-check-label" for="setoption<?= $k ?>"><?= $v ?></label>
                            </div>
                            <?php } ?>
                         </div>
                      


                         <div class="form-group">
                        <label class="form-check-label" for="set<?= $k ?>"><?= "葷素" ?></label>
                            <?php
                            $i=0;                            
                            foreach($data3 as $k=>$v): ?>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="vegetarian"
                                        id="set<?= $k ?>" value="<?= $v ?>"
                                       <?= $row['vegetarian']==$v?'checked':''  ?>
                                    >
                                    
                                    <label class="form-check-label" for="set<?= $k ?>"><?= $v ?></label>
                                </div>
                            <?php
                            $i++;
                            endforeach; ?>
                        </div>



                        <img src="" id="img1" height="200">






                        <div class="form-group">            
                            <input type="file" onchange="previewFile()" class="form-control-file" id="my_file" name="my_file" style="display: none">
                         </div>
                            <div class="form-group">
                            <button type="button" class="btn btn-info" onclick="selUpload()">選擇上傳的圖檔</button>
                     </div>

                        <button type="submit" class="btn btn-primary" id="submit_btn">修改</button>
                    </form>
                </div>
            </div>

        </div>
    </div>






</div>
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
                fetch('restaurant_edit_api.php', {
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
                                '確定要修改嗎',
                                '回餐廳列表',
                                '繼續編輯',
                                // ok button callback
                        
                                    function () {
                                        location.href="restaurant_list.php";
                                    },
                               

                                // cancel button callback
                                    function() {   
                                       
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

        function selUpload(){
            document.querySelector('#my_file').click();
        }

        function previewFile() {
            var preview = document.querySelector('#img1');
            var file    = document.querySelector('input[type=file]').files[0];
            var reader  = new FileReader();

            if (file) {
                reader.readAsDataURL(file);
            }

            reader.addEventListener("load", function () {
                preview.src = reader.result;
            }, false);

          
        }


    </script>
</div>
<?php include '../__html_foot.php' ?>
