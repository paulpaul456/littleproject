<?php
require  '../__connect_db.php';
$page_name = 'room_data_edit';
$page_title = '編輯資料';

$sid = isset($_GET['sid']) ? intval($_GET['sid']) : 0;

if(empty($sid)) {
    header('Location: room_data_list.php');
    exit;
};

$sql = "SELECT * FROM class_room WHERE `room_sid`=$sid";
$row = $pdo->query($sql)->fetch();
if(empty($row)) {
    header('Location: room_data_list.php');
    exit;
};

$country_sql = ("SELECT * FROM `country`  ORDER BY `country_sid`");
$country_stmt = $pdo->query($country_sql);

?>
<?php include  '../__html_head.php' ?>
<?php include  '../__html_body.php' ?>
<style>
    small.form-text {
        color: red;
    }
</style>
<div class="container">
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
                        <form name="form1" onsubmit="return checkForm()"  enctype="multipart/form-data">
                            <input type="hidden" name="room_sid" value="<?= $row['room_sid'] ?>">
                            <div class="form-group">
                                <img src="<?= $row['room_images'] ?>" >
                                <input type="file" class="form-control-file" id="room_images" name="room_images" >
                                <button type="submit" class="btn btn-success">選擇上傳圖片</button>
                            </div>
                            <div class="form-group">
                                <label for="name">店名</label>
                                <input type="text" class="form-control" id="name" name="name" value="<?= htmlentities($row['name']) ?>">
                                <small id="nameHelp" class="form-text"></small>
                            </div>
                            <div class="form-group">
                                <label for="phone">電話</label>
                                <input type="text" class="form-control" id="phone" name="phone" value="<?= htmlentities($row['phone']) ?>">
                                <small id="phoneHelp" class="form-text"></small>
                            </div>
                            <div class="form-group">
                                <label for="cost">費用</label>
                                <input type="text" class="form-control" id="cost" name="cost" value="<?= htmlentities($row['cost']) ?>">
                                <small id="containHelp" class="form-text"></small>
                            </div>

                            <div class="form-group">
                                <label for="contain">容納人數</label>
                                <input type="text" class="form-control" id="contain" name="contain" value="<?= htmlentities($row['contain']) ?>">
                                <small id="containHelp" class="form-text"></small>
                            </div>
                            <div class="form-group">
                                <label for="city">區域</label>
                                <select id="country_sid" name="country_sid">
                                    <?php while($r=$country_stmt->fetch()){  ?>
                                        <?php if($r['country_sid'] == $row['country_sid']){ ?>
                                            <option value="<?= $r['country_sid'] ?>" selected = "selected"> <?= $r['city'] ?> <?= $r['dist'] ?> </option>
                                        <?php }else{ ?>
                                            <option value="<?= $r['country_sid'] ?>"> <?= $r['city'] ?> <?= $r['dist'] ?> </option>
                                        <?php } ?>
                                    <?php } ?>
                                </select>
                                <small id="cityHelp" class="form-text"></small>
                            </div>
                            <div class="form-group">
                                <label for="address">地址</label>
                                <input type="text" class="form-control" id="address" name="address" value="<?= htmlentities($row['address']) ?>">
                                <small id="addressHelp" class="form-text"></small>
                            </div>
                            <button id="submit_btn" type="submit" class="btn btn-primary">修改</button>

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
                info: '請填寫正確的店名'
            }
            // ,
            // {
            //     id: 'phone',
            //     pattern: /^[0]{1}\d{1,3}-\d{7,8}$|^[0]{1}\d{1,3}-\d{7,8}#\d{2,3}$/,
            //     info: '請填寫正確的 電話 格式'
            // }

        ];

        // 拿到對應的 input element (el), 顯示訊息的 small element (infoEl)
        for(s in required_fields){
            item = required_fields[s];
            item.el = document.querySelector('#' + item.id);
            item.infoEl = document.querySelector('#' + item.id + 'Help');
        }

        function checkForm() {
            //必填欄位驗證 開始
            for (s in required_fields) {
                item = required_fields[s];
                item.el.style.border = '1px solid #CCCCCC';
                item.infoEl.innerHTML = '';
            }
            info_bar.style.display = 'none';
            info_bar.innerHTML = '';

            submit_btn.style.display = 'none';


            let isPass = true;

            for (s in required_fields) {
                item = required_fields[s];

                if (!item.pattern.test(item.el.value)) {
                    item.el.style.border = '1px solid red';
                    item.infoEl.innerHTML = item.info;
                    isPass = false;
                }
            }
            //必填欄位結束

            let fd = new FormData(document.form1);

            if (isPass) {

                fetch('room_data_edit_api.php', {
                    method: 'POST',
                    body: fd
                }).then(response => {
                        console.log(response);
                        return response.json();
                    })
                    .then(json => {
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
            return false;
        }


    </script>
</div>
<?php include  '../__html_foot.php' ?>
