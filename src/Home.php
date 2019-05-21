<!DOCTYPE html>
<html lang="en">
<head>
  <title>Tuyển Dụng</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.3/css/uikit.min.css" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.3/js/uikit.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.3/js/uikit-icons.min.js"></script>
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"
        integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
  <link rel="stylesheet" href="../css/style.css" />
  <link rel= " shortcut icon" href="../images/logo1.jpg" type="image/ico">
</head>
<body>
<?php require_once ('./NavBar.php'); ?>
<div class = "cover">
    <div class = "text">
      <span id = "spin"></span>
    </div>
</div>
<br/>

<div class = "uk-container uk-card uk-card-default">
        <form class="uk-grid-small " uk-grid >
            <div class="uk-width-1-1">
                <h1>Luôn Luôn Thấu Hiểu</h1><br/>
            </div>
            <div class="uk-width-1-2@s">
            <input id = "search" class="uk-input" type="text" placeholder="Tìm kiếm theo kỹ năng, công ty" name = "search">
            </div>
            <div class="uk-width-1-5@s">
            <div class="uk-margin">
                <select class="uk-select" name = "location" id= "location">
                        <option value = "null">Vị trí</option>
                        <option value = "HCM">Hồ Chí Minh</option>
                        <option value = "HN">Hà Nội</option>
                    </select>
            </div>
            </div>
            <div class="uk-width-1-4@s">
                <input id= "submit" name = "submit" class="uk-input uk-form-success" type="submit" placeholder="25">
            </div>
        </form>
    <br/><br/><br/>
    </div>
</div>
<br/>
<div class = "uk-container">
    <div id = "result" class="uk-child-width-1-3@m uk-grid-small uk-grid-match" uk-grid>
        
    </div>
</div>
<?php require_once ('./Footer.php'); ?>

<script type="text/javascript">

        $(document).ready(function() {
            $(".menu-icon").on("click", function() {
                $("nav ul").toggleClass("showing");
            });

           $("#submit").click(function(e){
            var search = $("#search").val();
            var location = $("#location").val();
            e.preventDefault();
           
            $.ajax({ type: "POST",   
                url: "Search.php",   
                async: false,
                data: {search : search,location : location},
                success : function(text)
                {
                   if(text == ''){
                    var html = 'không tìm thấy kết quả phù hợp';
                    document.getElementById("result").innerHTML = html;
                   }
                    $('#result').html(text);
                }
            });
           })

        });
        // Scrolling Effect
        $(window).on("scroll", function() {
            if($(window).scrollTop()) {
                $('nav').addClass('black');
            }

            else {
                $('nav').removeClass('black');
            }
        })
    </script>
</body>
</html>
