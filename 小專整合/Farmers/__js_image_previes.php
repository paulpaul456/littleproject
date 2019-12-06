<script>
// picture-> input file id
// small-> 顯示提醒
let background = document.querySelector('#background');
let backgroundsmall = document.querySelector('#backgroundHelp');
background.addEventListener('change', handleFileSelect);
background.addEventListener('change', handler);
let photo = document.querySelector('#photo');
let photosmall = document.querySelector('#photoHelp');
photo.addEventListener('change', handleFileSelect);
photo.addEventListener('change', handler);

// 載入預覽圖片
function handleFileSelect(evt) {
    if(evt.target.id=="background"){
    var files = evt.target.files; // FileList object

    // Loop through the FileList and render image files as thumbnails.
    for (var i = 0, f; f = files[i]; i++) {

        // Only process image files.
        if (!f.type.match('image.*')) {
            continue;
        }

        var reader = new FileReader();

        // Closure to capture the file information.
        reader.onload = (function(theFile) {
            return function(e) {
                // Render thumbnail.  
                var span = document.createElement('span');
                span.innerHTML = ['<img class="thumb" src="', e.target.result,
                    '" title="', escape(theFile.name), '"/>'
                ].join('');
                
                document.getElementById('list').appendChild(span);
            };
        })(f);

        // Read in the image file as a data URL.
        reader.readAsDataURL(f);

        background.addEventListener('click', zero);
        
    }
}else{
    var files = evt.target.files; // FileList object

    // Loop through the FileList and render image files as thumbnails.
    for (var i = 0, f; f = files[i]; i++) {

        // Only process image files.
        if (!f.type.match('image.*')) {
            continue;
        }

        var reader = new FileReader();

        // Closure to capture the file information.
        reader.onload = (function(theFile) {
            return function(e) {
                // Render thumbnail.  
                var span = document.createElement('span');
                span.innerHTML = ['<img class="thumb" src="', e.target.result,
                    '" title="', escape(theFile.name), '"/>'
                ].join('');
                
                document.getElementById('list1').appendChild(span);
            };
        })(f);

        // Read in the image file as a data URL.
        reader.readAsDataURL(f);

        photo.addEventListener('click', zero);
    }
}
}


// 上傳圖片超過限制數量，顯示提醒字串
function handler(e) {
    if(e.target.id=="background"){
    // console.log(e.target.files.length);
    let picture_num = e.target.files.length;
    if (picture_num > 1) {
        // console.log('test');
        // var span = document.createElement('span');
        backgroundsmall.innerHTML = "請勿上傳超過限制數量，請重新選擇檔案";
        backgroundsmall.style.color = 'red';
    }}else{
        // console.log(e.target.files.length);
    let picture_num = e.target.files.length;
    if (picture_num > 1) {
        // console.log('test');
        // var span = document.createElement('span');
        photosmall.innerHTML = "請勿上傳超過限制數量，請重新選擇檔案";
        photosmall.style.color = 'red'; 
    }
}}


// 歸零預覽圖片
function zero() {
    let span = document.querySelectorAll('span');
    span.forEach(el => {
        console.log(el.target);
        document.getElementById('list').removeChild(el);
        photosmall.innerHTML = "";
        backgroundsmall.innerHTML = "";
    });

}
</script>