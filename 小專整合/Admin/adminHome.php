<?php
require '../__admin_required.php';
require  '../__connect_db.php';
$page_name = 'adminhome';
$page_title = 'AdminHome';
?>
<?php include  '../__html_head.php' ?>
<?php include  '../__html_body.php' ?>

<style>

        .bigbox{
            position: relative;
            width: 1500px;   
            /* ADJUST WIDTH TO MATCH WIDTH OF YOUR TEXT */
            height: 1000px;  
            /* ADJUST HEIGHT TO MATCH HEIGHT OF YOUR TEXT */
            margin: 40vh auto 0 auto;
        }
        #text01{
            position: relative;
            width: 1500px; 
            /* ADJUST WIDTH TO MATCH WIDTH OF YOUR TEXT */
            height: 1000px; 
            /* ADJUST HEIGHT TO MATCH HEIGHT OF YOUR TEXT */
           
        }
        .title {
    stroke-dasharray: 1500;
            stroke-dashoffset: 1500;
    animation: draw 7s linear forwards;
    -webkit-animation: draw 7s linear forwards;
    -moz-animation: draw 7s linear forwards;
    -o-animation: draw 7s linear forwards;
    font-weight: bold;
    font-family: Amatic SC;
    -inkscape-font-specification: Amatic SC Bold"
    }
    .title1 {
    stroke-dasharray: 1500;
            stroke-dashoffset: 1500;
    animation: draw1 7s linear forwards;
    -webkit-animation: draw1 7s linear forwards;
    -moz-animation: draw1 7s linear forwards;
    -o-animation: draw1 7s linear forwards;
    font-weight: bold;
    font-family: Amatic SC;
    -inkscape-font-specification: Amatic SC Bold"
    }
    @keyframes draw {
    to {
        stroke-dashoffset: 0;
        fill-opacity:1;
        }
    }
    @keyframes draw1 {
    to {
        stroke-dashoffset: 0;
        fill-opacity:1;
        }
    }
    @-webkit-keyframes draw {
    to {
        stroke-dashoffset: 0;
        
        }
    }
 
    @-moz-keyframes draw {
    to {
        stroke-dashoffset: 0;
        }
    }
    @-o-keyframes draw {
    to {
        stroke-dashoffset: 0;
        
    }
}


    </style>


    <!-- <div class="bigbox"> -->
    <svg id="圖層_1" data-name="圖層 1" xmlns="http://www.w3.org/2000/svg" viewBox="-500 -180 2000 1000"><defs><style>.cls-1{fill:#e9ac43;}.cls-2{fill:#b5d044;}.cls-3{fill:#109674;}</style></defs>
<title>未命名-4</title>
<path class="title" fill-opacity="0" stroke="#000" stroke-width="1.5" d="M414,708.92c0-41.59,20.4-68,48.8-68s48.8,26.4,48.8,68-20.4,68.8-48.8,68.8S414,750.52,414,708.92Zm90.8,0c0-38-17-62-42-62s-42,24-42,62,17,62.8,42,62.8S504.79,746.92,504.79,708.92Z" transform="translate(-413.99 -126)"/>
<path class="title" fill-opacity="0" stroke="#000" stroke-width="1.5" d="M547.59,643.33H584c26,0,42.4,9.6,42.4,34,0,23.2-16.4,35.59-42.4,35.59H554v62.4h-6.4Zm34,64c24.4,0,38-9.6,38-30,0-20.8-13.6-28.4-38-28.4H554v58.39Zm8,3.21,38.8,64.79h-7.6l-38.4-64.4Z" transform="translate(-413.99 -126)"/>
<path class="title" fill-opacity="0" stroke="#000" stroke-width="1.5" d="M655,708.92c0-41.59,22.4-68,56.4-68,17.2,0,27.8,8.4,34.6,15.6l-4,4.4c-6.8-7.6-16.2-14-30.6-14-30.8,0-49.6,24-49.6,62s18,62.8,48,62.8c12.6,0,24.2-4,30.8-10.8v-43.6h-32v-5.6h38.6v51.2c-8,8.8-20.8,14.8-37.8,14.8C676.59,777.72,655,750.52,655,708.92Z" transform="translate(-413.99 -126)"/>
<path class="title" fill-opacity="0" stroke="#000" stroke-width="1.5" d="M820,643.33h5.6l47.2,132H866l-27.6-79.19c-5.6-16-10.4-29.6-15.2-46h-.8c-4.8,16.4-9.6,30-15.2,46l-28,79.19h-6.4Zm-26.8,79.19h58.6v5.61h-58.6Z" transform="translate(-413.99 -126)"/>
<path class="title" fill-opacity="0" stroke="#000" stroke-width="1.5" d="M902,643.33h6.6l54.79,97.19L978,766.12h.39c-.19-12.6-.8-24.6-.8-37v-85.8h6v132H977l-54.8-97.19-14.6-25.6h-.4c.2,12.6.8,23.8.8,36.2v86.59h-6Z" transform="translate(-413.99 -126)"/>
<path class="title" fill-opacity="0" stroke="#000" stroke-width="1.5" d="M1034,643.33h75.6v5.6h-69.2v55.6h58.2v5.6h-58.2v65.19H1034Z" transform="translate(-413.99 -126)"/>
<path class="title" fill-opacity="0" stroke="#000" stroke-width="1.5" d="M1134,708.92c0-41.59,20.4-68,48.8-68s48.8,26.4,48.8,68-20.4,68.8-48.8,68.8S1134,750.52,1134,708.92Zm90.8,0c0-38-17-62-42-62s-42,24-42,62,17,62.8,42,62.8S1224.78,746.92,1224.78,708.92Z" transform="translate(-413.99 -126)"/>
<path class="title" fill-opacity="0" stroke="#000" stroke-width="1.5" d="M1254,708.92c0-41.59,20.4-68,48.8-68s48.8,26.4,48.8,68-20.4,68.8-48.8,68.8S1254,750.52,1254,708.92Zm90.8,0c0-38-17-62-42-62s-42,24-42,62,17,62.8,42,62.8S1344.78,746.92,1344.78,708.92Z" transform="translate(-413.99 -126)"/>
<path class="title" fill-opacity="0" stroke="#000" stroke-width="1.5" d="M1382.78,643.33h29.6c40.8,0,59.2,26.4,59.2,65.59s-18.4,66.4-59.2,66.4h-29.6Zm28.8,126.39c37.6,0,53.2-26,53.2-60.8s-15.6-60-53.2-60h-22.4V769.72Z" transform="translate(-413.99 -126)"/>
<path class="title1 cls-1" fill-opacity="0" stroke="#000" stroke-width="0" d="M1098.13,407c5.19-11.93,8-24.48,9.72-37.32,3.42-25.41.61-50.19-7.55-74.43.89-2.64.45-5.9,3.53-7.52,5,9,7.93,18.82,11.06,28.55,1.7,1.86,1,4.37,1.81,6.49a1,1,0,0,0,.1.75c1.74,2.16,1.67,4.72,1.59,7.28.72,7.85,2.59,15.59,2.29,23.55a59.44,59.44,0,0,0,.08,14.54c0,15.82-3.08,31.14-7.58,46.23-.23.76-.36,1.55-.53,2.33-1.08,4.54-1.42,9.37-5,12.94-1.6,1.54-.46,4.21-2.33,5.63-1,4-2.35,7.8-5.45,10.71a.75.75,0,0,0-.21.6c-1.07,2.39-1.48,5.18-4.08,6.62-.93,1.24-2.23,2.27-2.4,4-.07,2.05-1.36,3.23-3,4.19l-.36.73a2,2,0,0,1-1.3,1.73q-4.68,6-9.37,12c-.83,3.38-3.76,5.18-6,7.41-4.69,4.81-9.33,9.73-14.76,13.78a7.68,7.68,0,0,1-2.83,1.51l-17.5,12.27c-3,3.69-7.53,4.94-11.43,7.14-5.1,2.88-10.35,5.5-16.18,6.62a.88.88,0,0,0-.75.19,3.06,3.06,0,0,1-3.3,1.33,1,1,0,0,0-.75.22,3.09,3.09,0,0,1-2.63,1.08,5.22,5.22,0,0,1-.78-.19c-2.3-.84-2.19-.64-3.72.2a10,10,0,0,1-5.94,1.14c-.75-.24-.46.57-.32,0,0,0,.14,0,.4,0a2.13,2.13,0,0,1,1.71.85,138.66,138.66,0,0,1-39.82,6.39,40,40,0,0,0-12.12.06c-14.33.31-28.23-2.44-42-5.89-1-.26-2.08-.45-3.12-.68-1.38-.64-3.29.32-4.31-1.42-4.26-.55-7.8-3.1-11.83-4.27-1-.33-2.13-.3-2.79-1.31a10.71,10.71,0,0,1-4.59-1.91c-2.2-.57-4.61-.7-5.93-3a.87.87,0,0,0-.65-.21c-4.44-1.79-9-3.38-12.32-7.09a240.14,240.14,0,0,1-30-23.61c-6.06-4-10.25-9.81-14.7-15.33-2.67-3.3-5.74-6.43-7.06-10.66L798,452.46c.23-.57.29-1-.57-1C788.2,437,782.26,421.21,778,404.68c-.57-2.22-1.13-4.44-1.7-6.65a2.83,2.83,0,0,1-.5-2.51,200.84,200.84,0,0,1-2.64-41.92c.52-11.48,2.64-22.72,4.94-34,.24-.61,0-1.36.56-1.89.59-1.24-.06-2.78,1-3.92.47-3.19.77-6.43,3-9,2.49-5.47,4-11.36,7.28-16.5,2,.41,5.2-1.52,5.08,2.75l-1.71,6.35c-.83,1.28.17,3.19-1.45,4.2a.93.93,0,0,0-.14.74c-.56.73.13,1.83-.73,2.47-1.19,1.41-.88,3.3-1.55,4.88,1,2.55.25,5.08-.37,7.48-2.63,10.09-2.5,20.45-3.35,30.71-.39,4.67,1.29,9.31.51,14a8,8,0,0,1-1,2.93c-1.09,1.81.82.15.81.71,1.76,2.62,1.34,5.72,1.82,8.59,5.09,30.43,17.61,57.3,38,80.49,26.92,30.58,60.73,48.25,100.92,53.85a99.12,99.12,0,0,0,15.71,1.16,87.36,87.36,0,0,1,13.34.24A33.87,33.87,0,0,1,959.7,511c.08,0,.25.16.34,0a.82.82,0,0,1-.69-.82c.72-1.27,2-1.26,3.19-1.36,22.85-1.88,44.07-9,64-20.1a9.55,9.55,0,0,1,3-1.28c.92-.33,2.4.77,2.74-1.08,2.54-3.12,6.31-4.58,9.35-7,1.36-1.14,3-2,4-3.48a135.52,135.52,0,0,0,18.81-16.76,46.93,46.93,0,0,0,4.71-5.46c1.36-1.42,3.16-2.43,3.95-4.38,4.32-5.37,7.81-11.35,12.24-16.64,2.59-.16,1.5-2.13,1.69-3.46C1091.1,422,1093.74,414,1098.13,407Zm3.94-123.31c-4.23-8.39-9.49-16.17-14.58-24-2.45-5.18-6.2-9.47-10.09-13.51s-7.44-8.89-12.65-11.7a1.57,1.57,0,0,0-.77.1.77.77,0,0,0-.53.55c.42,1.68,1.91,2.52,2.94,3.7,5,5.74,10.13,11.38,14,18,.66,2.4,2.31,4.15,3.82,6l.89,1.63c1.06,1.19,1.45,2.79,2.43,4,5.75,8.24,9.16,17.58,12.75,26.84,2.52-1.88,1.6-5.36,3.53-7.52C1103.25,286.34,1102.73,285,1102.07,283.65Zm-294-18.49c3.45-3.09,5.35-7.32,8.08-11,1.91-2.54,4.34-4.76,5.14-8a1.63,1.63,0,0,0-1.74-1.95c-3.29.89-4.16,4-5.89,6.34h0a28.15,28.15,0,0,0-8.87,11.47l-2.64,3.87c-3.15,2.6-4.55,6.33-6.37,9.79a7.73,7.73,0,0,0-1.84,3.9,7.3,7.3,0,0,0-2.77,5.06c-.42,1.22-.83,2.43-1.24,3.65.92,1.16,1.74,4.07,3,.08l2.11,2.67C799.16,282.32,802.52,273.18,808.09,265.16ZM996.64,530.07c2.14-1,5.14.15,6.63-2.57-1.94-1.65-4.12-1.66-6.49-1.17.38.87,1.48.17,1.63,1.17l-7.49,1.34a4.18,4.18,0,0,0,3.51,1.31ZM824.15,242.38c2.61-2.82,6-5,7.32-8.89-1.29-.83-1.86,0-2.36,1L827.52,236l-5.13,5.58A1.69,1.69,0,0,0,824.15,242.38Zm296.53,111.93a29.57,29.57,0,0,0,.08,14.54A95.37,95.37,0,0,0,1120.68,354.31ZM819.5,244.94c.94,0,1.37.49,1.38,1.4a4.61,4.61,0,0,0,.72-.15l2.55-3.81a2,2,0,0,0-1.76-.81C821.23,242.53,819.92,243.35,819.5,244.94ZM1062,233.45l.29-.16c.06-1.12-.81-1.67-1.44-2.37-.69-.9-1.25-1.95-2.49-2.24-.52-.37-1-.74-1.57-1.1l-.89,0A13.77,13.77,0,0,0,1062,233.45ZM954.61,536.54a19.9,19.9,0,0,0-12.12.06A72.13,72.13,0,0,0,954.61,536.54ZM833.89,232.71a10.85,10.85,0,0,0,3.27-3.2c-.78-1.6-1.56-.21-2.34,0-.83,1.59-2.93,2.12-3.38,4Zm8.41-8.14c-1.59-.35-2.31,1.21-3.56,1.61C840.9,227.79,841.24,225.38,842.3,224.57ZM1063.45,235a1.23,1.23,0,0,0,.53-.55c-.26-.85-.66-1.49-1.71-1.2,0,.16-.13.21-.29.16C1061.88,234.53,1062.66,234.8,1063.45,235ZM798,452.46c.69-.5,2.12-.72,1.33-1.9-.31-.47-1.42.24-1.9.94ZM1088,433c.92-1.08.06-2.22-.41-3.29-1.07.75-1.12,2.07-1.68,3.1A1.4,1.4,0,0,0,1088,433ZM960.92,510.8l-1.58-.21-3.05.16C957.81,512,959.37,511.41,960.92,510.8Zm71.32-22.4c.7-.46.64-1-.1-1.41l-1.41.81C1031.07,488.42,1031.55,488.84,1032.24,488.4ZM784.51,366c0,.49.37.53.65.13a2.6,2.6,0,0,0,.21-.73c-.06-.74-.11-1.48-.16-2.22C784.21,364,784.46,365,784.51,366Z" transform="translate(-413.99 -126)"/>
<path class="title1 cls-2" fill-opacity="0" stroke="#000" stroke-width="0" d="M944.18,317.83c-1.83,9.61-.29,19.17.08,29.35,4.3-3.06,6.92-7.15,11.08-9.34,1.51-.13,2.94-.41,3.31-2.23a31.87,31.87,0,0,1,17.88-6.46,11,11,0,0,0,6.47,0c6.53-.09,11.92,3.16,17.26,6.23,7.16,4.1,14.36,7.94,23.65,9.37C1001.12,360,978.77,372,951.46,359.1c-1.37-2.64,1.38-2.8,2.4-4h0c4-4.27,9.55-5.55,14.86-7.18a11.73,11.73,0,0,0,2.68-.69,19,19,0,0,1,2.77-.44c-.65.26-2.34,0-3.82.79-6.37,1.18-12.53,3.31-19,4.24h0c-.45.69-1.24.45-1.86.69a.51.51,0,0,0-.54.18,1.78,1.78,0,0,1-1.66.69c-1.63.32-3.13.68-3.08,2.91.31,12.21,0,24.45,3,36.43.6,2.33,1.61,3.62,4.12,4.11,6.44,1.27,12.61,3.66,19.15,4.54,11.69,1.37,22.76,5.4,34.14,8.09,3,.7,6.15,1,8.81,2.74,1.25,2.56,3.45,1.76,5.5,1.51a1.55,1.55,0,0,1,1.64,1.23,1.59,1.59,0,0,1-1,1.55c2.6-1.77,5.89,1.43,8.88-.43a5.44,5.44,0,0,1,1.8,0c7,1.62,13.91,3.61,20.88,5.35a9.63,9.63,0,0,1,1.2.32c2.71.79,5.49,1.33,8.2,2.1,4.79,1.36,5.31,3.27,1.92,7-.45.49-1,.92-1.46,1.38a77.64,77.64,0,0,1-5.33,5.85c-.81.78-1.61,1.58-2.37,2.42-.25.3-.52.58-.8.86-7.38,7.94-15.88,14.51-24.87,20.52a9.34,9.34,0,0,1-8.78,1.2c-7.53-2.52-15-5.14-22.63-7.48-18.53-5.85-36.95-12.07-55.48-17.92-25.67-8.41-51.34-16.81-77.08-25-1.54-.49-3.08-1-4.61-1.49-1.15-.41-2.31-.84-3.5-1.17-5.5-2-11.07-3.71-16.61-5.54a32.89,32.89,0,0,0-3.36-.95c-2.37-.79-4.73-1.59-7.13-2.29a8.87,8.87,0,0,1-1.13-.39c-7.53-2.4-14.93-5.15-22.5-7.39a5.4,5.4,0,0,1-3.38-2c-.49-1.06-1-2.11-1.46-3.17-1.21-2.69.23-2.81,2.27-2.35,3,.84,6.1-.24,9.08.61q29.25,1.41,58.5,2.81c5.24.25,10.49.4,15.73.6,7,.76,14.12-.46,21.17.29,1.7.17,3.52-.18,4.93,1.18,3.23.25,6.46.43,9.68.77,2,.21,2.78-.59,3.35-2.5,4-13.49,7.24-27.13,7.72-41.25a68.84,68.84,0,0,0-10.62-40.05c-2.35-3.72-6-5.72-9.72-7.69-8.27-4.42-17.38-6.62-26.16-9.68-20.91-7.31-31.34-23.1-35.86-43.79.49-1-.35-2.37.8-3.23,7.82-2.05,15.7-3.22,23.78-1.76-2.69,1.08-5.47.25-8.78.64,4.28-.31,8,.27,11.7-.38,14.25,1.93,24.75,9.82,33,21.08a93,93,0,0,1,13.25,26.55c-2.08,1.28-3.23-.58-4.46-1.52A198.68,198.68,0,0,0,896,273.14a1.2,1.2,0,0,1-.5-.38c-.11.21,0,.34.33.4,9.7,6.61,18,14.77,26.08,23.15a13,13,0,0,1,2.8,4.34c.5.59,1,1.18,1.51,1.78,3.16,1.14,3.71,4.74,6.36,6.79-.11-3.3-.1-6.35,1-9.26,1.27-17.23,2-34.48,2.68-51.75.42-11.07.12-22.12-.17-33.18a42,42,0,0,0-4.51-18.69,3.64,3.64,0,0,1,3.7-1.93c.89.42,2,2.05,2.07-.67.06-4.93-.39-9.87.34-14.79a25.12,25.12,0,0,0-.1-10.29C936.5,163.54,939,159.33,941,155c6.1-12.56,17.21-19.3,29.11-25.13,1.8-2.61,4.9-2.62,7.47-3.62,1.72-.66,2.82.39,3.22,2.11,2.4,10.45,2.61,20.72-1.31,31-5.25,13.74-15.6,22.63-27.43,30.3-3,1.08-3.16-1.08-3.2-3a42.44,42.44,0,0,1,3.45-16.41,42,42,0,0,0-5.56,16.07,68,68,0,0,0-1.49,14.45c.09,17.94,0,35.88,0,53.82,0,1.43-.4,2.94.48,4.3A12,12,0,0,0,951,245.4c-3.57-13.07-3.28-25.93,2.35-38.37,5-11.05,13-19.72,22.62-27,3.41-2.59,6.62-5.54,11-6.49,4.11-2.75,5.52-2.25,6.48,2.48,1.15,5.61,2.5,11.21,2.43,17-.52,3.23-1.56,6.46,0,9.69-.54,18.49-9.28,32.23-24.51,42.16-2.22,1.44-4.29,3.35-7.18,3.47a3.28,3.28,0,0,1,.3-3.43c4.41-6.85,6.41-14.65,8.92-22.25a14.85,14.85,0,0,0,.93-2.95c0-.12.18-.23,0-.36a16.72,16.72,0,0,0-.46,1.92c-1.9,3.86-2.59,8.3-5.59,11.61-2.21,1.3-4.25,2.67-2.79,5.75-.84,3-1.77,5.89-4.35,7.89-4.66,7.34-8.45,15.26-14.54,21.64a3.43,3.43,0,0,0-.9,2.56q-.06,7.23-.14,14.47c-.32,5.48-1.1,11,.51,16.38.88.87.79,1.86-.25,2.31-2,.88-2.06-1.46-3.14-2.28.87,1.34,1.35,2.93,3.45,2.72,1.22-.13,1.87.88,2.23,2,.22,1.91-2.22,2.56-2.1,4.43a31,31,0,0,0-.83,3.29C945.06,315.28,945.28,316.79,944.18,317.83Zm7.6-22.61c0,5.43,0,5.43,4.92,4.34,2.29-.91,4-2.6,5.89-4.12,6.73-5.52,13.42-11.09,20.72-15.86,1.43-1.17,3.37-1.78,4.12-3.71-.22-2.38.38-3.82,3.21-2.93a7.25,7.25,0,0,0,2,0c.24.12,1-.16.51.52-.31.43.12-.09-.31.23-2.85,2.12-5.8,4.07-8.63,6.21-4.7,3.88-10.16,6.93-13.66,12.16-.4,1.89-1.77,2.54-3.5,2.73-3.39,1.79-5,5.3-7.52,7.93a1.37,1.37,0,0,0,.15,2.09l-.08-.1c3.59,1.08,7.18,2.32,10.64-.36-2.37-1.48-5-.37-7.16-.66a32.8,32.8,0,0,1,11.88,1.19c4.63-.59,9.48.13,13.75-2.44a9.94,9.94,0,0,1,1.49-.61c25.18-6.06,40.53-22.26,48.2-46.5.82-2.6.67-3.82-2.29-4.51-22.81-5.41-44-3.48-61.8,13.61A2.77,2.77,0,0,0,971.8,267l-1.13,1.33c-1.24.93-2.75,1.63-2.95,3.46l-1,1.36c-1.64.43-1.68,2.06-2.37,3.19-4,6-7.45,12.36-11.93,18.05A1,1,0,0,0,951.78,295.22ZM934.14,191a65.38,65.38,0,0,0-7.26-9.7c-1.57-1.44-2.64-3.31-3.81-4.43,1.2,1.29,3.25,2.39,4.69,4.15,1.23,1.23,2.41,2.53,3.76,3.64.8.66,1.66,1.66,2.8,1s.89-1.86.74-2.93a64.81,64.81,0,0,0-4.8-16.18c-1-2.22-1.82-4.52-4.07-5.84-8.08-12.4-19.6-20.43-33.07-25.94-1.26-.51-3.2-2.12-3.27,1.15-.23,11.95.56,23.77,5.51,34.86,4.79,10.74,13,17.52,24.75,19.13,4.91.66,8.67,2.58,11.52,6.51,1.48.07,2.36-1.08,3.49-1.72C935.87,193.11,934.84,192,934.14,191ZM953,299.64c-.21-1.54-.41-3-.62-4.53a3.57,3.57,0,0,0-3.05,3.33l-2.23,2.31c-.32.4-.73.75-.66,1.34-.47,1.64-1.1,2.26-2.19.37-1-1.74-1-1.73-2.63-1.46.42,3.79,4.49,3.29,6.49,5.42a58.75,58.75,0,0,0,8.18-7.26C954.89,297.34,954.12,300.23,953,299.64ZM995.92,193c-1.06,3.23-3.28,6.47,0,9.69A47.55,47.55,0,0,0,995.92,193ZM874.69,242.3h-9.13l0,1c4-.54,8,.75,12-.76Zm80.65,95.54c2.63.9,3.62.24,3.31-2.23A7.5,7.5,0,0,0,955.34,337.84ZM802.31,386c3,1.44,6.05.45,9.08.61C808.42,385.56,805.36,386,802.31,386Zm174.22-56.84a6.15,6.15,0,0,0,6.47,0A17.81,17.81,0,0,0,976.53,329.15ZM850.11,247.29c1.18-.85.68-2.12.8-3.23C847.83,244.44,850,246.12,850.11,247.29Zm170.24,167.53-2.61,2.33c3.51-2,7.2,2.08,10.65-.34a1.82,1.82,0,0,0-2.44-.43c-1.53.59-2.05-1.16-3.23-1.4A1.89,1.89,0,0,0,1020.35,414.82Zm-57.53-180c1.42,1,1.28,2.6,2.26,3.52q1.32-2.74,2.62-5.49C965.43,232,965.57,236.2,962.82,234.83Zm-24.37-66.14a46.75,46.75,0,0,0,0,10.51A14.92,14.92,0,0,0,938.45,168.69Zm77.79,244.65-2.15-.1c.75,3.55,2.83,1.56,4.55,1.1l-1.69-.87A.78.78,0,0,1,1016.24,413.34Zm-41.1-196.4c-.84-.39-.93.6-1,1.25l.93.74C975.66,218.27,976.06,217.37,975.14,216.94Zm12.49,54.46c-2.66.18-.73,2.67-.78,4.2,2-1,4.2-1.62,5.88-3.19A10.94,10.94,0,0,0,987.63,271.4ZM962,304.14h8.32l4.61-.17C970.62,302.34,966.27,303.65,962,304.14Zm8.68-11.58-3,2.72C970,295.45,970.79,294.69,970.63,292.56Z" transform="translate(-413.99 -126)"/>
<path class="title1 cls-3" fill-opacity="0" stroke="#000" stroke-width="0" d="M1004.94,389.25l22.35-3.77c.91-.15,1.83-.21,2.75-.31a2.16,2.16,0,0,0,1.5.3c.29,0,.51.13.78.11-.2-.33-.69-.24-.86-.6,13.13-2.15,26.07-5.32,39.33-7,6.26-.77,12.56-2.56,18.86-3.82,1.18-.23,2.39-.29,3.59-.43a2.46,2.46,0,0,1,2.27,2.35c-1.14,5.92-3.91,11.3-5.63,17,0,3.17-1.82,5.66-3,8.39-.69,1.27-1.3,2.58-2,3.85a24,24,0,0,0-2.39,4l-1,1.9a40.85,40.85,0,0,1-2.39,3.83,4,4,0,0,1-2,1.48c-4.46.95-8.31-1.64-12.49-2.34-5.12-.86-10.29-1.82-15.38-3-21.44-5.1-43-9.48-64.55-14.27-1.81-.41-3.75-.66-5-2.42.6-1.84,2.5-.37,3.4-1.35a.57.57,0,0,0,.7-.09,1.72,1.72,0,0,1,1.59-.31c.59.26,1.18.52,1.74.83a.76.76,0,0,0-.36-.62.5.5,0,0,1,.5-.57,34.53,34.53,0,0,0,9.5-1.72C999.39,389.62,1002.05,388.78,1004.94,389.25Zm91.2-15.72c-.81-1-1.94-.13-2.9.23l2.27,2.35C1095.86,375.27,1096.72,374.26,1096.14,373.53ZM1030,385.17c1,1,2.1.83,4,.17l-2.57-.36Zm-80,63.76-5.15-2.21q-26.13-7.89-51.87-17a2.92,2.92,0,0,0-2.44-.81,127.44,127.44,0,0,1-17.23-5.62,2.89,2.89,0,0,0-3-1l-8.14-2.25c-1.54.7-2.83-.6-4.28-.56-.09,0-.33.07-.33-.18.44.19.71,0,.92-.38l-46-15.39c6.54,12.09,13.37,22.39,21.83,31.5,37.37,40.21,83.41,56.68,137.75,49.46a127.44,127.44,0,0,0,44.08-14.1c-1.75-2.66-4.77-1.9-7.22-2.68l-.8-.13L953.8,450.07C952.38,450.27,951,450.4,950.05,448.93Zm-91.51-30c-.25.34-1.86.11-.75.83s2.87,1.75,4.44.29Zm131-25.51-2.62-.35-1.42.18C986.47,394.27,987.56,394.11,989.51,393.43Zm-39.46,55.5c.66,2.34,2.09,2.11,3.75,1.14Z" transform="translate(-413.99 -126)"/>
</svg>

        

   
<?php include  '../__html_foot.php' ?>