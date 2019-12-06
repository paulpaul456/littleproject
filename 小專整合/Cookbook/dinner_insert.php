<?php

require  '../__connect_db.php';
$page_name = 'dinner_insert';
$page_title = 'dinner_insert';

include __DIR__ .'/value_match.php';

// 圖片上傳的本機資料夾
$uploads = __DIR__. '/my_uploads/';

$set = empty($_POST['set'])? [] : $_POST['set'];
$set2 = empty($_POST['set2'])? 0 : intval($_POST['set2']);
$ingred = empty($_POST['ingred'])? 0 : intval($_POST['ingred']);

// 拿 product_class 食物名稱
$sql = "SELECT `category_sid`, `class_sid`, `name` FROM `product_class` WHERE 1";

$stmt = $pdo->query($sql);

$total_food_class = $stmt->fetchAll(PDO::FETCH_NUM);
// print_r($total_food_class);

$food = [];
foreach ($total_food_class as $k=>$v) {
    // print_r($v) ;
    $food[] = [$v[0]=>$v[2]];
};
// print_r($food);

$food_sid = [];
foreach ($total_food_class as $k=>$v) {
    // print_r($v) ;
    $food_sid[] = [$v[1]=>$v[2]];
};
// print_r($food_sid);


?>
<?php include  '../__html_head.php' ?>
<?php include '../__html_body.php'   ?>
<?php include '../__html_breadCrumb.php'   ?>

<style>
        .img_wr{
            width: 200px;
            overflow: hidden;
            display:inline;
        }
        .thumb{
            width:100%;
            object-fit: cover;
        }
        .form_control{
          width: 100%;
          height: calc(1.5em + 0.75rem + 2px);
          padding: 0.375rem 0.75rem;
          font-size: 1rem;
          font-weight: 400;
          line-height: 1.5;
          color: #495057;
          background-color: #fff;
          background-clip: padding-box;
          border: 1px solid #ced4da;
          border-radius: 0.25rem;
          transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        }
        small {
          border-radius: 3px;
          padding: 5px;
        }
</style>

  <div class="container">
    <div>
        <pre><?php
            if(! empty($_FILES)){
               var_dump($_FILES);
            }
             
            if(! empty($_POST)){
              var_dump($_POST);
            }
              
        ?>
        </pre>
    </div>


    <div class="card col-md-10">
      <div class="card-body">
        <h5 class="card-title">新增菜色表單</h5>
          <form name="dinner_form"  enctype="multipart/form-data" onsubmit="return checkForm()">
            <!-- <label for="restaurant_id">請選擇餐廳 sid</label>
            <select name="restaurant_id" id="restaurant_id">
              <option value=""></option>
            </select> -->
            
            <div class="form-group col-md-6">
                <label for="">** 菜色大分類</label>
                <?php foreach ($main_cat as $k=>$v): ?>
                <input type="radio" id="main_cat_<?= $k ?>" name="main_cat" value="<?= $v ?>"><?= $v ?>
                <?php endforeach; ?>
            </div>

            <div class="form-group col-md-6">
                <label for="">** 菜色子分類</label>
                <?php foreach ($small_cat as $k=>$v): ?>
                <input type="radio" id="small_cat_<?= $k ?>" name="small_cat" value="<?= $v ?>"><?= $v ?>
                <?php endforeach; ?>
            </div>
            
            <div class="form-group">
                <label for="Email">** 菜色名稱 (15字內) (中文)</label>
                <input type="text" class="form-control" id="dinner" name="dinner">
            </div>

            <div class="form-group">
                <label for="intro">** 特色簡介 (20字內) (中文)</label>
                <textarea class="form-control" id="intro" name="intro"></textarea>
            </div>

            <div class="form-group col-md-12">
                <label for="food">預設主食材</label>
                <select class="form_control col-md-3" id="main_ingred_default" name="main_ingred1">
                <option selected value="">--選擇類別--</option>
                <?php foreach ($main_ingred_class as $k=>$v): ?>
                <option class="main_ingred_sel" id="main_ingred_sel-<?= $k ?>" value="<?= $k ?>"><?= $v ?></option>
                <?php endforeach; ?>
                </select>

            <!-- js change event 撈 `product_class` 資料 -->
                <select class="form_control col-md-3" id="main_ingred_default_Place"  name="main_ingred">
                <option id="main_food" selected value="">--請選擇--</option>
                </select>
            </div>


            <div class="form-group col-md-12">
              <div class="form-group col-md-10">
                <label for="food">可替換主食材 (1) </label>
                <select class="form_control col-md-4" id="main_ingred_01" name="main_ingred2">
                <option selected value="">--選擇類別--</option>
                <?php foreach ($main_ingred_class as $k=>$v): ?>
                <option class="main_ingred_sel" value="<?= $k ?>"><?= $v ?></option>
                <?php endforeach; ?>
                </select>

              <!-- js change event 撈 `product_class` 資料 -->
                <select class="form_control col-md-4" id="main_ingred_01_Place" name="main_ingred_place01">
                <option id="main_food_place1" selected value="">--請選擇--</option>
                </select>
              </div>

              <div class="form-group col-md-10">
                <label for="food">可替換主食材 (2) </label>
                <select class="form_control col-md-4" id="main_ingred_02" name="main_ingred3">
                <option selected value="">--選擇類別--</option>
                <?php foreach ($main_ingred_class as $k=>$v): ?>
                <option value="<?= $k ?>"><?= $v ?></option>
                <?php endforeach; ?>
                </select>
              
              <!-- js change event 撈 `product_class` 資料 -->
                <select class="form_control col-md-4" id="main_ingred_02_Place" name="main_ingred_place02">
                <option id="main_food_place2" selected value="">--請選擇--</option>
                </select>
              </div>

              <div class="form-group col-md-10">
                <label for="food">可替換主食材 (3) </label>
                <select class="form_control col-md-4" id="main_ingred_03" name="main_ingred4">
                <option selected value="">--選擇類別--</option>
                <?php foreach ($main_ingred_class as $k=>$v): ?>
                <option value="<?= $k ?>"><?= $v ?></option>
                <?php endforeach; ?>
                </select>

              <!-- 撈食材資料 -->
                <select class="form_control col-md-4" id="main_ingred_03_Place" name="main_ingred_place03">
                <option id="main_food_place3" selected value="">--請選擇--</option>
                <option></option>
                </select>
              </div>
            </div>

            <div class="form-group">
                <label for="picture">上傳菜色照片 (最少1張，最多3張)</label>
                <!-- <button id="choose_file" onclick="choose()">選擇檔案</button> -->
                
                <input type="file" style="cursor:grab" class="form-control" id="picture" name="picture[]" multiple>選擇檔案
                <small id="pictureHelp"></small>
            </div>
            <div onclick="removePic()" style="color:gray; cursor:grab">重新選擇</div>

            <div class="form-group col-md-6">預覽照片</div>
            <div id="list" class=""></div>
           
            

            <button type="submit" class="btn btn-primary">Submit</button>

          </form>
      </div>
    </div>   
  </div>

  <script>

      // 抓資料表資料做兩層下拉選單

      let group = [
        {
          'id':'main_ingred_default',
          'small_id':'main_ingred' 
        },
        {
          'id':'main_ingred_01',
          'small_id':'main_ingred_place01'
        },
        {
          'id':'main_ingred_02',
          'small_id':'main_ingred_place01'
        },
        {
          'id':'main_ingred_03',
          'small_id':'main_ingred_place01'
        },
      ];

      let food_class = <?= json_encode($food, JSON_UNESCAPED_UNICODE); ?>;
      let food_sid = <?= json_encode($food_sid, JSON_UNESCAPED_UNICODE); ?>;
      let classChoose;
      let rice_class = [];
      let list = document.querySelector('#list');
      // let img_wr = document.querySelector('.img_wr');

      // console.log(food_class);
      // console.log(food_sid);

      group.forEach(classChoose=>{
        classChoose.el = document.querySelector('#' + classChoose.id);
        classChoose.chooseEl = document.querySelector('#' + classChoose.id + '_Place');
        // console.log(classChoose);
      })
      // console.log(group);

      for(s in food_class){
        rice_class.push(food_class[s]);
      }

      let chooseEvent = function(e){
          let value = e.target.value;  
          console.log(value);        
          let unix = [];

          rice_class.forEach(element => {
            let food_name = element[`${value}`];
          
            if(food_name){
              unix.push(food_name);  
            }           
          });
          // console.log(unix);
          
          let c2 = '';

          for(s in food_sid){
            for(k in food_sid[s]){
              // console.log(food_sid[s][k]);
              unix.forEach(el=>{           
                if(food_sid[s][k]==el){
                  // console.log(k+el);
                   c2 += `<option value = "${k}">${el}</option>`
                }
              })
            }
          }
         
          // console.log(e.target.id);
          
          group.forEach(classChoose=>{
            if(classChoose.id == e.target.id){
              classChoose.chooseEl.innerHTML = `<option>--選擇食材--</option>` + c2;
            }
          });
      };

      group.forEach(classChoose=>{
        classChoose.el.addEventListener('change', chooseEvent);   
      });
      
            // 光箱問答
            Notiflix.Confirm.Init({
          width: "350px",
          okButtonBackground: "#ce4e4e",
          titleColor: "#e81616",
          titleFontSize: "20px",
          fontFamily: "Arial",
          useGoogleFont: false,
      });

      function checkForm(){

        let fd = new FormData(document.dinner_form);

        fetch('dinner_insert_API.php', {
            method: 'POST',
            body: fd
        })
            .then(response=>{
                return response.json();
            })
            .then(json=>{
                console.log(json);
                Notiflix.Confirm.Show(
                  // Notice Content
                  `${json.status}`,
                  `${json.info}`,
                  '回菜色列表',
                  `${json.orto}`,
                  // ok button callback
                  function () {
                        location.href="dinner_list.php"
                  },

                  // cancel button callback
                  function() {
                    if(json.orto=='新增下一筆'){
                        location.href="dinner_insert.php"
                    }
                  }
              );
                // alert(json);
            })

        return false;
        };
      
      function removePic(){

        let img = document.querySelector('.thumb');

        // console.log(list.childNodes);

        list.childNodes[0].outerHTML="";

        removePic();    
      } 
      // console.log(list.childNodes);

  </script>
<script src="my_js/image_preview.js"></script>

<?php include '../__html_foot.php' ?>