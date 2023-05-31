<?php include './inc/handle.php' ?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<!-- <link rel="stylesheet" href="assets/css/base.css"> -->
	<link rel="stylesheet" href="assets/css/grid.css">
	<link rel="stylesheet" href="assets/css/productCart.css">
	<link rel="stylesheet" href="assets/css/base.css">
	<link rel="stylesheet" href="assets/css/main.css">
	<link rel="stylesheet" href="assets/font/themify-icons/themify-icons.css">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<title>ตะกร้าสินค้า</title>
</head>
<?php
// Cập nhập số lượng sản phẩm vào giỏ hàng
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['click_+'])) {
	$cartId = $_POST['cartId'];
	$quantity = $_POST['quantity_+'];
	$update_quantity = $cat->updateQuantity($cartId, $quantity, Session::get('user_id'));
}
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['click_-'])) {
	$cartId = $_POST['cartId'];
	$quantity = $_POST['quantity_-'];
	$update_quantity = $cat->updateQuantity($cartId, $quantity, Session::get('user_id'));
}
// Xóa sản phẩm ra khỏi giỏ hàng
if (isset($_GET['cartID'])) {
	$cartId = $_GET['cartID'];
	$delProductCart = $cat->del_ProductCart($cartId, Session::get('user_id'));
}
if (!isset($_GET['id'])) {
	echo "<meta http-equiv='refresh' content='0;URL=?id=live'>";
}elseif($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])){
	$id=$_POST['id'];
}
?>

<body>
	<div class="grid">
		<!-- Phần header -->
		<?php include 'inc/header.php' ?>
	</div>
	<div class="grid" style="border-top: 1px solid #ccc;">
		<div class="app">
			<div class="grid wide">
				<div class="app_cart">
					<div class="row">
						<div class="col l-8 " style="margin-top: 40px;">
							<div class="col l-12">
								<div class="checkout-process-bar block-border">
									<ul>
										<li class="active">
											<span>ตะกร้าสินค้า</span>
										</li>
										<li class=""><span>ตรวจสอบสินค้า</span></li>
										<li class=""><span>ชำระสินค้า</span></li>
									</ul>
								</div>
							</div>
							<div class="col l-12">
								<h1 style="margin: 20px;font-weight: 600;font-size: 24px;line-height: 32px;color: #221f20;font-family: var(--font-family-sans-serif);">ตะกร้าสินค้าของคุณ </h1>
							</div>
							<div class="col l-12 dal">
								<table>
									<thead>
										<tr>
											<th>รูปภาพสินค้า</th>
											<th>ชื่อสินค้า</th>
											<th>จำนวนสินค้า</th>
											<th>ราคาสินค้า</th>
											<th>สถานะ</th>
										</tr>
									</thead>
									<tbody>
										<?php
										$getProductCat = $cat->getProductCart(Session::get('user_id'));
										if ($getProductCat) {
											$dem = 0;
											$subTotal = 0;
											$i = 0;
											while ($result_ProductCat = $getProductCat->fetch_assoc()) {
												$i++;
										?>
												<tr>
													<td>
														<div class="cart-td_title">
															<img src="./admin/upload/<?php echo $result_ProductCat['image'] ?>" alt="" class="app_cart-img">
														</div>
													</td>
													<td>
														<span><?php echo $result_ProductCat['productName'] ?></span>
													</td>
													<td>
														<?php echo $result_ProductCat['size'] ?>
													</td>
													<td>
														<div class="cart-btn">
															<span><?php echo number_format($result_ProductCat['price'], 0, ',', '.') . "" . " บาท" ?></span>
														</div>
													</td>
													<td>
														<form action="" method="post">
															<div class="quantity" style="display: flex;">
																<input type="submit" class="btn" value="-" name="click_-" style="width:30px;">
																<input type="hidden" name="cartId" value="<?php echo $result_ProductCat['cartID'] ?>" />
																<?php
																	$get_productDetails = $product->getProduct_Details($result_ProductCat['productId']);

                        											while ($result_Details = $get_productDetails->fetch_assoc()) {
                        												if($result_ProductCat['quantity']  < $result_Details['quantity']){
																?>
																<input type="hidden" name="quantity_+" value="<?= $result_ProductCat['quantity'] + 1 ?>" id="hidden_input<?php echo $i; ?>" />
																<?php
															}else{
																?>
																<input type="hidden" name="quantity_+" value="<?= $result_ProductCat['quantity'] ?>" id="hidden_input<?php echo $i; ?>" />
																<?php
															}}
														?>

																<?php if ($result_ProductCat['quantity'] == 1) { ?>
																	<input type="hidden" name="quantity_-" value="<?= $result_ProductCat['quantity'] ?>" id="hidden_input<?php echo $i; ?>" />
																<?php
																} else {
																?>
																	<input type="hidden" name="quantity_-" value="<?= $result_ProductCat['quantity'] - 1 ?>" id="hidden_input<?php echo $i; ?>" />
																<?php
																}
																?>
																<input type="hidden" name="id" value="<?= $result_ProductCat['productId']?>" id="hidden_input<?php echo $i; ?>" />
																<input class="input" id="id<?php echo $i; ?>" type="text" value="<?= $result_ProductCat['quantity'] ?>" readonly="readonly" style="width:50px; text-align:center;">

																<?php
																	$get_productDetails = $product->getProduct_Details($result_ProductCat['productId']);

                        											while ($result_Details = $get_productDetails->fetch_assoc()) {
                        												if($result_ProductCat['quantity']  < $result_Details['quantity']){
																?>
																<input type="submit" class="btn" value="+" name="click_+" style="width:30px;">
																<?php
															}else{
																?>
																<input type="button" onclick="warning()" class="btn" value="+" name="click_+" style="width:30px;">
																<?php
															}}
															?>
															

															</div>
														</form>
													</td>

													<td>
														<span class="cart-current"><?php $total = $result_ProductCat['price'] * $result_ProductCat['quantity'];
																					echo number_format($total, 0, ',', '.') . "" . " บาท";

																					?></span>
													</td>
													<td>
														<a onclick="return confirm('Bạn có chắc chắn muốn xóa')" href="?cartID=<?php echo $result_ProductCat['cartID'] ?>" class="ti-close"><?php ?></a>
													</td>
												</tr>
										<?php
												$dem++;
												$subTotal += $total;
											}
										}
										?>
									</tbody>
									<?php
									if (isset($update_quantity)) {
										echo $update_quantity;
									}
									?>
									<?php
									if (isset($delProductCart)) {
										echo $delProductCart;
									}
									?>
								</table>
							</div>
							<div class="col l-12">
								<a class="back-history" href="javascript: window.history.back();">
									<span class="ti-arrow-left" style="padding: 0 10px;">

									</span>
									ดูสินค้าต่อ
								</a>
							</div>

						</div>
						<div class="col l-4">
							<div class="cart-voucher">
								<h3>จำนวนตะกร้าสินค้าทั้งหมด</h3>
								<?php
								$check_cart = $cat->checkCart(Session::get('user_id'));
								if ($check_cart) {
								?>
									<div style="display: flex;justify-content: space-between; margin: 20px 0;">
										<span class="voucher-title">
											<span>จำนวนสินค้า</span>
										</span>
										<span class="sum-product"><?php
											Session::set('sum', $dem);
											echo $dem ?>
										</span>
									</div>
									<div style="display: flex;justify-content: space-between; margin: 20px 0;">
										<div class="voucher-title">
											<span>ราคาสินค้า</span>
										</div>
										<span class="sum-product"><?php echo number_format($subTotal, 0, ',', '.') . "" . " บาท" ?></span>
									</div>
									<div style="display: flex;justify-content: space-between; margin: 20px 0;">
										<span class="sum-product">ภาษี (VAT 10%)</span>
										<span class="sum-product">
											<?php
											$vat = $subTotal * 0.1;
											echo number_format($vat, 0, ',', '.') . "" . " บาท";
											?>
										</span>
									</div>
									<div class="cart-purchase">
										<span class="sum-product">ราคาทั้งหมด</span>
										<span class="sum-product" style="font-weight: 800;">
											<?php
											$grand_Total = $subTotal - $vat;
											echo number_format($grand_Total, 0, ',', '.') . "" . " บาท"
											?>
										</span>
									</div>
									<div class="cart-purchase-button">
										<a href="thanhtoan.php"><button>สั่งซื้อ</button></a>
									</div>
								<?php
								} else {
									
								}
								?>
							</div>

						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php include './inc/footer.php' ?>
	<script type="text/javascript">
		function warning(){
		    Swal.fire({
		              icon: 'warning',
		              title: 'Oops...',
		              text: 'Đã đạt số lượng tối đa',
		            })
		}
	</script>
</body>

</html>