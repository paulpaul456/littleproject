<?php
require  '../__admin_required.php';
require  '../__connect_db.php';
$page_name = 'Account';
$page_title = 'Account';

// $sid = isset($_GET['sid']) ? intval($_GET['sid']) : '';
// if(empty($sid)){
//     header('Location: $_SERVER[\'HTTP_REFERER\']');
//     exit;
// }
$sql = "SELECT * FROM `admin` WHERE `id`={$_SESSION['loginUser']['id']}";
$stmt = $pdo->query($sql);
$row = $stmt->fetch();
if (empty($row)) {
    header('Location: $_SERVER["HTTP_REFERER"]');
    exit;
}

?>
<?php include  '../__html_head.php' ?>
<?php include  '../__html_body.php' ?>
    <style>
        small.form-text {
            color: red;
            transition: 1s;
        }

        input {
            transition: 1s;
        }
    </style>
    <div class="content mt-n2">
        <div class="row justify-content-center">
            <div class="col-lg-5 col-md-6 col-sm-8">
                <div class="card card-user">
                    <div class="card-header row">
                        <h5 class="card-title col-md-10 ">Hey <?= $row['nickname'] ?></h5>
                        <div class="col-md-2 success-positioning">
                        </div>
                    </div>
                    <div class="card-body mt-n3">

                        <form id="form1" name="form1" onsubmit="return checkForm()">
                            <input type="hidden" name="id" value="<?= $row['id'] ?>">
                            <!-- <div class="row">
                            <div class="col-md-5 pr-1">
                                <div class="form-group">
                                    <label>Company (disabled)</label>
                                    <input type="text" class="form-control " disabled="" name="company"
                                        placeholder="Company" value="<?= $row['company'] ?>">
                                </div>
                            </div>
                            <div class="col-md-4 px-1">
                                <div class="form-group">
                                    <label>Storename</label>
                                    <input type="text" class="form-control" name="storename" placeholder="Username"
                                        value="<?= $row['storename'] ?>">

                                </div>
                            </div>
                            <div class="col-md-3 pl-1">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tax ID</label>
                                    <input type="text" class="form-control" id="taxid" name="taxid" placeholder="ID"
                                        value="<?= $row['taxid'] ?>">
                                    <small id="taxidHelp" class="form-text float-left "></small>
                                </div>
                            </div>
                        </div> -->
                            <div class="row">
                                <div class="col-md-6 pr-1">
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" class="form-control" id="name" name="name"
                                               placeholder="Yourame"
                                               value="<?= $row['nickname'] ?>">
                                        <small id="nameHelp" class="form-text float-left "></small>
                                    </div>
                                </div>
                                <div class="col-md-6 pl-1">
                                    <div class="form-group">
                                        <!--                                <label for="name">Name</label>-->
                                        <!--                                    <input type="text" class="form-control" id="name" name="name" placeholder="Yourame"-->
                                        <!--                                        value="<?= $row['nickname'] ?>">-->
                                        <!--                                    <small id="nameHelp" class="form-text float-left "></small>-->
                                        <label for="mobile">Mobile</label>
                                        <input type="text" class="form-control" id="mobile" name="mobile"
                                               placeholder="0939-237-000" value="<?= $row['mobile'] ?>">
                                        <small id="mobileHelp" class="form-text float-left "></small>
                                    </div>
                                </div>
                            </div>
                            <div class="row justify-content-center">
                                <div class="col-md-10">
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="text" class="form-control" id="email" name="email" placeholder="Email"
                                               value="<?= $row['email'] ?>">
                                        <small id="emailHelp" class="form-text float-left "></small>
                                    </div>
                                </div>
                            </div>


                            <div class="row justify-content-center">
                                <div class="col-md-6 pl-3 pr-1">
                                    <div class="form-group">
                                        <label>Password</label>
                                        <input type="password" class="form-control" name="password" id="password"
                                               placeholder="Password"
                                               >
                                        <small id="passwordHelp" class="form-text float-left "></small>
                                    </div>
                                </div>
                                <div class="col-md-6 pr-3 pl-1">
                                    <div class="form-group">
                                        <label>Confirm</label>
                                        <input type="password" class="form-control" name="Confirm" id="Confirm"
                                               placeholder="Confirm">
                                        <small id="ConfirmHelp" class="form-text float-left "></small>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="update ml-auto mr-auto">
                                    <button type="submit" class="btn btn-primary btn-round" id="submit_btn">Update
                                        Profile
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
    <script>
        const submit_btn = document.querySelector('#submit_btn');
        const form1 = document.querySelector('#form1')
        const success = document.querySelector('.success-positioning')
        const succes_icon_str = `<div class="success-icon">
                            <div class="success-icon__tip"></div>
                            <div class="success-icon__long"></div>
                        </div>`;
        let i, s, item;
        const required_fields = [
            // {
            //     id: 'name',
            //     pattern: /^\S{2,}/,
            //     info: 'What Your Name Again?'
            // },
            {
                id: 'email',
                pattern: /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i,
                info: 'Type The Correct Email'
            },
            {
                id: 'mobile',
                pattern: /^09\d{2}\-?\d{3}\-?\d{3}$/,
                info: 'I Will Call You'
            },
            {
                id: 'password',
                pattern: /^\d{4,16}$/,
                info: 'Wrong Password'
            }
        ];
        // 拿到對應的 input element (el), 顯示訊息的 small element (infoEl)
        for (s in required_fields) {
            item = required_fields[s];
            item.el = document.querySelector('#' + item.id);
            item.infoEl = document.querySelector('#' + item.id + 'Help');
        }
        ;

        function checkForm() {
            // 先讓所有欄位外觀回復到原本的狀態
            for (s in required_fields) {
                item = required_fields[s];
                item.el.style.border = '1px solid #dddddd';
                item.infoEl.innerHTML = '';
            }
            submit_btn.style.display = 'none';
            // 檢查必填欄位, 欄位值的格式

            let isPass = true;
            for (s in required_fields) {
                item = required_fields[s];
                if (!item.pattern.test(item.el.value)) {
                    item.el.style.border = '1px solid red';
                    item.infoEl.innerHTML = item.info;
                    isPass = false;
                    setTimeout(()=>{
                        submit_btn.style.display = 'block';
                    },2000)
                }
            }
            let fd = new FormData(document.form1);
            if (isPass) {
                fetch('admin_edit_api.php', {
                    method: 'POST',
                    body: fd
                })
                    .then(response => {
                        console.log(response)
                        
                        success.innerHTML = succes_icon_str;
                        setTimeout(()=>{
                            success.innerHTML = '';
                        },2000);
                        setTimeout(()=>{
                            submit_btn.style.display = 'block';
                            location.href='logout.php';
                        },2500)

                    })

            }

            return false; // 表單不出用傳統的 post 方式送出
        }
    </script>
<?php include  '../__html_foot.php' ?>