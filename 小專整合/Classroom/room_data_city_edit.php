<?php
require  '../__connect_db.php';
$page_name = 'room_data_city_edit';
$page_title = '編輯資料';

$sid = isset($_GET['sid']) ? intval($_GET['sid']) : 0;

if(empty($sid)) {
    header('Location: room_data_city_list.php');
    exit;
};

$sql = "SELECT * FROM country  WHERE `country_sid`=$sid";
$row = $pdo->query($sql)->fetch();
if(empty($row)) {
    header('Location: room_data_city_list.php');
    exit;
};

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
                        <form name="form1" onsubmit="return checkForm()">
                            <input type="hidden" id="country_sid" name="country_sid" value="<?= $row['country_sid'] ?>">
                            <div class="form-group">
                                <label for="city">縣市</label>
                                <input type="text" class="form-control" id="city" name="city" value="<?= $row['city'] ?>">
                                <small id="cityHelp" class="form-text"></small>
                            </div>
                            <div class="form-group">
                                <label for="dist">行政區</label>
                                <input type="text" class="form-control" id="dist" name="dist" value="<?= $row['dist'] ?>">
                                <small id="distHelp" class="form-text"></small>
                            </div>

                            <div class="form-group">
                                <label for="Orientation">區域</label>
                                <input type="text" class="form-control" id="Orientation" name="Orientation" value="<?= $row['Orientation'] ?>">
                                <small id="OrientationHelp" class="form-text"></small>
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
                id: 'city',
                pattern: /^\S{2,}/,
                info: '請填寫正確的縣市'
            }
        //     {
        //         id: 'phone',
        //         pattern: /^[0]{1}\d{1,3}-\d{7,8}$|^[0]{1}\d{1,3}-\d{7,8}#\d{2,3}$/,
        //         info: '請填寫正確的 電話 格式'
        //     },
        //
        ];

        // 拿到對應的 input element (el), 顯示訊息的 small element (infoEl)
        for(s in required_fields){
            item = required_fields[s];
            item.el = document.querySelector('#' + item.id);
            item.infoEl = document.querySelector('#' + item.id + 'Help');
        }

        function checkForm() {

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

            let fd = new FormData(document.form1);

            if (isPass) {
                fetch('room_data_city_edit_api.php', {
                    method: 'POST',
                    body: fd,
                })
                    .then(response => {
                        console.log(response);
                        return response.json();
                    })
                    .then(json => {
                        console.log(json);
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
