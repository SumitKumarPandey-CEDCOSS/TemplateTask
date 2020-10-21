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
session_start();
require 'header.php';
require 'config.php';

if (isset($_REQUEST['submit'])) {
    echo "<script>alert('ok')</script>";
    $qty= isset($_POST['quantity']) ? $_POST['quantity'] : '';
    echo $qty;
    if (isset($_REQUEST['id'])) {
        $id=$_REQUEST['id'];
        $sql="SELECT * FROM products WHERE `id`=$id";
        $res = $conn->query($sql);
        while ($ab=mysqli_fetch_array($res)) {
            $pri = $ab['price'];
            if (!empty($_SESSION)) {
                foreach ($_SESSION['cart'] as $key => $value) {
                    if ($ab['id'] == $value['id']) {
                        $id= $value['id'];
                        $name     = $value['name'];
                        $price    = $value['price'];
                        $image    = $value['image'];
                        $quantity =$value['quantity']+1;
                        $item = array(
                        "id" => $id,
                        "name" => $name,
                        "pricee"=>$pri,
                        "price" => $pri*$quantity,
                        "quantity" => $quantity,
                        "image" => $image
                            );
                        echo '<script>alert("Product Quantity Increased in Cart 
                        Succefully")
                        </script>';
                        header("Refresh:0; url=products.php");
                        $_SESSION['cart'][$id] = $item;
                        return;
                    }
                }
            }
            $name = $ab['name'];
            $price = $ab['price'];
            $id = $ab['id'];
            $image = $ab['image'];
            // $quantity =1;
            $item = array(
                "name" => $name,
                "price" => $price*$qty,
                "pricee" => $pri,
                "id" => $id,
                "quantity"=> $qty,
                "image" => $image
            );
            echo '<script>alert("Product Added In Cart")</script>';
            echo '<script>window.location="product.php"
            </script>';
            $_SESSION['cart'][$id]= $item;  
        }
    }
}

?>
<?php 
if (isset($_REQUEST['id'])) {
    $id = $_REQUEST['id'];
}
$sql = "SELECT * FROM products WHERE `id`= $id ";
$result = $conn->query($sql);
while ($row = $result->fetch_assoc()) {
    $catid=$row['catid'];
    $cid=$row['colorid'];
    // echo $catid;
?>
  <!-- product category -->
  <section id="aa-product-details">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="aa-product-details-area">
            <div class="aa-product-details-content">
              <div class="row">
                <!-- Modal view slider -->
                <div class="col-md-5 col-sm-5 col-xs-12">                              
                  <div class="aa-product-view-slider">                                
                    <div id="demo-1" class="simpleLens-gallery-container">
                      <div class="simpleLens-container">
                        <div class="simpleLens-big-image-container">
                          <a data-lens-image="img/view-slider/large/polo-shirt-1.png" 
                          class="simpleLens-lens-image">
                          <?php echo '<img style="height:300px;width:250px;" src="Admin/images/' . $row['image'] . '">'?></a></div>
                      </div>
                      <div class="simpleLens-thumbnails-container">                                  
                      </div>
                    </div>
                  </div>
                </div>
                <!-- Modal view content -->
                <div class="col-md-7 col-sm-7 col-xs-12">
                  <div class="aa-product-view-content">
                    <h3><?php echo $row['name']?></h3>
                    <div class="aa-price-block">
                      <span class="aa-product-view-price">$
                        <?php echo $row['price']?></span>
                      <p class="aa-product-avilability">
                        Avilability: <span>In stock</span></p>
                    </div>
                    <p><?php echo $row['description']?></p>
                    <h4>Size</h4>
                    <div class="aa-prod-view-size">
                      <a href="#">S</a>
                      <a href="#">M</a>
                      <a href="#">L</a>
                      <a href="#">XL</a>
                    </div>
                    <h4>Color</h4>
                    <div class="aa-color-tag">
                    <?php
                     $sql = "SELECT * FROM color WHERE `colorid`=$cid";
                     $result = $conn->query($sql);
                    while ($row = $result->fetch_assoc()) {
                            ?>
                            <input type = "radio" name="color" value="<?php echo 
                            $row['colorid'] ?>"
                            style="height:15px;width:15px;" checked>
                            <input type = "color" value = "<?php echo 
                            $row['colorcode']?>" style="border:none;"
                            disabled>
                            <?php
                    } 
                            ?>                     
                    </div>
                    <div class="aa-prod-quantity">
                      <form action="" method="POST">
                        <select id="" name="quantity">
                          <option selected="1" value="1">1</option>
                          <option value="2">2</option>
                          <option value="3">3</option>
                          <option value="4">4</option>
                          <option value="5">5</option>
                          <option value="6">6</option>
                        </select>
                    <?php
                        $sql = "SELECT * FROM category WHERE `catid`=$catid ";
                        $result = $conn->query($sql);
                    while ($row = $result->fetch_assoc()) {
                    ?>
                      <p class="aa-prod-category">
                        Category: <span style="color:red;">
                        <?php echo $row['catname'];?></span>
                      </p>
                    <?php } ?>
                    </div>
                    <div class="aa-prod-view-bottom">
                        <?php
                        $sql = "SELECT * FROM products WHERE `id`= $id ";
                        $result = $conn->query($sql);
                        while ($row = $result->fetch_assoc()) {
                        ?>
                            
                            <input type="submit" name="submit" value="ADD-TO--CART" 
                            class="aa-add-to-cart-btn">
                        <?php } ?>
                    </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
            <div class="aa-product-details-bottom">
              <ul class="nav nav-tabs" id="myTab2">
                <li><a href="#description" data-toggle="tab">Description</a></li>
                <li><a href="#review" data-toggle="tab">
                  Reviews</a></li>                
              </ul>
                <?php } ?>
              <!-- Tab panes -->
              <div class="tab-content">
                <div class="tab-pane fade in active" id="description">
                  <p>Lorem Ipsum is simply dummy text 
                    of the printing and typesetting industry. 
                    Lorem Ipsum has been the industry's standard 
                    dummy text ever since the 1500s, 
                    when an unknown printer took a galley of type and scrambled
                    it to make a type specimen book. It has survived not only 
                    five centuries, but also the leap into electronic 
                    typesetting, remaining essentially unchanged. 
                    It was popularised in the 1960s with the release of 
                    Letraset sheets containing Lorem Ipsum passages,
                     and more recently with desktop publishing 
                     software like Aldus PageMaker including 
                     versions of Lorem Ipsum.</p>
                  <ul>
                    <li>Lorem ipsum dolor sit amet, 
                      consectetur adipisicing elit. Quod, culpa!</li>
                    <li>Lorem ipsum dolor sit amet.</li>
                    <li>Lorem ipsum dolor sit amet, 
                      consectetur adipisicing elit.</li>
                    <li>Lorem ipsum dolor sit amet, 
                      consectetur adipisicing elit. Dolor qui eius esse!</li>
                    <li>Lorem ipsum dolor sit amet,
                       consectetur adipisicing elit. Quibusdam, modi!</li>
                  </ul>
                  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                     Illum, iusto earum voluptates autem esse molestiae ipsam,
                    atque quam amet similique ducimus aliquid voluptate perferendis,
                    distinctio!</p>
                  <p>Lorem ipsum dolor sit amet, consectetur 
                    adipisicing elit. Blanditiis ea, voluptas! Aliquam facere 
                    quas cumque rerum dolore impedit, dicta ducimus repellat 
                    dignissimos, fugiat, minima quaerat necessitatibus? Optio 
                    adipisci ab, obcaecati, porro unde accusantium 
                    facilis repudiandae.</p>
                </div>
                <div class="tab-pane fade " id="review">
                 <div class="aa-product-review-area">
                   <h4>2 Reviews for T-Shirt</h4> 
                   <ul class="aa-review-nav">
                     <li>
                        <div class="media">
                          <div class="media-left">
                            <a href="#">
                              <img class="media-object" 
                              src="img/testimonial-img-3.jpg" alt="girl image">
                            </a>
                          </div>
                          <div class="media-body">
                            <h4 class="media-heading"><strong>Marla Jobs</strong> -
                             <span>March 26, 2016</span></h4>
                            <div class="aa-product-rating">
                              <span class="fa fa-star"></span>
                              <span class="fa fa-star"></span>
                              <span class="fa fa-star"></span>
                              <span class="fa fa-star"></span>
                              <span class="fa fa-star-o"></span>
                            </div>
                            <p>Lorem ipsum dolor sit amet, 
                              consectetur adipisicing elit.</p>
                          </div>
                        </div>
                      </li>
                      <li>
                        <div class="media">
                          <div class="media-left">
                            <a href="#">
                              <img class="media-object" 
                              src="img/testimonial-img-3.jpg" alt="girl image">
                            </a>
                          </div>
                          <div class="media-body">
                            <h4 class="media-heading"><strong>
                              Marla Jobs</strong> - <span>March 26, 2016</span></h4>
                            <div class="aa-product-rating">
                              <span class="fa fa-star"></span>
                              <span class="fa fa-star"></span>
                              <span class="fa fa-star"></span>
                              <span class="fa fa-star"></span>
                              <span class="fa fa-star-o"></span>
                            </div>
                            <p>Lorem ipsum dolor sit amet,
                               consectetur adipisicing elit.</p>
                          </div>
                        </div>
                      </li>
                   </ul>
                   <h4>Add a review</h4>
                   <div class="aa-your-rating">
                     <p>Your Rating</p>
                     <a href="#"><span class="fa fa-star-o"></span></a>
                     <a href="#"><span class="fa fa-star-o"></span></a>
                     <a href="#"><span class="fa fa-star-o"></span></a>
                     <a href="#"><span class="fa fa-star-o"></span></a>
                     <a href="#"><span class="fa fa-star-o"></span></a>
                   </div>
                   <!-- review form -->
                   <form action="" class="aa-review-form">
                      <div class="form-group">
                        <label for="message">Your Review</label>
                        <textarea class="form-control"
                         rows="3" id="message"></textarea>
                      </div>
                      <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class=
                        "form-control" id="name" placeholder="Name">
                      </div>  
                      <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class=
                        "form-control" id="email" placeholder="example@gmail.com">
                      </div>

                      <button type="submit" class="
                      btn btn-default aa-review-submit">Submit</button>
                   </form>
                 </div>
                </div>            
              </div>
            </div>
            <!-- Related product -->
            <div class="aa-product-related-item">
              <h3>Related Products</h3>
              <ul class="aa-product-catg aa-related-item-slider">
                <!-- start single product item -->
                <li>
                  <figure>
                    <a class="aa-product-img" href="#">
                      <img src="img/man/polo-shirt-2.png" alt="polo shirt img"></a>
                    <a class="aa-add-card-btn"href="#">
                      <span class="fa fa-shopping-cart"></span>Add To Cart</a>
                     <figcaption>
                      <h4 class="aa-product-title">
                        <a href="#">Polo T-Shirt</a></h4>
                      <span class="aa-product-price">
                      $45.50</span><span class="aa-product-price">
                      <del>$65.50</del></span>
                    </figcaption>
                  </figure>                     
                  <div class="aa-product-hvr-content">
                    <a href="#" data-toggle="tooltip"
                     data-placement="top" title="Add to Wishlist">
                     <span class="fa fa-heart-o"></span></a>
                    <a href="#" data-toggle="tooltip"
                    data-placement="top" title="Compare">
                    <span class="fa fa-exchange"></span></a>
                    <a href="#" data-toggle2="tooltip"
                    data-placement="top" title="Quick View" data-toggle="modal"
                     data-target="#quick-view-modal"><span class="fa fa-search">
                     </span></a>                            
                  </div>
                  <!-- product badge -->
                  <span class="aa-badge aa-sale" href="#">SALE!</span>
                </li>
                 <!-- start single product item -->
                <li>
                  <figure>
                    <a class="aa-product-img" href="#">
                      <img src="img/women/girl-2.png" alt="polo shirt img"></a>
                    <a class="aa-add-card-btn"href="#">
                      <span class="fa fa-shopping-cart">
                      </span>Add To Cart</a>
                    <figcaption>
                      <h4 class="aa-product-title"><a href="#">
                        Lorem ipsum doller</a></h4>
                      <span class="aa-product-price">$45.50</span>
                    </figcaption>
                  </figure>                      
                  <div class="aa-product-hvr-content">
                    <a href="#" data-toggle="tooltip" 
                    data-placement="top" title="Add to Wishlist">
                    <span class="fa fa-heart-o"></span></a>
                    <a href="#" data-toggle="tooltip" 
                    data-placement="top" title="Compare">
                    <span class="fa fa-exchange"></span></a>
                    <a href="#" data-toggle2="tooltip"
                     data-placement="top" title="Quick View" 
                     data-toggle="modal" data-target="#quick-view-modal">
                     <span class="fa fa-search"></span></a>
                  </div>
                  <!-- product badge -->
                   <span class="aa-badge aa-sold-out" href="#">Sold Out!</span>
                </li>
                <!-- start single product item -->
                <li>
                  <figure>
                    <a class="aa-product-img" href="#">
                      <img src="img/man/t-shirt-1.png" alt="polo shirt img"></a>
                    <a class="aa-add-card-btn"href="#">
                      <span class="fa fa-shopping-cart"></span>Add To Cart</a>
                  </figure>
                  <figcaption>
                    <h4 class="aa-product-title"><a href="#">T-Shirt</a></h4>
                    <span class="aa-product-price">$45.50</span>
                  </figcaption>
                  <div class="aa-product-hvr-content">
                    <a href="#" data-toggle="tooltip" data-placement="top" 
                    title="Add to Wishlist"><span class="fa fa-heart-o"></span></a>
                    <a href="#" data-toggle="tooltip" data-placement="top" 
                    title="Compare"><span class="fa fa-exchange"></span></a>
                    <a href="#" data-toggle2="tooltip" data-placement="top"
                     title="Quick View" data-toggle="modal" 
                     data-target="#quick-view-modal">
                     <span class="fa fa-search"></span></a>
                  </div>
                  <!-- product badge -->
                   <span class="aa-badge aa-hot" href="#">HOT!</span>
                </li>
                <!-- start single product item -->
                <li>
                  <figure>
                    <a class="aa-product-img" href="#">
                      <img src="img/women/girl-3.png" alt="polo shirt img"></a>
                    <a class="aa-add-card-btn"href="#">
                      <span class="fa fa-shopping-cart"></span>Add To Cart</a>
                     <figcaption>
                      <h4 class="aa-product-title">
                        <a href="#">Lorem ipsum doller</a></h4>
                      <span class="aa-product-price">$45.50</span>
                      <span class="aa-product-price"><del>$65.50</del></span>
                    </figcaption>
                  </figure>                     
                  <div class="aa-product-hvr-content">
                    <a href="#" data-toggle="tooltip" data-placement="top"
                     title="Add to Wishlist"><span class="fa fa-heart-o"></span></a>
                    <a href="#" data-toggle="tooltip" data-placement="top"
                     title="Compare"><span class="fa fa-exchange"></span></a>
                    <a href="#" data-toggle2="tooltip" data-placement="top"
                     title="Quick View" data-toggle="modal" 
                     data-target="#quick-view-modal">
                     <span class="fa fa-search"></span></a>
                  </div>
                </li>
                <!-- start single product item -->
                <li>
                  <figure>
                    <a class="aa-product-img" href="#"><
                      img src="img/man/polo-shirt-1.png" alt="polo shirt img"></a>
                    <a class="aa-add-card-btn"href="#">
                      <span class="fa fa-shopping-cart"></span>Add To Cart</a>
                    <figcaption>
                      <h4 class="aa-product-title">
                        <a href="#">Polo T-Shirt</a></h4>
                      <span class="aa-product-price">$45.50</span>
                      <span class="aa-product-price"><del>$65.50</del></span>
                    </figcaption>
                  </figure>                      
                  <div class="aa-product-hvr-content">
                    <a href="#" data-toggle="tooltip" 
                    data-placement="top" title="Add to Wishlist">
                    <span class="fa fa-heart-o"></span></a>
                    <a href="#" data-toggle="tooltip" 
                    data-placement="top" title="Compare">
                    <span class="fa fa-exchange"></span></a>
                    <a href="#" data-toggle2="tooltip" 
                    data-placement="top" title="Quick View" data-toggle="modal" 
                    data-target="#quick-view-modal"><span class="fa fa-search">
                    </span></a>
                  </div>
                </li>
                <!-- start single product item -->
                <li>
                  <figure>
                    <a class="aa-product-img" href="#">
                      <img src="img/women/girl-4.png" alt="polo shirt img"></a>
                    <a class="aa-add-card-btn"href="#">
                      <span class="fa fa-shopping-cart"></span>Add To Cart</a>
                    <figcaption>
                      <h4 class="aa-product-title">
                        <a href="#">Lorem ipsum doller</a></h4>
                      <span class="aa-product-price">$45.50</span>
                      <span class="aa-product-price"><del>$65.50</del></span>
                    </figcaption>
                  </figure>                     
                  <div class="aa-product-hvr-content">
                    <a href="#" data-toggle="tooltip" data-placement="top" 
                    title="Add to Wishlist"><span class="fa fa-heart-o"></span></a>
                    <a href="#" data-toggle="tooltip" data-placement="top" 
                    title="Compare"><span class="fa fa-exchange"></span></a>
                    <a href="#" data-toggle2="tooltip" data-placement="top"
                     title="Quick View" data-toggle="modal" 
                     data-target="#quick-view-modal">
                     <span class="fa fa-search"></span></a>
                  </div>
                  <!-- product badge -->
                  <span class="aa-badge aa-sold-out" href="#">Sold Out!</span>
                </li>    
                <!-- start single product item -->
                <li>
                  <figure>
                    <a class="aa-product-img" href="#">
                      <img src="img/man/polo-shirt-4.png" alt="polo shirt img"></a>
                    <a class="aa-add-card-btn"href="#">
                      <span class="fa fa-shopping-cart"></span>Add To Cart</a>
                     <figcaption>
                      <h4 class="aa-product-title"><a href="#">Polo T-Shirt</a></h4>
                      <span class="aa-product-price">$45.50</span>
                      <span class="aa-product-price"><del>$65.50</del></span>
                    </figcaption>
                  </figure>                     
                  <div class="aa-product-hvr-content">
                    <a href="#" data-toggle="tooltip" 
                    data-placement="top" title="Add to Wishlist">
                    <span class="fa fa-heart-o"></span></a>
                    <a href="#" data-toggle="tooltip" 
                    data-placement="top" title="Compare">
                    <span class="fa fa-exchange"></span></a>
                    <a href="#" data-toggle2="tooltip" 
                    data-placement="top" title="Quick View" data-toggle="modal"
                     data-target="#quick-view-modal">
                     <span class="fa fa-search"></span></a>
                  </div>
                  <!-- product badge -->
                  <span class="aa-badge aa-hot" href="#">HOT!</span>
                </li> 
                <!-- start single product item -->
                <li>
                  <figure>
                    <a class="aa-product-img" href="#">
                      <img src="img/women/girl-1.png" alt="polo shirt img"></a>
                    <a class="aa-add-card-btn"href="#">
                      <span class="fa fa-shopping-cart"></span>Add To Cart</a>
                     <figcaption>
                      <h4 class="aa-product-title"><a href="#">This is Title</a></h4>
                      <span class="aa-product-price">$45.50</span>
                      <span class="aa-product-price"><del>$65.50</del></span>
                    </figcaption>
                  </figure>                     
                  <div class="aa-product-hvr-content">
                    <a href="#" data-toggle="tooltip" 
                    data-placement="top" title="Add to Wishlist">
                    <span class="fa fa-heart-o"></span></a>
                    <a href="#" data-toggle="tooltip" 
                    data-placement="top" title="Compare">
                    <span class="fa fa-exchange"></span></a>
                    <a href="#" data-toggle2="tooltip" 
                    data-placement="top" title="Quick View" 
                    data-toggle="modal" data-target="#quick-view-modal">
                    <span class="fa fa-search"></span
                    ></a>                            
                  </div>
                  <!-- product badge -->
                  <span class="aa-badge aa-sale" href="#">SALE!</span></li>                                                                                   
              </ul>
            </div>  
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- / product category -->

<?php require 'footer.php';?>