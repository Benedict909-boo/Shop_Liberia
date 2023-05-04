<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>
<body class="hold-transition skin-blue layout-top-nav">
<div class="wrapper">

	<?php include 'includes/navbar.php'; ?>
	 
	  <div class="content-wrapper">
	    <div class="container">

	      <!-- Main content -->
	      <section class="content">
	        <div class="row">
	        	<div class="col-sm-12">
	        		<?php
	        			if(isset($_SESSION['error'])){
	        				echo "
	        					<div class='alert alert-danger'>
	        						".$_SESSION['error']."
	        					</div>
	        				";
	        				unset($_SESSION['error']);
	        			}
	        		?>
	        		<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
		                <ol class="carousel-indicators">
		                  <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
		                  <li data-target="#carousel-example-generic" data-slide-to="1" class=""></li>
		                  <li data-target="#carousel-example-generic" data-slide-to="2" class=""></li>
		                </ol>
		                <div class="carousel-inner">
		                  <div class="item active">
		                    <img src="images/advert.png" alt="First slide">
		                  </div>
		                  <div class="item">
		                    <img src="images/advert.png" alt="Second slide">
		                  </div>
		                  <div class="item">
		                    <img src="images/advert.png" alt="Third slide">
		                  </div>
		                </div>
		                <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
		                  <span class="fa fa-angle-left"></span>
		                </a>
		                <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
		                  <span class="fa fa-angle-right"></span>
		                </a>
		            </div>
					<h2>All Products</h2>
		       	
					<div class="row">
						 <?php
						   $stmt->setFetchMode(PDO::FETCH_ASSOC);

							try {
								$conn = new PDO("mysql:host=localhost;dbname=rahelshop", "root", "");
								$conn->errorInfo();

								// set the PDO error mode to exception
								$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
								echo "Connected successfully"; 
							}
							catch(PDOException $e)
							{
								echo "Connection failed: " . $e->getMessage();
							}
							   $conn = $pdo->open();
							   try{
								   $stmt = $conn->prepare("SELECT * FROM  products ORDER BY date_view LIMIT 20");
								   $stmt->execute();
								   $result = $stmt->fetchAll();
								   if(count($result) > 0){
									   foreach ($result as $row) {
										   $image = (!empty($row['photo'])) ? 'images/'.$row['photo'] : 'images/noimage.jpg';
										   echo "
											   <div class='col-sm-4'>
												   <div class='box box-solid'>
													   <div class='box-body prod-body'>
														   <img src='".$image."' width='100%' height='230px' class='thumbnail'>
														   <h5><a href='product.php?product=".$row['slug']."'>".$row['name']."</a></h5>
														   <h5>&#36; ".number_format($row['price'], 2)."</h5>
													   </div>
													   <div class='box-footer'>
														   <button class='btn btn-sm btn-flat btn-danger pull-left add_cart' data-id='".$row['id']."'><i class='fa fa-shopping-cart'></i> Add to cart</button>
														   <a href='product.php?product=".$row['slug']."' class='pull-right btn btn-sm btn-flat btn-default'><i class='fa fa-eye'></i> View</a>
					   
														   </div>
														   </div>
													   </div>
													   ";
												   }
											   }
											   else{
												   echo "
													   <div class='col-sm-12'>
														   <div class='box box-solid'>
															   <div class='box-body'>
																   <h4 class='text-center'>No products found.</h4>
															   </div>
														   </div>
													   </div>
												   ";
											   }
										   }
										   catch(PDOException $e){
											   echo "There is some problem in connection: " . $e->getMessage();
										   }
										   $pdo->close();
										   ?>
										</div>

				
	        	</div>

	        	<!-- Side bar remove here !!! -->
	        </div>
	      </section>
	     
	    </div>
	  </div>
  
  	<?php include 'includes/footer.php'; ?>
</div>

<?php include 'includes/scripts.php'; ?>
</body>
</html>