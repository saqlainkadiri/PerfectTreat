<?php
function redirect_to($new_location) {
    header("Location: " . $new_location);
    exit();
}
session_start();
if(isset($_SESSION["u_id"])){
}
else{
    echo "<script>alert('Session Expired. Login Again!');
                  window.location = '../html/login.html'; </script>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<title>Sweets</title>
	<link href="../css/all.css" rel="stylesheet" type="text/css" media="all" />
	<link href="../css/items.css" rel="stylesheet" type="text/css" media="all" />
	<script src="../js/base.min.js"></script>
    <script src="../js/jquery-1.8.3.min.js"></script>
	<style>
		.ghost {
			position: absolute;
			z-index: 999;
			top: 0px;
			left: 0px;
		}
	</style>
</head>

<body class="">
<div id="site">
	<div id="header" role="banner"></div>
    <h3 align="right"><font color="#92c100"><?php
            require_once("db_connection.php");
            $u_id=$_SESSION['u_id'];
            $query2 = "SELECT * FROM `users` WHERE u_id=$u_id";
            $result2 = mysqli_query($connection, $query2);
            $user=mysqli_fetch_assoc($result2);
            $user_name=$user['username'];
            echo "Welcome, " . $user_name;
            ?></font></h3>
	<div id="nav_main" role="navigation" class="reset menu pull_out">
		<h3 class="hidden">Main Navigation</h3>
		<ul>
			<li>
				<a href="sweets.php" class="parent"><span>Sweets</span></a>
			</li>
			<li>
			<li><a href="../other/menu.xml"><span>Menu</span></a></li>
			<li><a href="bulk_submit.php"><span>Bulk Orders</span></a></li>
            <li><a href="aboutus.php"><span>About Us</span></a></li>
            <li>
                <a href="temp_offer.php?month=<?php echo date('m');?>" class="parent"><span>Seasonal Offers</span></a>
			</li>
		</ul>
	</div>
	<div id="content">
		<div id="breadcrumbs" class="reset menu">
			<ul>
				<li>Sweets</li>
			</ul>
		</div>
		<form action="basket.php" method="POST">
			<div id="col_1" role="main">
				<h2 class="inline_block">Click the image to Order the Item!!</h2>
				<ul id="flower-items">
					<li>
						<a href="#bab-CL" id="item1">
							<span class="img"><img src="../images/Kaju_Katli.jpg" width="160" height="160" alt="Kaju Katli" id="13"/></span>
							<h4>Kaju Katli</h4>
							<p class="price reset">Rs.800/- per kg</p>
						</a>
						<input type="text" placeholder="00" name="check_list3[]" class="temp_hide" id="01" value="00" readonly>
					</li>
					<li>
						<a href="#bab-S" id="item2">
							<span class="img"><img src="../images/Malai_Barfi.jpg" width="160" height="160" alt="Malai Barfi" id="14"/></span>
							<h4>Malai Barfi</h4>
							<p class="price reset">Rs.640/- per kg</p>
						</a>
						<input type="text" placeholder="00" name="check_list3[]" class="temp_hide" id="02" value="00" readonly>
					</li>
					<li>
						<a href="#bab-I" id="item3">
							<span class="img"><img src="../images/Coco_Barfi.jpg" width="160" height="160" alt="Coco Barfi" id="15"/></span>
							<h4>Coco Barfi</h4>
							<p class="price reset">Rs.380/- per kg</p>
						</a>
						<input type="text" placeholder="00" name="check_list3[]" class="temp_hide" id="03" value="00" readonly>
					</li>
					<li>
						<a href="#bab-PL" id="item4">
							<span class="img"><img src="../images/Besan_Barfi.jpg" width="160" height="160" alt="Besan Barfi" id="16"/></span>
							<h4>Besan Barfi</h4>
							<p class="price reset">Rs.440/- per kg</p>
						</a>
						<input type="text" placeholder="00" name="check_list3[]" class="temp_hide" id="04" value="00" readonly>
					</li>
					<li>
						<a href="#bab-CL" id="item5">
							<span class="img"><img src="../images/Khopra_Pak.jpg" width="160" height="160" alt="Khopra Pak" id="17"/></span>
							<h4>Khopra Pak</h4>
							<p class="price reset">Rs.380/- per kg</p>
						</a>
						<input type="text" placeholder="00" name="check_list3[]" class="temp_hide" id="05" value="00" readonly>
					</li>
					<li>
						<a href="#bab-S" id="item6">
							<span class="img"><img src="../images/Gulab_Jamun.jpg" width="160" height="160" alt="Gulab Jamun" id="18"/></span>
							<h4>Gulab Jamun</h4>
							<p class="price reset">Rs.300/- per kg</p>
						</a>
						<input type="text" placeholder="00" name="check_list3[]" class="temp_hide" id="06" value="00" readonly>
					</li>
					<li>
						<a href="#bab-I" id="item7">
							<span class="img"><img src="../images/Jalebi.jpg" width="160" height="160" alt="Jalebi" id="19"/></span>
							<h4>Jalebi</h4>
							<p class="price reset">Rs.250/- per kg</p>
						</a>
						<input type="text" placeholder="00" name="check_list3[]" class="temp_hide" id="07" value="00" readonly>
					</li>
					<li>
						<a href="#bab-PL" id="item8">
							<span class="img"><img src="../images/Ras_Malai.jpg" width="160" height="160" alt="Ras Malai" id="20"/></span>
							<h4>Ras Malai</h4>
							<p class="price reset">Rs.450/- per kg</p>
						</a>
						<input type="text" placeholder="00" name="check_list3[]" class="temp_hide" id="08" value="00" readonly>
					</li>
					<li>
						<a href="#bab-CL" id="item9">
							<span class="img"><img src="../images/Laddu.jpg" width="160" height="160" alt="Laddu" id="21"/></span>
							<h4>Laddu</h4>
							<p class="price reset">Rs.350/- per kg</p>
						</a>
						<input type="text" placeholder="00" name="check_list3[]" class="temp_hide" id="09" value="00" readonly>
					</li>
					<li>
						<a href="#bab-S" id="item10">
							<span class="img"><img src="../images/Anjeer_Barfi.jpg" width="160" height="160" alt="Anjeer Barfi" id="22"/></span>
							<h4>Anjeer Barfi</h4>
							<p class="price reset">Rs.760/- per kg</p>
						</a>
						<input type="text" placeholder="00" name="check_list3[]" class="temp_hide" id="10" value="00" readonly>
					</li>
					<li>
						<a href="#bab-I" id="item11">
							<span class="img"><img src="../images/Kesar_Katli.jpg" width="160" height="160" alt="Kesar Katli" id="23"/></span>
							<h4>Kesar Katli</h4>
							<p class="price reset">Rs.960/- per kg</p>

						</a>
						<input type="text" placeholder="00" name="check_list3[]" class="temp_hide" id="11" value="00" readonly>
					</li>
					<li>
						<a href="#bab-PL" id="item12">
							<span class="img"><img src="../images/Badam_Katli.jpg" width="160" height="160" alt="Badam Katli" id="24"/></span>
							<h4>Badam Katli</h4>
							<p class="price reset">Rs.1000/- per kg</p>
						</a>
						<input type="text" placeholder="00" name="check_list3[]" class="temp_hide" id="12" value="00" readonly>
					</li>
				</ul>
			</div>
			<div id="col_2">
				<h3>Shopping Cart</h3>
				<div id="Cart"><button type="submit" name="submit" id="CartSubmit">Go to Cart</button>
				</div>
				<div id="cart-target">
					<p>Select items to add to cart!</p>
				</div>
			</div>
		</form>
	</div>
	<div id="footer">
	</div>
</div>

<p id="disclaimer">This website is made by Saqlain Kadiri and Rahul Joshi for educational purposes only. By using this website you understand that there is no attorney client relationship between you and the website publisher.This website is to be used as a template for online sweet shopping for educational purposes only.</p>

<script src="../js/plugins.min.js"></script>
<script>
    $(document).ready(function() {
        $("#header").load("header.html");
        $("#footer").load("footer.html");
        var $flowers = $('#flower-items');
		var $prev=new Array('0','0','0','0','0','0','0','0','0','0','0','0');
        $flowers.find('a').on('click', function(e){
            e.preventDefault();
            var $link = $(this),
                $img = $link.find('img');

            // add a copy of the image to the document
            $ghost = $img.clone().appendTo($link).addClass('ghost');

            var imgCoords = $img.offset(),
                $target = $('#cart-target'),
                targetCoords = $target.offset();

            $ghost.animate({
                'left' : targetCoords.left - imgCoords.left,
                'top' : targetCoords.top - imgCoords.top,
                'opacity' : 0,
                'width' : '30px'
            }, 1500, 'easeInBack', function(){
                $(this).remove();
                $target.append('Added 1 ' + $link.find('h4').text() + '.<br>');
            });
            var $temp=$img.attr("id")-12;
            ($prev[$temp-1]==0)?($prev[$temp-1]=1):($prev[$temp-1]=$prev[$temp-1]+1);
            if($temp==01){
                $('input[id="01"]').val($prev[$temp-1]);
            }
            else if($temp==02){
                $('input[id="02"]').val($prev[$temp-1]);
            }
            else if($temp==03){
                $('input[id="03"]').val($prev[$temp-1]);
            }
            else if($temp==04){
                $('input[id="04"]').val($prev[$temp-1]);
            }
            else if($temp==05){
                $('input[id="05"]').val($prev[$temp-1]);
            }
            else if($temp==06){
                $('input[id="06"]').val($prev[$temp-1]);
            }
            else if($temp==07){
                $('input[id="07"]').val($prev[$temp-1]);
            }
            else if($temp==08){
                $('input[id="08"]').val($prev[$temp-1]);
            }
            else if($temp==09){
                $('input[id="09"]').val($prev[$temp-1]);
            }
            else if($temp==10){
                $('input[id="10"]').val($prev[$temp-1]);
            }
            else if($temp==11){
                $('input[id="11"]').val($prev[$temp-1]);
            }
            else if($temp==12){
                $('input[id="12"]').val($prev[$temp-1]);
            }
            else{
                alert("NONE Selected");
            }
        });
    });
</script>

</body>
</html>
