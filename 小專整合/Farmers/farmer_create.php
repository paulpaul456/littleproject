<?php
require '../__admin_required.php';
require  '../__connect_db.php';
$page_name = 'farmer_create';
$page_title = 'Farmer_create';

/*$sid = isset($_GET['sid']) ? intval($_GET['sid']) : '';
if(empty($sid)){
    header('Location: $_SERVER[\'HTTP_REFERER\']');
    exit;
}*/
$sql = "SELECT `farmer_id` FROM `farmers` ORDER BY `farmer_id` DESC";
$stmt = $pdo->query($sql);
$row = $stmt->fetch();
$sid = $row['farmer_id']+1;
/*if(empty($row_t)){
header('Location: farmer.php');
exit;
}*/
?>
<?php include  '../__html_head.php'?>
<?php include  '../__html_body.php'?>
<style>
small.form-text {
    color: red;
    transition: 1s;
}

input {
    transition: 1s;
}

.img-group {
    max-width: 100%;
    max-height: 160px;
    border: 1px dashed #E3E3E3;
    border-radius: 4px;
    padding-bottom: 10px;
}

.img-group label {
    display: block
}

img.thumb {
    max-width: 100%;
    max-height: 120px;
}

#submit_btn {
    transition: .5s;
}
#img_block1{
    width:100%;
    height:130px;
    background-color: rgba(0, 0, 0, 0);
    
}
#img_block2{
    width:100%;
    height:124px;
    background-color: rgba(0, 0, 0, 0);
    border-radius:50%;
    left:0;
    top:-60px;
}
#upload_icon1{
    color:transparent;
    left:50%;
    transform:translate(-50%) scale(3);
    top:30px;
}
#img_block1:hover #upload_icon1{
    color:rgba(0, 0, 0, 0.2);
}
#upload_icon2{
    color:transparent;
    left:50%;
    transform:translate(-50%) scale(2);
    top:50px;
}
#img_block2:hover #upload_icon2{
    color:rgba(0, 0, 0, 0.2);
}
#img_block1:hover{
    width:100%;
    height:130px;
    border-radius:12px 12px 0 0 ;
    background-color: rgba(0, 0, 0, 0.2);
}
#img_block2:hover{
    border: 1px solid #FFFFFF;
    background-color: rgba(0, 0, 0, 0.2);
}
</style>
<div class="content mt-n2">
    <div class="row justify-content-center">
        <!--<div class="col-md-4">
            <div class="card card-user">
                <div class="image">
                    <img src="../assets/img/farm1.jpg" alt="...">
                </div>
                <div class="card-body">
                    <div class="author">
                        <a href="#">
                            <img class="avatar border-gray" src="../assets/img/farmer1.jpg" alt="...">
                        </a>
                        <a href=""><h5 class="title"><?=  $row['storename']?></h5></a>
                        <p class="description">
                            <?=  $row['name']?>
                        </p>
                    </div>
                    <p class="description text-center">
                        "I like the way you work it
                        <br> No diggity
                        <br> I wanna bag it up"
                    </p>
                </div>
                <div class="card-footer">
                    <hr>
                    <div class="button-container">
                        <div class="row">
                            <div class="col-lg-4 col-md-6 col-6 ml-auto">
                                <h5>12
                                    <br>
                                    <small>Product</small>
                                </h5>
                            </div>
                            <div class="col-lg-4 col-md-6 col-6 ml-auto mr-auto">
                                <h5>20
                                    <br>
                                    <small>Follow</small>
                                </h5>
                            </div>
                            <div class="col-lg-4 mr-auto">
                                <h5>30k
                                    <br>
                                    <small>Month</small>
                                </h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>-->
        <div class="col-md-8">
            <div class="card card-user">
                <div class="card-header row">
                    <h5 class="card-title col-md-10 ">#<?=  $sid?></h5>
                    <div class="col-md-2 success-positioning">

                    </div>
                </div>
                <div class="card-body">
                    <form id="form1" name="form1" onsubmit="return checkForm()">
                        <input type="hidden" name="sid" value="<?= $sid ?>">
                        <div class="row">
                            <div class="col-md-5 pr-1">
                                <div class="form-group">
                                    <label for="company">Company</label>
                                    <input type="text" class="form-control " id="company" name="company"
                                        placeholder="Company">
                                    <small id="companyHelp" class="form-text float-left "></small>
                                </div>
                            </div>
                            <div class="col-md-4 px-1">
                                <div class="form-group">
                                    <label for="storename">Storename</label>
                                    <input type="text" class="form-control" name="storename" id="storename"
                                        placeholder="Username">
                                    <small id="storenameHelp" class="form-text float-left "></small>
                                </div>
                            </div>
                            <div class="col-md-3 pl-1">
                                <div class="form-group">
                                    <label for="taxid">Tax ID</label>
                                    <input type="text" class="form-control" id="taxid" name="taxid" placeholder="ID">
                                    <small id="taxidHelp" class="form-text float-left "></small>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 pr-1">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Yourame">
                                    <small id="nameHelp" class="form-text float-left "></small>
                                </div>
                            </div>

                            <div class="col-md-6 pl-1">
                                <div class="form-group">
                                    <label for="nickname">Nick Name</label>
                                    <input type="text" class="form-control" id="nickname" name="nickname"
                                        placeholder="NickName">
                                    <small id="nicknameHelp" class="form-text float-left "></small>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 pr-1">
                                <div class="form-group">
                                    <label for="telephone">TEL</label>
                                    <input type="text" class="form-control" id="telephone" name="telephone"
                                        placeholder="02-2233-2453">
                                    <small id="telephoneHelp" class="form-text float-left "></small>
                                </div>
                            </div>
                            <div class="col-md-4 px-1">
                                <div class="form-group">
                                    <label for="mobil">Mobile</label>
                                    <input type="text" class="form-control" id="mobile" name="mobile"
                                        placeholder="0939-237-000">
                                    <small id="mobileHelp" class="form-text float-left "></small>
                                </div>
                            </div>
                            <div class="col-md-4 pl-1">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" id="email" name="email"
                                        placeholder="ooxx@gmail.com">
                                    <small id="emailHelp" class="form-text float-left "></small>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 pr-1">
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="text" class="form-control" id="password" name="password"
                                        placeholder="Password">
                                    <small id="passwordHelp" class="form-text float-left "></small>
                                </div>
                            </div>
                            <div class="col-md-6 pl-1">
                                <div class="form-group">
                                    <label for="comfirm">Password Confirm</label>
                                    <input type="text" class="form-control" id="comfirm" name="comfirm"
                                        placeholder="Confirm">
                                    <small id="comfirmHelp" class="form-text float-left "></small>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="address">Address</label>
                                    <input type="text" class="form-control" id="address" name="address"
                                        placeholder="Home Address">
                                    <small id="addressHelp" class="form-text float-left "></small>
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="aboutme">About Me</label>
                                    <textarea class="form-control textarea" id="aboutme"
                                        name="aboutme">Aboutme</textarea>
                                    <small id="aboutmeHelp" class="form-text float-left "></small>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group text-center img-group">
                                    <label>Background Image</label>
                                    <input type="file" accept="image/png,image/jpeg,image/gif" id="background"
                                        class="form-control" name="background">
                                    <small id="backgroundHelp"></small>
                                    <output id="list"></output>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group text-center img-group">
                                    <label>Photo</label>
                                    <input type="file" id="photo" class="form-control" name="photo">
                                    <small id="photoHelp"></small>
                                    <output id="list1"></output>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="update ml-auto mr-auto">
                                <button type="submit" class="btn btn-primary btn-round" id="submit_btn">Create
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

<?php include __DIR__.'/__js_image_previes.php' ?>

<script>
const submit_btn = document.querySelector('#submit_btn');
const form1 = document.querySelector('#form1')
const success = document.querySelector('.success-positioning')
const succes_icon_str = `<div class="success-icon">
                            <div class="success-icon__tip"></div>
                            <div class="success-icon__long"></div>
                        </div>`;
let i, s, item;
const required_fields = [{
        id: 'company',
        pattern: /[A-Z]+/,
        info: 'Wrong Text'
    },
    {
        id: 'storename',
        pattern: /^[A-Z]{3,20}$/,
        info: 'Wrong Text'
    },
    {
        id: 'taxid',
        pattern: /^\d{8}$/,
        info: 'Wrong TaxID'
    },
    {
        id: 'name',
        pattern: /^\S{2,}/,
        info: 'What Your Name Again?'
    },
    {
        id: 'nickname',
        pattern: /^\S{2,}/,
        info: 'What Your Name Again?'
    },
    {
        id: 'mobile',
        pattern: /^09\d{2}\-?\d{3}\-?\d{3}$/,
        info: 'I Will Call You'
    },
    {
        id: 'email',
        pattern: /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i,
        info: 'Type The Correct Email'
    },
    
    {
        id: 'password',
        pattern: /\d{4,8}/,
        info: 'Type The Correct password'
    },
    {
        id: 'address',
        pattern: /[A-Z]+/,
        info: 'Wrong Address'
    },
];
// 拿到對應的 input element (el), 顯示訊息的 small element (infoEl)
for (s in required_fields) {
    item = required_fields[s];
    item.el = document.querySelector('#' + item.id);
    item.infoEl = document.querySelector('#' + item.id + 'Help');
};

function checkForm() {
    // 先讓所有欄位外觀回復到原本的狀態
    for (s in required_fields) {
        item = required_fields[s];

        item.el.style.border = '1px solid #dddddd';
        item.infoEl.innerHTML = '';
    }
    submit_btn.style.display = 'none';
    // 檢查必填欄位, 欄位值的格式
    setTimeout(() => {
        submit_btn.style.display = 'block';
    }, 2000);
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
        fetch('farmer_create_api.php', {
                method: 'POST',
                body: fd
            })
            .then(response => {
                console.log(response);
                return response.json();
                
            })
            .then(json => {
                console.log('response.json');
                if (json.success) {
                    console.log('json.success');
                    console.log(json.info);
                    success.innerHTML = succes_icon_str;
                    setTimeout(() => {
                        location.href = './farmer.php';
                    }, 1500)
                } else {
                    console.log('json.fail');
                    console.log(json.info);
                    submit_btn.style.display = 'block';
                }
            })

    }

    return false; // 表單不出用傳統的 post 方式送出
}
</script>
<?php include '../__html_foot.php'?>