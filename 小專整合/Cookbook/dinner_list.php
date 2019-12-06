<?php

require '../__connect_db.php';
$page_name = 'dinner_list';
$page_title = 'dinner_list';

$sql = "SELECT `dinner_id`, `restaurant_id`, `main_cat`, `small_cat`, `name`, `intro`, `main_ingred`, `main_ingred_replace1`, `main_ingred_replace2`, `main_ingred_replace3`, `dinner_image` FROM `dinner_list` WHERE 1";

$stmt = $pdo->query($sql);
$row = $stmt->fetchAll();
$r = $stmt->fetch();



?>
<?php include '../__html_head.php' ?>
<?php include '../__html_body.php'   ?>

<style>
  .my_list{
    width: 80vw;
    margin: auto;
  }

  .img_wrap {
    width: 150px;
    height: 150px;
    overflow: hidden;
    border-radius: 10%;
    margin: 0 5px;
  }

  .img_wrap img{
    width: 100%;
    height: 100%;
    object-fit: cover;
  }

  .dinner_img {
    width: 22vw;
    /* border: 1px solid #aaa; */
    display: flex;
    justify-content: center;
  }

  .table_row{
    display: flex;
  }

  .table_row td{
    /* border: 1px solid #aaa; */
    display: flex;
    align-items: center;
  }


</style>


<div class="my_list">
  <div class="row">
      <nav aria-label="Page navigation example">
        <ul class="pagination pagination-sm flex"></ul>
        <!-- <div class="test"></div> -->
      </nav>
  </div>
</div>

<div class="card my_list">
<div class="my_list">
<table class="table text-center">
  <thead>
    <tr class="t_head d-flex justify-content-around">
      <th scope="col"><a href="javascript:changeSort()" id="change"><i class="fas fa-sort-up"></i></a></th>
      <th scope="col">刪除</th>
      <th scope="col">餐廳名稱</th>
      <th scope="col">中西式</th>
      <th scope="col">主食或主菜</th>
      <th scope="col">菜色名稱</th>
      <th scope="col">簡介</th>
      <th scope="col">預設食材</th>
      <th scope="col">可替換食材 1</th>
      <th scope="col">可替換食材 2</th>
      <th scope="col">可替換食材 3</th>
      <th scope="col" class="dinner_img">菜色照片</th>
      <th scope="col">編輯</th>
    </tr>
  </thead>
  <tbody id="t_content">

  </tbody>
</table>

</div>
</div>

<script>
  let page = 0;
  let delete1 = `<a href="javascript:delete_conf(<%= dinner_id %>)"><i class="fas fa-trash-alt fa-2x"></i></a>`;

  let edit = '<a href="dinner_edit.php?sid=<%= dinner_id %>"><i class="fas fa-edit fa-2x"></i></a>';

  let change = false;
  let number = 0;
  let sid = 0;

  let change_i = document.querySelector('#change');

  const pagination = document.querySelector('.pagination');
      const t_content = document.querySelector('#t_content');
      const pagination_str = `
              <li class="page-item <%= active %>">
                  <a class="page-link" href="javascript:loadData(<%= i %>)"><%= i %></a>
              </li>
          `;
      const table_row_str = `
        <tr class="table_row justify-content-around">
            <td><%= dinner_id %></td>
            <td> ${delete1} </td>
            <td><%= restaurant_id %></td>
            <td><%= main_cat %></td>
            <td><%= small_cat %></td>
            <td><%= name %></td>
            <td><%= intro %></td>
            <td><%= main_ingred %></td>
            <td><%= main_ingred_replace1 %></td>
            <td><%= main_ingred_replace2 %></td>
            <td><%= main_ingred_replace3 %></td>
            <td class="dinner_img"><%
            _.forEach(dinner_image, function(dinner_image) { %><div class="img_wrap"><img src="my_images/<%- dinner_image %>"></img></div><% });
            %></td>
            <td> ${edit} </td>
        </tr>`;

  // let page = 0;

  Notiflix.Confirm.Init({
      width: "350px",
      okButtonBackground: "#ce4e4e",
      titleColor: "#e81616",
      titleFontSize: "20px",
      fontFamily: "Arial",
      useGoogleFont: false,
  });

  // function edit_conf(sid){
  //   fetch('dinner_edit.php?sid='+sid)
  // };

  function delete_conf(sid){

        console.log(sid);
        //觸發函式
        Notiflix.Confirm.Show(
            // Notice Content
            '! WARNING !',
            'Are You Sure ?',
            'Delete',
            'Go Back',
            // ok button callback

            function () {
              loadData(page, sid, change);
            },

            // cancel button callback
            function() {
              console.log(sid);
            }
        );
    
  }

    function changeSort(page){
      change = !change;
      number = change? 1 : 0;
      console.log(number);
       loadData(page, sid, change);
       let i = number? '<i class="fas fa-sort-down"></i>':'<i class="fas fa-sort-up"></i>';
       change_i.innerHTML = i;
    };

    const pagination_fn = _.template(pagination_str);
    const table_row_fn = _.template(table_row_str);
    // const table_food_fn = _.template(table_food_str);

    // Fetch Event 測試
 
      // self.addEventListener('fetch', function(event) {
      //   console.log('Handling fetch event for', event);
        // event.respondWith(
        //   caches.match(event.request).then(function(response) {
        //     if (response) {
        //       console.log('Found response in cache:', response);

        //       return response;
        //     }
        //     console.log('No response found in cache. About to fetch from network...');

        //     return fetch(event.request).then(function(response) {
        //       console.log('Response from network is:', response);

        //       return response;
        //     }).catch(function(error) {
        //       console.error('Fetching failed:', error);

        //       throw error;
        //     });
        //   })
        // );
      // });
    
    

    function loadData(page=1, sid){
        if (sid>0) {
          fetch('dinner_delete.php?sid='+sid)
          .then(response=>{
            return response.json();
          })
          .then(jsonObj=>{
            console.log(jsonObj['success']);
            alert(jsonObj['success']);
            // setTimeout(() => {
            //   location.href="dinner_list.php";
            // }, 500);
          })
        }
        // console.log(number);
        fetch(`dinner_list_API.php?page=${page}&number=${number}`)
          .then(response => {
              return response.json();
          })
          .then(jsonObj => {
            console.log(jsonObj);
              let i, s, item;
              let t_str = '';
            //   let t_str_f = '';
                  for(s in jsonObj.rows){
                      item = jsonObj.rows[s];
                        // console.log(item.dinner_image);
                        new_img = JSON.parse(item['dinner_image']);
                        item.dinner_image = new_img;
                        // console.log(item.main_ingred);

                      t_str += table_row_fn(item);
                  }

                //   for(s in jsonObj.food_ingred){
                //     food = jsonObj.food_ingred[s];
                //     console.log(food);
                //     t_str_f += table_food_fn(food);
                //     console.log(t_str_f);
                // }

                  t_content.innerHTML = t_str;

              let p_str = '';
                  for(i=1; i<=jsonObj.totalPages; i++){
                    let active = i===jsonObj.page ? '' : '';
                    p_str += pagination_fn({i:i, active:active});
                  }
                  pagination.innerHTML = p_str;
          });
    }

    loadData();


</script>

<?php include '../__html_foot.php' ?>