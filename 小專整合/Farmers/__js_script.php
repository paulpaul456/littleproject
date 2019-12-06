<script>
const bell_active = $('#navbarDropdownMenuLink');
const bell_notice = $('#bell_notice');
const search_value = $('#search_value');
const search_advance = $('#search_advance');
const search_search = $('#search_search');
var pagination_active = 0;
const id_desc = document.querySelector('#id_desc');
const pagination = document.querySelector('.pagination');
const t_content = document.querySelector('#t_content');
const sort_ud = [
    'ID<i id="icon_desc" class="fas fa-caret-down"></i>',
    'ID<i id="icon_desc" class="fas fa-caret-up"></i>'
];
const pagination_str = `
            <li class="page-item <%= active %>">
                <a class="page-link" href="javascript:loadData(<%= i %>)"><%= i %></a>
            </li>
        `;
const pagination_str1 = `
            <li class="page-item <%= active %>">
                <a class="page-link" href="javascript:searchData(<%= i %>,0,<%= v %>)"><%= i %></a>
            </li>
        `;


const table_row_str = `
        <tr>
                <td><%= farmer_id %></td>
                <td><%= storename %></td>
                <td><%= name %></td>
                <td><%= email %></td>
                <td><%= password %></td>
                <td><%= mobile %></td>
                <td class="text-center"><a  href="farmer_edit.php?sid=<%= farmer_id %>"><i class="fas fa-pen"></i></a></td>
                <td class="text-center"><a  href="javascript:delete_one(<%= farmer_id %>)"><i class="fas fa-minus"></i></a></td>
            </tr>
        `;

const pagination_fn = _.template(pagination_str);
const pagination_fn1 = _.template(pagination_str1);
const table_row_fn = _.template(table_row_str);
let sort = 'farmer_api.php?page=';

bell_active.click(function() {
    bell_notice.removeClass("bell_notice_active");
});
Notiflix.Confirm.Init({
    width: "350px",
    okButtonBackground: "#ce4e4e",
    titleColor: "#e81616",
    titleFontSize: "20px",
    fontFamily: "Arial",
    useGoogleFont: false,
});

function delete_one(id) {

    let info = "Delete";

    let page = pagination_active;
    Notiflix.Confirm.Show(
        '! WARNING !',
        'Are You Sure ?',
        'Delete',
        'Go Back',
        // ok button callback
        function() {
            let action_date = new Date();
            let action_time = `${action_date.getHours()}:${action_date.getMinutes()}`;
            addnotice(info, id, action_time);
            bell_notice.addClass("bell_notice_active");
            loadData(page, id);
        },
        // cancel button callback
        function() {
            console.log(id);
        }
    );
}
var t1, t2, t3, t4, t5, t6 ,t7;
var search_status = true;

function search() {
    window.clearTimeout(t2);
    window.clearTimeout(t3);
    window.clearTimeout(t4);
    console.log('cleartime');
    let page = 1;
    let id = 0;
    let value = search_value.val();
    console.log(search_status+' search');
    searchData(page,value);
    t5=setTimeout(() => {
        search_search.removeAttr("href");
    }, 100);
    t6=setTimeout(() => {
        search_value.addClass("search_move");   
    }, 8500);
    t7=setTimeout(() => {
        search_status = true;
        search_search.removeAttr("hidden");
    }, 9000);
}

    search_search.click( ()=>{
        if(search_status){
            console.log(search_status+' begin');
            search_action();
            
        }
    })
        


function search_action() {
    console.log(search_status+' action');
    search_status = false;
    console.log(search_status+' change');
    search_value.removeClass("search_move");
    t1=setTimeout(() => {
        search_search.attr("href",'javascript:search()');
        console.log(' press now');
    }, 100);
    
    t2=setTimeout(() => {
        search_search.attr("hidden", '');
    }, 15000);
    t3=setTimeout(() => {
        search_value.addClass("search_move");   
    }, 16500);
    t4=setTimeout(() => {
        search_status = true;
        search_search.removeAttr("href");
        search_search.removeAttr("hidden");
    }, 17000);
}

 

function searchData(page = 1, value) {
    console.log(value);
    fetch(`farmer_search_api.php?page=${page}&value=${value}`)
        .then(response => {
            console.log(response);
            return response.json()
        })
        .then(json => {
            console.log(json.rows);
            let i, s, item;
            let t_str = '';
            for (s in json.rows) {
                item = json.rows[s];
                t_str += table_row_fn(item);
            }
            console.log(item);
            t_content.innerHTML = t_str;

            let p_str = '';
            for (i = 1; i <= json.totalPages; i++) {
                let active = i === json.page ? 'active' : '';
                let v = json.value;
                p_str += pagination_fn1({
                    i: i,
                    active: active,
                    v: v
                });
            }
            pagination.innerHTML = p_str;
            pagination_active = document.querySelector('ul.pagination li.active a').innerHTML;
        })

}

function loadData(page = 1, id) {
    if (id > 0) {
        console.log('delete' + id);
        fetch('farmer_delete_api.php?sid=' + id);
    }
    fetch(sort + page)
        .then(response => {
            return response.json();
        })
        .then(json => {
            console.log(json.rows);
            let i, s, item;
            let t_str = '';
            for (s in json.rows) {
                item = json.rows[s];
                t_str += table_row_fn(item);
            }
            console.log(item);
            t_content.innerHTML = t_str;

            let p_str = '';
            for (i = 1; i <= json.totalPages; i++) {
                let active = i === json.page ? 'active' : '';
                p_str += pagination_fn({
                    i: i,
                    active: active
                });
            }
            pagination.innerHTML = p_str;
            pagination_active = document.querySelector('ul.pagination li.active a').innerHTML;

        });

}
loadData();


const test = (el) => {
    if (sort == 'farmer_api_desc.php?page=') {
        id_desc.innerHTML = sort_ud[0];
        sort = 'farmer_api.php?page=';
        loadData();
    } else {
        if ((el.target.id == 'id_desc') | (el.target.id == 'icon_desc')) {
            id_desc.innerHTML = sort_ud[1];
            sort = 'farmer_api_desc.php?page='
            loadData();
        } else {
            console.log(el.target);
            sort = 'farmer_api.php?page=';
            alert('only ASC');
        }
    }

}
id_desc.addEventListener('click', test);
</script>