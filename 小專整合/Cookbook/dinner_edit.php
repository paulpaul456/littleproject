<?php

require '../__connect_db.php';

$page_name = 'dinner_edit';
$page_title = 'dinner_edit';

include __DIR__ .'/value_match.php';

// 圖片上傳的本機資料夾
$uploads = __DIR__. '/my_images/';

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


// 以下為編輯資料的部分，拿資料庫資料預顯示

$sid = $_GET['sid'];

$sql_total = "SELECT * FROM `dinner_list` WHERE `dinner_id`=$sid";

$stmt_total = $pdo->query($sql_total);
$row = $stmt_total->fetch();

// 拿預設的主食材類別名稱
$row_main_ingred = $row['main_ingred'];

$sql_cat = "SELECT p.`class_sid` main_ingred, p.`name` main_ingred_name, p.`category_sid` class_id, c.`name` class_name FROM `product_class` AS p JOIN `product_category` AS c WHERE p.`class_sid`=$row_main_ingred AND p.`category_sid`=c.`category_sid`";

$stmt_cat = $pdo->query($sql_cat);
$row_cat = $stmt_cat->fetch();

// 拿可替換食材1 類別名稱
$row_main_ingred_place1 = $row['main_ingred_replace1'];

$sql_cat_re1 = "SELECT p.`class_sid` main_ingred, p.`name` main_ingred_name, p.`category_sid` class_id, c.`name` class_name FROM `product_class` AS p JOIN `product_category` AS c WHERE p.`class_sid`=$row_main_ingred_place1 AND p.`category_sid`=c.`category_sid`";

$stmt_cat_re1 = $pdo->query($sql_cat_re1);
$row_cat_re1 = $stmt_cat_re1->fetch();

// 拿可替換食材2 類別名稱
$row_main_ingred_place2 = $row['main_ingred_replace2'];

$sql_cat_re2 = "SELECT p.`class_sid` main_ingred, p.`name` main_ingred_name, p.`category_sid` class_id, c.`name` class_name FROM `product_class` AS p JOIN `product_category` AS c WHERE p.`class_sid`=$row_main_ingred_place2 AND p.`category_sid`=c.`category_sid`";

$stmt_cat_re2 = $pdo->query($sql_cat_re2);
$row_cat_re2 = $stmt_cat_re2->fetch();

// 拿可替換食材3 類別名稱
$row_main_ingred_place3 = $row['main_ingred_replace2'];

$sql_cat_re3 = "SELECT p.`class_sid` main_ingred, p.`name` main_ingred_name, p.`category_sid` class_id, c.`name` class_name FROM `product_class` AS p JOIN `product_category` AS c WHERE p.`class_sid`=$row_main_ingred_place3 AND p.`category_sid`=c.`category_sid`";

$stmt_cat_re3 = $pdo->query($sql_cat_re3);
$row_cat_re3 = $stmt_cat_re3->fetch();

// 拿餐廳 id 跟名稱
$sql = "SELECT r.`restaurant_id`, r.`name`
FROM `restaurant` AS r JOIN `dinner_list` AS d
WHERE r.`restaurant_id` IN (d.`restaurant_id`) AND d.`dinner_id`=$sid ORDER BY r.restaurant_id";

$stmt_restaurant = $pdo->query($sql);
$row_restaurant = $stmt_restaurant->fetch(PDO::FETCH_NUM);


// 拿圖片檔
$image = json_decode($row['dinner_image']);


?>
<?php include '../__html_head.php' ?>
<?php include '../__html_body.php'   ?>


<style> 
        .list{
            display: flex;
            flex-flow: column;
            align-items: center;
        }
        .img_wr{
            width: 200px;
            overflow: hidden;
            display:inline;
            margin: auto;
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

            // print_r($row);
              
        ?>
        </pre>
    </div> 


    <div class="card col-md-10">
      <div class="card-body">
        <h5 class="card-title">編輯菜色內容</h5>
          <form name="dinner_form"  enctype="multipart/form-data" onsubmit="return checkForm()">

            <input type="hidden" value="<?= $sid ?>" name="dinner_id">
            <input type="hidden" value="<?= $row['restaurant_id'] ?>">

            <div class="form-group col-md-6">
                <span>** 菜色大分類</span>

                <?php foreach ($main_cat as $k=>$v): ?>
                <input type="radio" id="main_cat_<?= $k ?>" name="main_cat" value="<?= $v ?>"
                <?= ($v == $row['main_cat']) ? 'checked' :'' ?>
                >
                <label for="main_cat_<?= $k ?>"><?= $v ?></label>
                
                <?php endforeach; ?>
            </div>

            <div class="form-group col-md-6">
                <span>** 菜色子分類</span>

                <?php foreach ($small_cat as $k=>$v): ?>
                <input type="radio" id="small_cat_<?= $k ?>" name="small_cat" value="<?= $v ?>"

                <?= ($v = $row['small_cat'])? 'checked' :'' ?>
                >
                <label for="small_cat_<?= $k ?>"><?= $v ?></label>
                <?php endforeach; ?>
            </div>
            
            <div class="form-group">
                <span>** 菜色名稱 (15字內) (中文)</span>
                <input type="text" class="form-control" id="dinner" name="dinner" placeholder="<?= $row['name'] ?>">
            </div>

            <div class="form-group">
                <span>** 特色簡介 (20字內) (中文)</span>
                <textarea class="form-control" id="intro" name="intro" placeholder="<?= $row['intro'] ?>" ></textarea>
            </div>

            <div class="form-group col-md-12">
                <label for="food">預設主食材</label>
                <select class="form_control col-md-4" id="main_ingred_default" name="main_ingred1">

                    <?php foreach ($main_ingred_class as $k=>$v): ?>
                    <option class="main_ingred_sel" id="main_ingred_sel-<?= $k ?>" 
                    value="<?= $k ?>"
                    <?= ($k==$row_cat['class_id'])?'selected':'' ?>
                    ><?= $v ?>
                </option>
                <?php endforeach; ?>
                </select>

            <!-- js change event 撈 `product_class` 資料 -->
                <select class="form_control col-md-4" id="main_ingred_default_Place"  name="main_ingred">

                <?php foreach ($food_name as $k => $v): ?>
                <option id="main_food"  value="<?= $k ?>"
                <?= ($k==$row['main_ingred'])?'selected':'' ?>
                >
                <?= $v ?>
                </option>
                <?php endforeach; ?>
                </select>
              </div>

            <div class="form-group col-md-12">
              <div class="form-group col-md-10">
                <label for="food">可替換主食材 (1) </label>
                <select class="form_control col-md-4" id="main_ingred_01" name="main_ingred2">

                <?php foreach ($main_ingred_class as $k=>$v): ?>
                <option class="main_ingred_sel" value="<?= $k ?>"
                <?= ($k==$row_cat_re1['class_id'])?'selected':'' ?>
                ><?= $v ?></option>
                <?php endforeach; ?>
                </select>

              <!-- js change event 撈 `product_class` 資料 -->
                <select class="form_control col-md-4" id="main_ingred_place01" name="main_ingred_place01">

                <?php foreach ($food_name as $k => $v): ?>
                <option id="main_food"  value="<?= $k ?>"
                <?= ($k==$row['main_ingred_replace1'])?'selected':'' ?>
                >
                <?= $v ?></option>
                <?php endforeach; ?>
                </select>
              </div>

              <div class="form-group col-md-10">
                <label for="food">可替換主食材 (2) </label>
                <select class="form_control col-md-4" id="main_ingred_02" name="main_ingred3">

                <?php foreach ($main_ingred_class as $k=>$v): ?>
                <option class="main_ingred_sel" value="<?= $k ?>"
                <?= ($k==$row_cat_re2['class_id'])?'selected':'' ?>
                ><?= $v ?></option>
                <?php endforeach; ?>
                </select>
              
              <!-- js change event 撈 `product_class` 資料 -->
                <select class="form_control col-md-4" id="main_ingred_place02" name="main_ingred_place02">

                <?php foreach ($food_name as $k => $v): ?>
                <option id="main_food"  value="<?= $k ?>"
                <?= ($k==$row['main_ingred_replace2'])?'selected':'' ?>
                >
                <?= $v ?></option>
                <?php endforeach; ?>
                </select>
              </div>

              <div class="form-group col-md-10">
                <label for="food">可替換主食材 (3) </label>
                <select class="form_control col-md-4" id="main_ingred_03" name="main_ingred4">
   
                <?php foreach ($main_ingred_class as $k=>$v): ?>
                <option class="main_ingred_sel" value="<?= $k ?>"
                <?= ($k==$row_cat_re3['class_id'])?'selected':'' ?>
                ><?= $v ?></option>
                <?php endforeach; ?>
                </select>

              <!-- 撈食材資料 -->
                <select class="form_control col-md-4" id="main_ingred_place03" name="main_ingred_place03">
                <?php foreach ($food_name as $k => $v): ?>
                <option id="main_food"  value="<?= $k ?>"
                <?= ($k==$row['main_ingred_replace3'])?'selected':'' ?>
                >
                <?= $v ?></option>
                <?php endforeach; ?>
                </select>
              </div>
            </div>

            <div class="form-group">
                <label for="picture">上傳菜色照片 (最少1張，最多3張)</label>
                <!-- <button id="choose_file" onclick="choose()">選擇檔案</button> -->
                <input type="file" style="cursor:grab" class="form-control" id="picture" name="picture[]" multiple>重新上傳
                <small id="pictureHelp"></small>
            </div>
            <div onclick="removePic()" style="color:gray; cursor:grab">移除照片</div>
            <div class="form-group col-md-6">

            <div id="list" class="list">  
            <?php foreach ($image as $k => $v):?>
                <div class="img_wr"><img class="thumb" src="my_images/<?= $v ?>" id="img-<?= $k ?>"></div>        
            <?php endforeach; ?>
           
            </div>
            </div>

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
      // console.log(img_wr);
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

        fetch('dinner_edit_API.php', {
            method: 'POST',
            body: fd
        })
            .then(response=>{
                return response.json();
            })
            .then(json=>{
                // console.log(json);
                //   if(confirm(json.status)){
                //     setTimeout(() => {
                //     location.href="dinner_list.php"
                //   }, 500);
                //   }else{
                //     alert('請重新選擇檔案');
                //   }

                  Notiflix.Confirm.Show(
                  // Notice Content
                  `${json.info}`,
                  `${json.status}`,
                  `${json.to}`,
                  `${json.orto}`,
                  // ok button callback
                  function () {
                    setTimeout(() => {
                        location.href="dinner_list.php"
                    }, 500);
                  },

                  // cancel button callback
                  function() {
                    // img.remove();
                  }
              );
            })

        return false;
        };

          
      function removePic(){
        console.log(list.childNodes);
        for(i=0; i<list.childNodes.length; i++){
            list.childNodes[i].outerHTML="";
            // removePic();    
        }
        
        } 
        // console.log(list.childNodes);

     

  </script>
<script src="my_js/image_preview.js"></script>

<?php include '../__html_foot.php' ?>















?>