<?php
/**
 * Php version 7.2.10
 * 
 * @category Components
 * @package  Packagename
 * @author   Sumit kumar Pandey <pandeysumit399@gmail.com>
 * @license  http://www.php.net/license/3_01.txt  PHP License 3.01
 * @link     http://localhost/training/php%20mysql%20task1/register/signup.php
 */
require 'config.php';
session_start();
require 'header.php';
?>
<!-- catg header banner section -->
  <section id="aa-catg-head-banner">
   <img src="img/fashion/fashion-header-bg-8.jpg" alt="fashion img">
   <div class="aa-catg-head-banner-area">
     <div class="container">
      <div class="aa-catg-head-banner-content">
        <h2>Fashion</h2>
        <ol class="breadcrumb">
          <li><a href="index.html">Home</a></li>         
          <li class="active">Women</li>
        </ol>
      </div>
     </div>
   </div>
  </section>
  <!-- / catg header banner section -->

  <!-- product category -->
  <section id="aa-product-category">
    <div class="container">
      <div class="row">
        <div class="col-lg-9 col-md-9 col-sm-8 col-md-push-3">
          <div class="aa-product-catg-content">
            <div class="aa-product-catg-head">
              <div class="aa-product-catg-head-left">
                <form action="" class="aa-sort-form">
                  <label for="">Sort by</label>
                  <select name="">
                    <option value="1" selected="Default">Default</option>
                    <option value="2">Name</option>
                    <option value="3">Price</option>
                    <option value="4">Date</option>
                  </select>
                </form>
                <form action="" class="aa-show-form">
                  <label for="">Show</label>
                  <select name="">
                    <option value="1" selected="12">12</option>
                    <option value="2">24</option>
                    <option value="3">36</option>
                  </select>
                </form>
              </div>
              <div class="aa-product-catg-head-right">
                <a id="grid-catg" href="#"><span class="fa fa-th"></span></a>
                <a id="list-catg" href="#"><span class="fa fa-list"></span></a>
              </div>
            </div>
 
            <div class="aa-product-catg-body">
              <ul class="aa-product-catg">
                  <!-- <script>
                  $(document).ready(function(){
                    
                    $(".category").click(function(){        
                      var catid = $(this).data('id');
                      console.log("hello" +catid);
                  $.ajax({
                    method : "POST",
                    url : "ajax.php",
                    data : {pid : catid}
                  })
                  .done(function( msg ){
                    var  $id = msg;
                    console.log($id);
                  }); -->
                <!-- });
                  });
                    </script> -->       
                <?php
                if (isset($_REQUEST['page'])) {
                    $page = $_REQUEST['page'];
                    $sql = "SELECT * FROM products ";
                    $result = $conn->query($sql);
                    $count=mysqli_num_rows($result);
                    $per_page=5;
                    $no_of_page=ceil($count/$per_page);
                    $start=($page-1)*$per_page;
                    $sql="SELECT * FROM products limit $start,$per_page";
                    $result=mysqli_query($conn, $sql);
                } else {
                    $page=1;
                    $sql = "SELECT * FROM products ";
                    $result = $conn->query($sql);
                    $count=mysqli_num_rows($result);
                    $per_page=5;
                    $no_of_page=ceil($count/$per_page);
                    $start=($page-1)*$per_page;
                    $sql="SELECT * FROM products limit $start,$per_page";
                    $result=mysqli_query($conn, $sql);
                    
                }
                if (isset($_REQUEST['id'])!= 0) {
                    $sql = "SELECT * FROM products ";
                } 
                if (isset($_REQUEST['id'])!= 0) {
                    $id = $_REQUEST['id'];
                    $sql = "SELECT * FROM products where `catid`=$id";
                }
                if (isset($_REQUEST['tagId'])!= 0) {
                    $tagId = $_REQUEST['tagId'];
                    $sql = "SELECT * FROM products where `tagId`=$tagId";
                }
                if (isset($_REQUEST['cid'])!= 0) {
                    $cid = $_REQUEST['cid'];
                    $sql = "SELECT * FROM products where `colorid`=$cid";
                }
                $result = $conn->query($sql);
                while ($row = $result->fetch_assoc()) {
                ?>
                <!-- start single product item -->
                <li>
                  <figure>
                    <a class="aa-product-img" href="#"><?php echo'<img style="height:300px;width:250px;"src="Admin/images/' . $row['image'] . '">' ?></a> 
                    <a class="aa-add-card-btn"href="addproduct.php?pid=
                    <?php echo $row['id']?>">
                    <span class="fa fa-shopping-cart"></span>Add To Cart</a>
                    <figcaption>
                      <h4 class="aa-product-title"><a href="#">
                    <?php echo $row['name']?></a></h4>
                      <span class="aa-product-price">
                    <?php echo $row['price']?>$</span>
                      <span class="aa-product-price"><del>
                    <?php echo $row['price']?>$</del></span>
                      <p class="aa-product-descrip">
                    <?php echo $row['description']?></p>
                    </figcaption>
                  </figure>                             
                  <div class="aa-product-hvr-content">
                    <a href="#" data-toggle2="tooltip" data-id=
                    <?php echo $row['id']?>
                     data-placement="top" title="Quick View"
                      data-toggle="modal" data-target=
                      "#quick-view-modal" class="quick">
                      <span class="fa fa-search">
                      </span></a>                            
                  </div>
                  <!-- product badge -->
                  <span class="aa-badge aa-sale" href="#">SALE!</span>   
                </li>   
                <?php 
                }
                ?>  
              </ul>
              <!-- quick view modal -->     
                
              <div class="modal fade" id="quick-view-modal" tabindex="-1"
              role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">                      
                    <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal"
                     aria-hidden="true">&times;</button>
                      <div class="row">
                        <!-- Modal view slider -->
                        <div class="col-md-6 
                        col-sm-6 col-xs-12">                              
                          <div class="
                          aa-product-view-slider">                                
                            <div class="simpleLens-gallery-container" id="demo-1">
                              <div class="simpleLens-container">
                                  <div class="simpleLens-big-image-container">
                                      <a class="simpleLens-lens-image" data-lens-image="img/view-slider/large/polo-shirt-1.png">
                                          <img src="img/view-slider/medium/polo-shirt-1.png"
                                          class="simpleLens-big-image">
                                      </a>
                                  </div>
                              </div>
                              <div class="simpleLens-thumbnails-container">
                                  <a href="#" class="simpleLens-thumbnail-wrapper"
                                     data-lens-image=
                                     "img/view-slider/large/polo-shirt-1.png"
                                     data-big-image=
                                     "img/view-slider/medium/polo-shirt-1.png">
                                      <img src="
                                      img/view-slider/thumbnail/polo-shirt-1.png">
                                  </a>                                    
                                  <a href="#" class="simpleLens-thumbnail-wrapper"
                                     data-lens-image="img/view-slider/large/polo-shirt-3.png"
                                     data-big-image="img/view-slider/medium/polo-shirt-3.png">
                                      <img src="img/view-slider/thumbnail/polo-shirt-3.png">
                                  </a>

                                  <a href="#" class="simpleLens-thumbnail-wrapper"
                                     data-lens-image="img/view-slider/large/polo-shirt-4.png"
                                     data-big-image="img/view-slider/medium/polo-shirt-4.png">
                                      <img src="img/view-slider/thumbnail/polo-shirt-4.png">
                                  </a>
                              </div>
                            </div>
                          </div>
                        </div>
                        <!-- Modal view content -->
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <div class="aa-product-view-content">
                            <h3>T-Shirt</h3>
                            <div class="aa-price-block">
                              <span class="aa-product-view-price">$34.99</span>
                              <p class="aa-product-avilability">Avilability: <span>In stock</span></p>
                            </div>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Officiis animi, veritatis quae repudiandae quod nulla porro quidem, itaque quis quaerat!</p>
                            <h4>Size</h4>
                            <div class="aa-prod-view-size">
                              <a href="#">S</a>
                              <a href="#">M</a>
                              <a href="#">L</a>
                              <a href="#">XL</a>
                            </div>
                            <div class="aa-prod-quantity">
                              <form action="">
                                <select name="" id="">
                                  <option value="0" selected="1">1</option>
                                  <option value="1">2</option>
                                  <option value="2">3</option>
                                  <option value="3">4</option>
                                  <option value="4">5</option>
                                  <option value="5">6</option>
                                </select>
                              </form>
                              <p class="aa-prod-category">
                                Category: <a href="#">Polo T-Shirt</a>
                              </p>
                            </div>
                            <div class="aa-prod-view-bottom">
                              <a href="#" class="aa-add-to-cart-btn">
                              <span class="fa fa-shopping-cart"></span>Add To Cart</a>
                              <a href="#" class="aa-add-to-cart-btn">View Details</a>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>                        
                  </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
              </div>
              <!-- / quick view modal -->       
            </div>  
            <div class="aa-product-catg-pagination">
              <nav>
                <ul class="pagination">
                  <li
                    <?php 
                     $sql = "SELECT * FROM products ";
                     $result = $conn->query($sql);
                     $count=mysqli_num_rows($result);
                     $per_page=5;
                     $no_of_page=ceil($count/$per_page);
                    if ($page==1)
                    echo "class='disabled'";
                    ?>
                    ><a href="product.php?page=<?php echo $page-1 ?>" aria-label="Previous">
                      <span aria-hidden="true">&laquo;</span>
                    </a>
                  </li>
                  <?php
                  for ($i=1;$i<=$no_of_page;$i++)
                  { ?>
                    <li
                    <?php if ($page==$i)echo 'class="active"';?>>
                    <a href="product.php?page=<?php echo $i;?>"><?php echo $i;?></a></li>
                  <?php
                  }
                  ?>
                  <li <?php if ($page==$no_of_page) echo "class='disabled'"?>>
                    <a href="product.php?page=<?php echo $page+1 ?>" aria-label="Next">
                      <span aria-hidden="true">&raquo;</span>
                    </a>
                  </li>
                </ul>
              </nav>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-4 col-md-pull-9">
          <aside class="aa-sidebar">
            <!-- single sidebar -->
            <div class="aa-sidebar-widget">
              <h3>Category</h3>
                <?php 
                  $sql = "SELECT * FROM category";
                  $result = $conn->query($sql);
                  while ($row = $result->fetch_assoc()) {
                  ?>
                <ul class="aa-catg-nav">
                  <li><a href="product.php?id=<?php echo $row['catid']?>" class="category" >
                  <?php echo $row['catname']?></a></li>
                </ul>
                <?php }
                ?>
            </div>
            <!-- single sidebar -->
            <div class="aa-sidebar-widget">
              <h3>Tags</h3>
              <div class="tag-cloud">
              <?php 
                $sql = "SELECT * FROM tags";
                $result = $conn->query($sql);
                while ($row = $result->fetch_assoc()) {
                ?>
                <a href="product.php?tagId=<?php echo $row['tagId']?>"><?php echo $row['tagName'] ?></a>
                <?php } ?>
              </div>
            </div>
            <!-- single sidebar -->
            <div class="aa-sidebar-widget">
              <h3>Shop By Price</h3>              
              <!-- price range -->
              <div class="aa-sidebar-price-range">
               <form action="">
                  <div id="skipstep" class="noUi-target noUi-ltr noUi-horizontal noUi-background">
                  </div>
                  <span id="skip-value-lower" class="example-val">30.00</span>
                 <span id="skip-value-upper" class="example-val">100.00</span>
                 <button class="aa-filter-btn" type="submit">Filter</button>
               </form>
              </div>              
            </div>
  
                 

                 
            <!-- single sidebar -->
            <div class="aa-sidebar-widget">
              <h3>Shop By Color</h3>
  
              <div class="aa-color-tag">
              <?php
                     $sql = "SELECT * FROM color";
                     $result = $conn->query($sql);
                    while ($row = $result->fetch_assoc()) {
                            ?>
                <a href="product.php?cid=<?php echo $row['colorid'];?>">
                <input type = "hidden" name="color" value="<?php echo $row['colorid'] ?>"
                    style="height:15px;width:15px;" checked>
                    <input type = "color" value = "<?php echo 
                    $row['colorcode']?>" style="border:none;height:30px;cursor:pointer;"
                    disabled></a>
                    <?php
                    } 
                            ?>  
              </div>   
                                   
            </div>
            <!-- single sidebar -->
            <div class="aa-sidebar-widget">
              <h3>Recently Views</h3>
              <div class="aa-recently-views">
                <ul>
                  <li>
                    <a href="#" class="aa-cartbox-img"><img alt="img" src="img/woman-small-2.jpg"></a>
                    <div class="aa-cartbox-info">
                      <h4><a href="#">Product Name</a></h4>
                      <p>1 x $250</p>
                    </div>                    
                  </li>
                  <li>
                    <a href="#" class="aa-cartbox-img"><img alt="img" src="img/woman-small-1.jpg"></a>
                    <div class="aa-cartbox-info">
                      <h4><a href="#">Product Name</a></h4>
                      <p>1 x $250</p>
                    </div>                    
                  </li>
                   <li>
                    <a href="#" class="aa-cartbox-img"><img alt="img" src="img/woman-small-2.jpg"></a>
                    <div class="aa-cartbox-info">
                      <h4><a href="#">Product Name</a></h4>
                      <p>1 x $250</p>
                    </div>                    
                  </li>                                      
                </ul>
              </div>                            
            </div>
            <!-- single sidebar -->
            <div class="aa-sidebar-widget">
              <h3>Top Rated Products</h3>
              <div class="aa-recently-views">
                <ul>
                  <li>
                    <a href="#" class="aa-cartbox-img"><img alt="img" src="img/woman-small-2.jpg"></a>
                    <div class="aa-cartbox-info">
                      <h4><a href="#">Product Name</a></h4>
                      <p>1 x $250</p>
                    </div>                    
                  </li>
                  <li>
                    <a href="#" class="aa-cartbox-img"><img alt="img" src="img/woman-small-1.jpg"></a>
                    <div class="aa-cartbox-info">
                      <h4><a href="#">Product Name</a></h4>
                      <p>1 x $250</p>
                    </div>                    
                  </li>
                   <li>
                    <a href="#" class="aa-cartbox-img"><img alt="img" src="img/woman-small-2.jpg"></a>
                    <div class="aa-cartbox-info">
                      <h4><a href="#">Product Name</a></h4>
                      <p>1 x $250</p>
                    </div>                    
                  </li>                                      
                </ul>
              </div>                            
            </div>
          </aside>
        </div>
       
      </div>
    </div>
  </section>
  <!-- / product category -->
  <?php require 'footer.php'; ?>