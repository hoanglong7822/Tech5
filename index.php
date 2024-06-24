<?php
session_start();
require 'conn.php';
$userId = null;
$roleId = null;
if (isset($_SESSION["active"]))
{
	setcookie('guest', null, -1, '/'); 
}
// Ket noi CSDL
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>TECH5</title>
		<link rel ='icon' href = 'img/title.png'>

		<script type="text/javascript">
        var no = 20;
        if (matchMedia('only screen and (max-width: 767px)').matches) {
            no = 10        }
        let img_url = 'https://anonyviet.com/resource/hodaoroi/hoadao.png';
        var hidesnowtime = 0;
        var color_snow  = '#fff';
        var snowdistance = 'windowheight'; // windowheight or pageheight;
        var ie4up = (document.all) ? 1 : 0;
        var ns6up = (document.getElementById && !document.all) ? 1 : 0;
        function iecompattest() {
            return (document.compatMode && document.compatMode != 'BackCompat') ? document.documentElement : document.body
        }
        var dx, xp, yp;
        var am, stx, sty;
        var i, doc_width = 800, doc_height = 600;
        if (ns6up) {
            doc_width = self.innerWidth;
            doc_height = self.innerHeight
        } else if (ie4up) {
            doc_width = iecompattest().clientWidth;
            doc_height = iecompattest().clientHeight
        }
        dx = new Array();
        xp = new Array();
        yp = new Array();
        am = new Array();
        stx = new Array();
        sty = new Array();
        for (i = 0; i < no; ++i) {
            dx[i] = 0;
            xp[i] = Math.random() * (doc_width - 50);
            yp[i] = Math.random() * doc_height;
            am[i] = Math.random() * 20;
            stx[i] = 0.02 + Math.random() / 10;
            sty[i] = 0.7 + Math.random();
            if (ie4up || ns6up) {
                document.write('<div id="dot'+i+'" style="POSITION:fixed;Z-INDEX:'+(99+i)+';VISIBILITY:visible;TOP:15px;LEFT:15px;pointer-events: none;width:15px"><span style="font-size:18px;color:'+color_snow+'"><img src="'+img_url+'" alt=""></span></div>');
            }
        }
        function snowIE_NS6() {
            doc_width = ns6up ? window.innerWidth - 10 : iecompattest().clientWidth - 10;
            doc_height = (window.innerHeight && snowdistance == 'windowheight') ? window.innerHeight : (ie4up && snowdistance == 'windowheight') ? iecompattest().clientHeight : (ie4up && !window.opera && snowdistance == 'pageheight') ? iecompattest().scrollHeight : iecompattest().offsetHeight;
            for (i = 0; i < no; ++i) {
                yp[i] += sty[i];
                if (yp[i] > doc_height - 50) {
                    xp[i] = Math.random() * (doc_width - am[i] - 30);
                    yp[i] = 0;
                    stx[i] = 0.02 + Math.random() / 10;
                    sty[i] = 0.7 + Math.random()
                }
                dx[i] += stx[i];
                document.getElementById('dot' + i).style.top = yp[i] + 'px';
                document.getElementById('dot' + i).style.left = xp[i] + am[i] * Math.sin(dx[i]) + 'px'
            }
            snowtimer = setTimeout('snowIE_NS6()', 10)
        }
        function hidesnow() {
            if (window.snowtimer) {
                clearTimeout(snowtimer)
            }
            for (i = 0; i < no; i++) document.getElementById('dot' + i).style.visibility = 'hidden'
        }
        if (ie4up || ns6up) {
            snowIE_NS6();
            if (hidesnowtime > 0) setTimeout('hidesnow()', hidesnowtime * 1000)
        }
    </script>

		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		 <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

		<!-- Google font -->
		<link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700" rel="stylesheet">

		<!-- Bootstrap -->
		<link type="text/css" rel="stylesheet" href="css/bootstrap.css"/>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

		<!-- Slick -->
		<link type="text/css" rel="stylesheet" href="css/slick.css"/>
		<link type="text/css" rel="stylesheet" href="css/slick-theme.css"/>

		<!-- nouislider -->
		<link type="text/css" rel="stylesheet" href="css/nouislider.min.css"/>

		<!-- Font Awesome Icon -->
		<link rel="stylesheet" href="css/font-awesome.min.css">

		<!-- Custom stlylesheet -->
		<link type="text/css" rel="stylesheet" href="css/style.css"/>
		<link type="text/css" rel="stylesheet" href="css/main.css"/>
		<link type="text/css" rel="stylesheet" href="css/header.css"/>

		<script>
			function deleteFromCart (productId, type) {
				if (type == 'guest') {
					$.ajax({
						url:'actions/Cart/Guest/RemoveProducts.php',
						type: 'POST',
						data: {'val': productId},
						success: function(response){
							var result = $.parseJSON(response);
							// Change qty Cart label
							var qty = document.querySelector("#header > div > div > div.col-md-3.clearfix > div > div.dropdown > a > div");
							qty.innerText = parseInt(qty.innerText)-1;
							
							// Change number Items selected
							var cart_summary = document.querySelector(".cart-summary>small");
							itemSelected = cart_summary.innerHTML.split(' ')[0]
							itemSelected = parseInt(itemSelected) - result["quantity"];
							cart_summary.innerHTML = itemSelected + " Item(s) selected";

							$("div[id='"+result["prId"]+"']").remove();
						}
					})
				}
				else if (type == 'user') {
					$.ajax({
						url: 'actions/Cart/User/RemoveProducts.php',
						type: 'POST',
						data: {'val': productId},
						success: function (response){
							var result = $.parseJSON(response);

							// Change qty Cart label
							var qty = document.querySelector("#header > div > div > div.col-md-3.clearfix > div > div.dropdown > a > div");
							qty.innerText = parseInt(qty.innerText)-1;
							
							// Change number Items selected
							var cart_summary = document.querySelector(".cart-summary>small");
							itemSelected = cart_summary.innerHTML.split(' ')[0]
							itemSelected = parseInt(itemSelected) - result["quantity"];
							cart_summary.innerHTML = itemSelected + " Item(s) selected";

							$("div[id='"+result["prId"]+"']").remove();
						}
					})
				}
			}	
		
			function deleteFromCheckOut(button, type){
				var productId = button.id;
				deleteFromCart(productId, type);				
				button.closest('.order-products').remove();	
				setTimeout(() => {
					$.ajax({
						url: 'actions/Cart/GetTotal.php',
						type: 'GET',
						success: function (response) {
							var total = document.querySelector("strong.order-total");
							total.innerHTML = response;
						}
					})
				}, 50);
				
			}	

			function checkout (){
				var qty = document.querySelector("#header > div > div > div.col-md-3.clearfix > div > div.dropdown > a > div");
				if (qty.innerText == "0"){
					alert("Hãy chọn sản phẩm trước nhé");
				}
				else{
					window.location.href = "index.php?nav=checkout";
				}
			}

			function sortBy (option, nav){
				window.location.href = "index.php?nav="+nav+"&sort="+option.value;							
			}

			// Show hidden password
			isBool = true;
				function showHidden(){
					if(isBool){
						document.getElementById("psw").setAttribute("type", "text");
						isBool = false;
					} else{
						document.getElementById("psw").setAttribute("type", "password");
						isBool = true;
					}
				}

				function showHiddenrepsw(){
					if(isBool){
						document.getElementById("repsw").setAttribute("type", "text");
						isBool = false;
					} else{
						document.getElementById("repsw").setAttribute("type", "password");
						isBool = true;
					}
				}

				function showHiddenoldpsw(){
					if(isBool){
						document.getElementById("oldpsw").setAttribute("type", "text");
						isBool = false;
					} else{
						document.getElementById("oldpsw").setAttribute("type", "password");
						isBool = true;
					}
				}

				// Validate Form Change password
				function check_info(){
					var pw = document.getElementById('psw').value; 
					var re_pw = document.getElementById('repsw').value;
					if (re_pw != pw){
						alert('Mật khẩu nhập lại không khớp, mời nhập lại');
						repsw.focus();
						return false;
					}
					return true;
				}

				// Validate Form Regsister
				function check_psw(){
					var pw3 = document.getElementById('psw_register').value; 
					var rep_pws = document.getElementById('re_psw_register').value;
					if (rep_pws != pw3){
						alert('mật khẩu nhập lại không khớp, mời nhập lại');
						re_psw_register.focus();
						return false;
					}
					return true;
				}

				function checkpayment(){
					var rd1 = document.getElementById('payment-1').checked;
					var rd2 = document.getElementById('payment-2').checked;
					var rdAdress = document.getElementById('shiping-address').checked;
					var otherAdress = document.getElementById('otherAddress').value;
					var Adress = document.getElementById('address').value;
					var phone_nuber =  document.getElementById('tel').value;
					if (rdAdress == false && Adress == ""){
						return document.getElementById("address").required = true;
					}
					else if( rdAdress == true && otherAdress == "")
					{
						return document.getElementById("address").required = true;
					}if( phone_nuber == "")
					{
						return document.getElementById("tel").required = true;
					}
					else alert('Thanh toán thành công!');				
				}
			
		</script>
    </head>
	<body>
	<?php
		function countDigit($number){
			return strlen($number);
		}

		function displayPrice($input){
			$temp = substr_replace($input, '.', '-3', 0); 
			if (countDigit($input) > 6){
				$temp = substr_replace($temp, '.', '-7', 0);
			}
			return $temp. "₫";
		}

		function getCategoryName($id, $conn){
			$sql = "SELECT * FROM `product_type` WHERE `id` = $id";
			$result = $conn -> query($sql);
			$rows = $result -> fetch_assoc();
			if ($rows["name"] == "Phụ kiện khác"){
				return "Phụ kiện";
			}
			return $rows["name"];
		}

		function getIMG($id){
			return "./img/products/$id.jpg";
		}

		function getProductNameById($id, $conn){
			$sql = "SELECT * FROM `product` WHERE `id` = $id";
			$result = $conn -> query($sql);
			$rows = $result -> fetch_assoc();
			return $rows["name"];
		}

		function getProductPrice($id, $type, $conn){
			$sql = "SELECT * FROM `product` WHERE `id` = $id";
			$result = $conn -> query($sql);
			$rows = $result -> fetch_assoc();
			return $rows["$type"];
		}

		function getQuantityProduct($id, $conn){
			$sql = "SELECT * FROM `product` WHERE `id` = $id";
			$result = $conn -> query($sql);
			$rows = $result -> fetch_assoc();
			return $rows["quantity"];
		}
		

		function totalByUser($id, $conn){
			$total = 0;
			$result = $conn -> query("SELECT * FROM `cart` WHERE `user_id` = '$id'");
			for ($i = 0; $i < $result -> num_rows; $i++)
			{
				$cart = $result -> fetch_assoc();
				$total += ((int)$cart["quantity"] * (int)getProductPrice($cart["product_id"], "sale_price", $conn));
			}
			return $total;
		}

		function totalByGuest($conn){
			$total = 0;
			$products = explode('.',$_COOKIE['guest']);
			for ($i = 0; $i < count($products); $i++)
			{
				$temp = $conn -> query("SELECT `sale_price` FROM `product` WHERE `id` = '$products[$i]'");
				$price = $temp->fetch_array();
				$total += (int)$price[0];
			}
			return $total;
		}

		function getUniqueArray($array){
			$unique_array = [];
			for ($i = 0; $i < count($array); $i++)
			{
				if (!in_array($array[$i], $unique_array))
				{
					array_push($unique_array, $array[$i]);
				}
			}
			return $unique_array;
		}
		
		?>
		 <!-- Banner Topzone-->
		 <div class="header-top-bar">
        <div class="banner-media">
			<div class="item" data-background-color="#5C0756" data-order="1">
                    <a aria-label="slide" data-cate="0" data-place="1612" href="https://www.facebook.com/profile.php?id=100088740327226" onclick="jQuery.ajax({ url: '/bannertracking?bid=67439&r='+ (new Date).getTime(), async: true, cache: false });">
					<center><img width='1200' height='44'   src="img/BANNER.WEBP" alt="sale"  > </center>  </a>
                </div>
                
    </div>
    <style>
        .banner-media{
            background-color: #5C0756;
        }
    </style>

        </div>
</div>
		<?php

		// TOP HEADER
		if (isset($_SESSION["active"]))
		{
			$userId = $_SESSION["active"];
			$roleId = $_SESSION["role"]; 			
			include ("layout/header/User.php");			
		}
		else
		{			
			include ("layout/header/Guest.php");
		}
		

		// NAV AND SECTION
		if (isset($_GET["nav"]))
		
		{
			$nav = $_GET["nav"];
			if ($nav == "laptop"){
				include ("layout/Category/Laptop.php");
			}
			 else if ($nav == "pc"){
				include ("layout/Category/PC.php"); 
			}
			else if ($nav == "accessories"){
				include ("layout/Category/Accessories.php");	 
			}
			else if ($nav == "smartphone"){
				include ("layout/Category/Smartphone.php");	 
			}
			else if ($nav == "gear"){
				include ("layout/Category/Gear.php");	 
			}
			else if ($nav == "other"){
				include ("layout/Category/Others.php");
			}
			else if ($nav == "checkout" && isset($_SESSION["active"])){
				include ("layout/Checkout/User.php");				
			}
			else if ($nav == "checkout" && !isset($_SESSION["active"])){
				include ("layout/Checkout/Guest.php");				
			}
			else if ($nav == "history"){
				include ("layout/History.php");
			}
			else if ($nav == "search"){
				include ("layout/Search.php");
			}
		}
		else
		{
			include ("layout/Home.php");
		}
		
	?>				

		<!-- NEWSLETTER -->
		<div id="newsletter" class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class='row'>
					<div class='col-md-12'>
					<center><h2>!!! PHẢN HỒI VỀ <font color='#FA19B8'>TECH5</font> TẠI ĐÂY !!!</h2><br></center>
					<center><div>
					<form action="mailto:mistech5.studio@gmail.com" method="post" enctype="text/plain">
						<strong>NAME: </strong>
					<input style='display:inline' type="text" name="Name: " placeholder ='VD: abc, ...' size ='40'>
						<br><br><strong>EMAIL: </strong>
					<input type="text" name="Mail: " placeholder ='VD: someone@example.com, ...' size ='50'>
						<br><br><strong>REMARK:  </strong>
					<input type="text" name="Remark: " placeholder ='VD: Web xịn thế, ...' size ="60"><br><br>
					<button type ="submit"; style='position: center;
    								display: inline;
    								width: 100px;
									height: 40px;
									text-align: center;
									line-height: 40px;
									border: 1px solid #E4E7ED;
									background-color: #5C0756;
									color: #FFF;
									border-radius: 50px;
									-webkit-transition: 0.2s all;
									transition: 0.2s all;'>

										  <strong>SEND</strong></button> 
					<button type ="reset" style='position: center;
									display: inline;
									width: 100px;
									height: 40px;
									text-align: center;
									line-height: 40px;
									border: 1px solid #E4E7ED;
									background-color: #5C0756;
									border-radius: 50px;
									color: #FFF;
									-webkit-transition: 0.2s all;
									transition: 0.2s all;'>
										   <strong>RESET</strong></button>
					</form>
					</div></center>
					</div>
				</div>
					
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /NEWSLETTER -->
		
		<!-- FOOTER -->
		<?php
			include ("layout/Footer.php");
		?>
		<!-- /FOOTER -->
		
		<!-- jQuery Plugins -->
		
		<script src="js/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/slick.min.js"></script>
		<script src="js/nouislider.min.js"></script>
		<script src="js/jquery.zoom.min.js"></script>
		<script src="js/main.js"></script>
		<script>
			$(document).ready(function () {				
				// Add Product to cart
				var buttonAdd = document.querySelectorAll(".add-to-cart-btn");
				buttonAdd.forEach(item => {
					item.addEventListener('click', event => {
						var productId = $(item).attr('id');								
						$.ajax({
							url:'actions/Cart/AddProducts.php',
							type: 'POST',
							data: {'val': productId},
							success: function(response){
								var result = $.parseJSON(response);
								if (result["existed"] == 'true')
								{
									var qty = document.querySelector("div[id='"+result["prId"]+"'] span")
									qty.innerHTML = result["newQty"];									
								}
								if (result["existed"] == 'false')
								{	
									$('.cart-list').append(result["html"]);

									var qty= document.querySelector("div[class='dropdown'] div[class='qty']");
									qty.innerHTML = parseInt(qty.innerText)+1;
								}
								var cart_summary = document.querySelector(".cart-summary>small");
								itemSelected = cart_summary.innerHTML.split(' ')[0]
								itemSelected = parseInt(itemSelected) + 1;
								cart_summary.innerHTML = itemSelected + " Item(s) selected";
								document.location.reload(true);
							}
						})
					});
				});	

				$("input[type='number']").change(function () {					
					var row = $(this.parentNode.parentNode.childNodes[5]);			
				 	var productId = this.id;
					var quantity = this.value;
					$.ajax({
						url:'actions/Cart/GetQuantity.php',
						type: 'POST',
						data: 
						{
							'id': productId,
							'val': quantity
						},
						success: function(response){
							var result = $.parseJSON(response);			
							// Set qty in cart menu
							var qty = document.querySelector("div[id='"+productId+"'] span")
							qty.innerHTML = result['quantity'];	

							// Set row product price
							row[0].innerText = result['price']

							// Set total price
							var total = document.querySelector("strong.order-total");
							total.innerHTML = result['total'];					
					
							var input = document.querySelector("input[id='total']")
						 	input.value = result['inputTotal']
							
						}
					});					
				})
							
				// Get detail history
				$('.ga').click(function(){
					var idbilldetail = $(this).data('id');
					$.ajax({
						url:'actions/Order/GetHistory.php',
						type: 'post',
						data: {get_id: idbilldetail},
						success: function(response){
							$('.modal-body').html(response);
							$('#prdetail').modal('show');
						}
					});
				});

				// Get detail product
				$('.infoproduct').click(function(){
					var idprd = $(this).data('id');
					$.ajax({
						url:'Actions/Product/GetDetail.php',
						type: 'post',
						data: {get_id: idprd},
						success: function(response){
							$('.modal-body--detail').html(response);
							$('#product_detail').modal('show');
						}
					});
				});
			});
		</script>			
	</body>

<!--Start of Tawk.to Script-->
	<script type="text/javascript">
	var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
	(function(){
		var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
		s1.async=true;
		s1.src='https://embed.tawk.to/61dd3a97f7cf527e84d17d10/1fp42pohp';
		s1.charset='UTF-8';
		s1.setAttribute('crossorigin','*');
		s0.parentNode.insertBefore(s1,s0);
	})();
	</script>
<!--End of Tawk.to Script-->
</html>