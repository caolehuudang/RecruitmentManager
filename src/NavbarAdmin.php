<?php
 if(!isset($_SESSION)) 
 { 
     session_start(); 
 } 
?>
<div>
        <nav class="uk-navbar uk-navbar-container uk-margin"  uk-sticky="sel-target: uk-navbar-container; cls-active: uk-navbar-sticky; bottom: #transparent-sticky-navbar">
            <div class="uk-navbar-left">
                <header class="logoHeader">
                    TOP JOBS
                </header>
            </div>
                 <div class="uk-navbar-right">
                    <a class="uk-navbar-toggle" href="#">
                        <span class=" uk-margin-small-right" uk-toggle="target: #offcanvas-reveal"
                            uk-icon="icon: menu; ratio: 2"></span>
                    </a>
                </div>
        </nav>

    <div id="offcanvas-reveal" uk-offcanvas="mode: reveal; overlay: true">
            <div class="uk-offcanvas-bar">
                <button class="uk-offcanvas-close" type="button" uk-close></button>
                <ul class="uk-nav uk-nav-default uk-nav-center  uk-padding">
                             <li class="uk-nav-header ">
                                <p><?php echo $_SESSION['fullname'] ?></p>
                                <span onclick = "massage()" uk-icon="icon: happy"></span>
                            </li>
                           
                            <li class="uk-nav-header ">
                                <a href='./Home.php'>Home</a>
                            </li>
                            <li class="uk-nav-divider"/>
                            <li class="uk-nav-header">
                                <a href='./Statistical.php'>Thống Kê</a>
                            </li>
                            <li class="uk-nav-divider"/>
                            <li class="uk-nav-header">
                                <a href='./ViewConfirm.php'>Duyệt Bài</a>
                            </li>
                            <li class="uk-nav-divider"/>
                            <li class="uk-nav-header">
                                <a href='./ManagerEmployee.php'>Quản Lý nhân viên</a>
                            </li>
                            <li class="uk-nav-divider"/>
                            <li class="uk-nav-header">
                                <a href='./Blog.php'>Blog</a>
                            </li>
                            <li class="uk-nav-divider"/>
                            <li class="uk-nav-header">
                                <a href='./Logout.php'>Logout</a>
                            </li>
                            <li class="uk-nav-divider"/>
                            <li class="uk-nav-divider"/>
                            <li class="uk-nav-header">
                                <p id="data"></p>
                            </li>
                </ul>
            </div>
    </div>
    <script>
        function massage(){
            let number= Math.floor((Math.random() * 10) + 1);
            switch(number){
                case 1: 
                    alert('Chúc bạn 1 ngày vui vẻ');
                    break;
                case 2: 
                    alert('Hôm nay bạn khỏe chứ');
                    break;
                case 3: 
                    alert('Cố lên');
                    break;
                case 4: 
                    alert('Tối đi chơi cho khỏe');
                    break;
                case 5: 
                    alert('Nghỉ vài ngày đi');
                    break;
                case 6: 
                    alert('Chắc được 7 điểm');
                    break;
                case 7: 
                    alert('Viết Blog đi');
                    break;
                case 8: 
                    alert('Hôm nay có lương');
                    break;
                case 9: 
                    alert('Đóng tiền nhà :(');
                    break;
                case 10: 
                    alert('Dev is number one');
                    break;
            }
           
        }
        $(document).ready(function() {
  var long;
  var lat;
  if (navigator.geolocation) {
	  navigator.geolocation.getCurrentPosition(function(position) {
      long = position.coords.longitude;
      lat = position.coords.latitude;
	  var timstp = position.timestamp;
	  var myDate = new Date(timstp).toLocaleString();
      var api = 'https://api.openweathermap.org/data/2.5/weather?lat=' + lat + '&lon=' + long + '&units=metric&appid=7cc72055cf03c02e9bf988f2a7b7b7e2';
      $.getJSON(api, function(data) {
		  $.each(data.weather, function(index,val){
			  if(data.name == 'Thanh pho Ho Chi Minh'){
				  data.name = 'TP.Hồ Chí Minh';
			  }
			  else if(data.name == 'Ha Noi'){
				  data.name = 'Hà Nội';
			  }else{
				  data.name = data.name;
			  }
			//   console.log(data.name);
			//   console.log(val.icon);
			//   console.log(data.main.temp);
			//   console.log(val.main);
			  $( "#data" ).html(data.name + "<br/>" 
			+ data.main.temp + '&deg;C' 
			+"<img src ='../images/weather/" + val.icon +".png'/>" + "<br/>"
			+ val.main
			);
		  });		
      });
    });
  }
});

    </script>