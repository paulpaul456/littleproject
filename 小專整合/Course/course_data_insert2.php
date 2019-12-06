<?php
require  '../__connect_db.php';
$page_name = 'course_data_insert';
$page_title = '新增課程';

$c_time = [
    '早上' => '早上(9:00~12:00)',
    '下午' => '下午(14:00~17:00)',
    '晚上' => '晚上(19:00~21:00)',
];

$course_time = empty($_POST['course_time']) ? 0 : intval($_POST['course_time']);


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
                            <h5 class="card-title">新增課程</h5>
                            <form name="form1" onsubmit="return checkForm()">
                                <div class="form-group">
                                    <label for="course_name">課程名稱</label>
                                    <input type="text" class="form-control" id="course_name" name="course_name">
                                    <small id="course_nameHelp" class="form-text"></small>
                                </div>
                                <div class="form-group">
                                    <label for="restaurant_id">開課單位ID</label>
                                    <input type="text" class="form-control" id="restaurant_id" name="restaurant_id">
                                    <small id="restaurant_idHelp" class="form-text"></small>
                                </div>

                                <div class="form-group">
                                    <label for="room_sid">教室地點ID</label>
                                    <input type="text" class="form-control" id="room_sid" name="room_sid">
                                    <small id="room_sidHelp" class="form-text"></small>
                                </div>

                                <div class="form-group">
                                    <label for="course_date">課程日期</label>
                                    <input type="text" class="form-control" id="course_date" name="course_date"
                                           value="2019-08-25">
                                    <small id="course_dateHelp" class="form-text"></small>
                                </div>


                                <div class="form-group">
                                    <label for="course_time">課程時段</label>
                                    <select class="form-control" id="course_time" name="course_time">
                                        <!--    <option value="">--請選擇--</option>  -->
                                        <?php foreach($c_time as $k=>$v): ?>
                                            <option value="<?= $k ?>"> <?= $v ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>



                                <div class="form-group">
                                    <label for="course_number_limit">開課人數</label>
                                    <input type="text" class="form-control" id="course_number_limit"
                                           name="course_number_limit">
                                    <small id="course_number_limitHelp" class="form-text"></small>
                                </div>
                                <div class="form-group">
                                    <label for="course_content">課程內容</label>
                                    <textarea type="text" class="form-control" id="course_content" name="course_content"></textarea>
                                    <small id="course_contentHelp" class="form-text"></small>
                                </div>
                                <div class="form-group">
                                    <label for="course_note">注意事項</label>
                                    <input type="text" class="form-control" id="course_note" name="course_note">
                                    <small id="course_noteHelp" class="form-text"></small>
                                </div>

                                <div class="form-group">
                                    <input type="file" onchange="previewFile()" class="form-control-file" id="my_file" name="my_file" style="display: none">
                                    <button type="button" class="btn btn-info" onclick="selUpload()">選擇上傳的圖檔</button>
                                    <img id="pre_img" src="" >
                                </div>



                                <button type="submit" class="btn btn-primary" id="submit_btn">新增</button>
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
                    id: 'course_name',
                    pattern: /^\S{4,}/,
                    info: '請填寫正確的課程名稱'
                },
                {
                    id: 'restaurant_id',
                    pattern: /\d/,
                    info: '請填寫正確的開課單位ID'
                },

            ];

            // 拿到對應的 input element (el), 顯示訊息的 small element (infoEl)
            for (s in required_fields) {
                item = required_fields[s];
                item.el = document.querySelector('#' + item.id);
                item.infoEl = document.querySelector('#' + item.id + 'Help');
            }

            //   /[A-Z]{2}\d{8}/i  統一發票


            function checkForm() {
                // 先讓所有欄位外觀回復到原本的狀態
                for (s in required_fields) {
                    item = required_fields[s];
                    item.el.style.border = '1px solid #CCCCCC';
                    item.infoEl.innerHTML = '';
                }

                info_bar.style.display = 'none';
                info_bar.innerHTML = '';

                submit_btn.style.display = 'none';

                // TODO: 檢查必填欄位, 欄位值的格式   (TODO把註解做其他顏色做強調用)
                // 可在Console及Network裡面勾選preserve log保留錯誤除錯 避免轉頁後無錯誤訊息
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
                    fetch('course_data_insert_api.php', {
                        method: 'POST',
                        body: fd,
                    })
                        .then(response => {
                            return response.json();
                        })
                        .then(json => {
                            console.log(json);
                            info_bar.style.display = 'block';
                            submit_btn.style.display = 'block';
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

        <script>
            //preview picture
            function previewFile() {
                let preview = document.querySelector('#pre_img');
                let file    = document.querySelector('input[type=file]').files[0];
                let reader  = new FileReader();

                reader.addEventListener("load", function () {
                    preview.src = reader.result;
                }, false);

                if (file) {
                    reader.readAsDataURL(file);
                }
            }

            function selUpload(){
                document.querySelector('#my_file').click();
            }

        </script>

    </div>

<?php include  '../__html_foot.php' ?>