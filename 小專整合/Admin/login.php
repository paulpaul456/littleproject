<?php
require '../__connect_db.php';
$page_name = 'login';
$page_title = 'Login';
?>
<?php include '../__html_head.php' ?>
<style>
small.form-text {
    color: red;
    transition: 1s;
}

input {
    transition: 1s;
}
</style>

<body style="background: #eeeeee">
    <nav class=" navbar ">
        <div class="container">
            <div class="navbar-header logo">
                <a href="#" style="color: #252422;" class="navbar-brand">OrganicFoo</a>
            </div>
        </div>
    </nav>
    <div class="container my-5 ">
        <div class="row justify-content-center ">
            <div class="col-lg-4 col-md-6 col-sm-8">
                <form name="loginform" onsubmit="return checkForm()">
                    <div class="card px-4">
                        <div class="card-header text-center">
                            <h3 class="card-title">Login</h3>
                        </div>
                        <div class="card-content">
                            <div class="form-group">
                                <label for="email">Email address</label>
                                <input type="email" id="email" placeholder="Enter email" class="form-control "
                                    name="email">
                                <small id="emailHelp" class="form-text"></small>
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" id="password" placeholder="Password" class="form-control"
                                    name="password">
                                <small id="passwordHelp" class="form-text"></small>
                            </div>
                        </div>
                        <div class="card-footer text-center">
                            <div class="col-md-2 mx-auto mb-3" id="success"></div>
                            <button type="submit" id="submit_btn" class="btn btn-fill btn-wd mx-auto mb-2">Let's
                                go</button>
                            <div id="forgot_btn">
                                <a href="#" class="">Forgot your password?</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <footer class="footer footer-transparent fixed-bottom">
        <div class="container">
            <div class="text-center">
                © Coded with
                <i class="fas fa-carrot"></i> by
                <a href="#" target="_blank">Sunny</a>. Designed by <a href="#" target="_blank">SSS</a>.
            </div>
        </div>
    </footer>
    <script>
    const submit_btn = document.querySelector('#submit_btn');
    const forgot_btn = document.querySelector('#forgot_btn');
    const success = document.querySelector('#success')
    const succes_icon_str = `
    <div class="success-positioning" style="transform: translate(-30px);">
    <div class="success-icon" >
    <div class="success-icon__tip"></div>
    <div class="success-icon__long"></div>
    </div></div>`;
    let i, s, item;
    const required_fields = [{
            id: 'email',
            pattern: /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i,
            info: 'Type The Correct Email'
        },
        {
            id: 'password',
            pattern: /\w{4,8}/,
            info: 'Type The Correct password'
        }
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
        forgot_btn.style.display = 'none';
        // 檢查必填欄位, 欄位值的格式

        let isPass = true;
        for (s in required_fields) {
            item = required_fields[s];
            if (!item.pattern.test(item.el.value)) {
                item.el.style.border = '1px solid red';
                item.infoEl.innerHTML = item.info;
                isPass = false;
                setTimeout(() => {
                    submit_btn.style.display = 'block';
                    forgot_btn.style.display = 'block';
                }, 1500);
            }
        }
        let fd = new FormData(document.loginform);
        if (isPass) {
            fetch('login_api.php', {
                    method: 'POST',
                    body: fd
                })
                .then(response => {
                    console.log(response);
                    return response.json();
                    setTimeout(() => {
                        submit_btn.style.display = 'block';
                        forgot_btn.style.display = 'block';
                    }, 2000);

                })
                .then(json => {
                    console.log(json);
                    if (json.success) {
                        setTimeout(() => {
                            success.innerHTML = succes_icon_str;
                        }, 500);
                        setTimeout(() => {
                            location.href = 'adminHome.php';
                        }, 2500);
                        setTimeout(() => {
                            submit_btn.style.display = 'block';
                            forgot_btn.style.display = 'block';
                        }, 3000);
                    } else {
                        setTimeout(() => {
                            submit_btn.style.display = 'block';
                            forgot_btn.style.display = 'block';
                        }, 2000);
                        
                    }

                })

        }

        return false; // 表單不出用傳統的 post 方式送出
    }
    </script>


    <?php include '../__html_foot.php' ?>