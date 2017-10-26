<?php
namespace app\controllers;
use core\App;
use core\Session;
use app\models\Products_info;
use app\models\Products;
use app\models\Sizes;
use app\models\Category;
use app\models\Payment;
use app\models\Order_details;
use app\models\Users;
use app\models\Orders;
use core\Pagination;
class PublicController
{
  public function addRegister()
  {
    $username=$_POST['username'];
    $fullname=$_POST['fullname'];
    $email=$_POST['email'];
    $password=$_POST['password'];
    $gender=$_POST['gender'];    
    
    $paremeters = array(
      'username' => $username, 
      'fullname' => $fullname, 
      'email' => $email, 
      'password' => md5($password), 
      'gender' => $gender,
      'level' => 3
      );
    if(Users::insert($paremeters)){
      echo 1;
    }

  }
  public function postLogin()
  {
    $username=$_POST['username'];
    $password=$_POST['password'];
    $user=Users::checkPublicLogin($username,$password);
    if($user!=null){
      $_SESSION['login'] =$user[0];
      echo 1;
    }else{
      echo 2;
    }

  }
  public function postLogout()
  {
    if(isset($_SESSION['login'])){
      unset($_SESSION['login']);
    }
    return redirect('');

  }
  public function getAjaxProducts($products_info, $paging_html) {
    $result = "<div class='box-title'>Featutes</div>";    
    foreach($products_info as $item)  {
      $result .= "<div class='product'>
      <div class='cover-img'>
        <a href='detail/$item->id'>
          <img src='/public/upload/product_info/$item->image' alt=''>
        </a>
      </div>
      <span class='name'>$item->name</span>
      <span class='price'>".number_format($item->price)." VND</span>
    </div>";
  } 
  $result .= "<div class='row'>
  <div class='col-lg-12'>
    <div class='cover-pagination'>$paging_html</div>
  </div>
</div>
</div>";
return $result;
} 
public function index(){
  if(isset($_SESSION['msg'])) {
    echo "<script type='text/javascript'>alert('".$_SESSION['msg']."'); </script>";
    unset($_SESSION['msg']);
  }
  $limit = 12;
  $count = Products_info::count();
  $all_pages = $count[0]->total_record;
  $paging = new Pagination();      
  if(!isset($_GET['page'])) {
    $current_page = 1;
    $paging->init("","", $current_page, $limit,$all_pages);
    $products_info = Products_info::allPagination($current_page,$limit);
    $cats = Category::find('gender',1);
    $hot_product = Products_info::getHotProduct();
    $gender_men_cats=Category::find('gender',1);
    $gender_women_cats=Category::find('gender',0);
    return view('public/index',['products_info' => $products_info,
      'cats' => $cats, 
      'hot_product' => $hot_product,
      'gender_men_cats'=>$gender_men_cats,
      'gender_women_cats'=>$gender_women_cats,
      'paging'=>$paging->ajaxhtml()]); 
  } else {
    $current_page = $_GET['page'];
    $products_info = Products_info::allPagination($current_page,$limit);
    $paging->init("","", $current_page, $limit,$all_pages);
    echo $this->getAjaxProducts($products_info, $paging->ajaxhtml());
  }

}


public function detail($product_info_id)  {  

 
   if (empty($productInfo)) {
            return view('error');
        } else {
      $view = 'view-'.$product_info_id;
        if(!isset($_COOKIE['"'.$view.'"']) ) {
          if (Products_info::updateView($product_info_id)) {
            setcookie('"'.$view.'"',$product_info_id, time() + 300);
          }
     }
         return view('public/detail',['size' =>$size,'color'=>$color,'productInfo'=>$productInfo,
        'gender_men_cats'=>$gender_men_cats,
        'gender_women_cats'=>$gender_women_cats]);
    }

  $color = Products::getColor($product_info_id);
  $size = Products::getSize($product_info_id);
  $productInfo = Products_info::find('id',$product_info_id);
  $gender_men_cats=Category::find('gender',1);
  $gender_women_cats=Category::find('gender',0);
  return view('public/detail',['size' =>$size,'color'=>$color,'productInfo'=>$productInfo,
    'gender_men_cats'=>$gender_men_cats,
    'gender_women_cats'=>$gender_women_cats]);

}

public function PlusNumber()
{
  $currentNumber = isset($_POST['aNumber']) ? $_POST['aNumber'] : ' ' ;
  $newNumber = 1+$currentNumber;
  echo  '<input class="num" type="text" value="'.$newNumber.'" id="num" disabled >' ;
}
public function SubNumber()
{
  $currentNumber = isset($_POST['aNumber']) ? $_POST['aNumber'] : ' ' ;
  $newNumber = $currentNumber-1;
  echo  '<input class="num" type="text" value="'.$newNumber.'" id="num" disabled >' ;
}
public function updateCart()
{
  if ( Session::getSession('cart') !=null) {
    $arrCart = Session::getSession('cart');        
    $cout =0;
    $arr1 = isset($_GET['aJson']) ? json_decode($_GET['aJson']) : ' ' ;
    foreach ($arr1 as $key => $value) {               
      $products = Products::find('id',$key);
      $quantity = $products[0]->quantity;
      if( $value<=$quantity AND $value >0) {
        $arrCart[$key] =$value;
      }
    }
    Session::createSession('cart',$arrCart);
    foreach ($arrCart as $key => $value) {
      $cout +=$value;
    }
    $arrCart['quantity'] = $cout;
    Session::createSession('num',$cout);
    die(json_encode($arrCart));    
  }                
}

public function cart()
{         
  $arrStore= array();
  $gender_men_cats=Category::find('gender',1);
  $gender_women_cats=Category::find('gender',0);
  if ( Session::getSession('cart') !=null) {
    foreach (Session::getSession('cart') as $key => $value) {
      $arrStore[$key]= Products::getAllCart($key)[0];              
    }
    return view('public/cart',['arrStore'=>$arrStore,'gender_men_cats'=>$gender_men_cats,'gender_women_cats'=>$gender_women_cats]);
  }else{
    return view('public/cart',['gender_men_cats'=>$gender_men_cats,'gender_women_cats'=>$gender_women_cats]);
  }
}
public function cat($id)
{
  $limit = 12;
  $paging = new Pagination(); 
  $products_info = Products_info::getProductInfoByCat($id, 0, 0);
  $all_pages = count($products_info);
  if(!isset($_GET['page'])) {
    $current_page = 1;
    $paging->init("cat/$id","", $current_page, $limit,$all_pages);
    $products_info = Products_info::getProductInfoByCat($id, $current_page, $limit);
    $gender_men_cats=Category::find('gender',1);
    $gender_women_cats=Category::find('gender',0);
    $hot_product = Products_info::getHotProduct();
    $cat = Category::find('id',$id);
    $cats = Category::find('gender',1);
    
    return view('public/index',['products_info'=>$products_info,'gender_men_cats'=>$gender_men_cats,
      'gender_women_cats'=>$gender_women_cats, 'cat' => $cat,
      'cats' => $cats, 'hot_product'=>$hot_product, 'paging'=>$paging->ajaxhtml()]);
  } else {
    $current_page = $_GET['page'];
    $products_info = Products_info::getProductInfoByCat($id,$current_page,$limit);
    $paging->init("cat/$id","", $current_page, $limit,$all_pages);
    echo $this->getAjaxProducts($products_info, $paging->ajaxhtml());
  }
}
public function delete($id)
{   
  $num=0;
  $arr = Session::getSession('cart');
  if ( Session::getSession('cart')[$id] !=null) {
    foreach ($arr as $key => $value) {
      if($id == $key) {
        unset( $arr[$id]);
      }
    } 
    Session::createSession('cart',$arr);
    foreach ( $arr as $key => $value) {
      $num +=$value;
    }
    Session::createSession('num',$num);
    redirect('cart');
  }
}
public function addCart()
{           
  $check = 0;
  $size = isset($_POST['aSize']) ? $_POST['aSize'] : 0 ;
  $color = isset($_POST['aColor']) ? $_POST['aColor'] : 0 ;
  $products_info_id = isset($_POST['aProduct_info_id']) ? $_POST['aProduct_info_id'] : 0 ;
  $num = isset($_POST['aNum']) ? $_POST['aNum'] : 0 ;
  $products = Products::getProduct($products_info_id,$size,$color);           
  if (empty($products)) {
    die(json_encode($check));
  } else { 
    if ($num<1) {
      $arr["check"] =0;
      die(json_encode($arr));
    } else {
      $arr = array();                             
      if ( Session::getSession('cart') ==null) {  
        if ($products[0]->quantity<$num) {
          $arr["check"] =2;
          $arr["quantity"] =$products[0]->quantity;
          die(json_encode($arr));
        } else {
          $_SESSION['cart'] =array($products[0]->id =>$num);
          $arr["quantity"] =$num;
          $arr["check"] =1;
          Session::createSession('num',$num);                           
          die(json_encode($arr));                                                          
        }
      } else {                          
        $cart=Session::getSession('cart');
        $coutCart =0;
        $id =$products[0]->id;
        if (isset($cart[$id])) {
          $currentNum =Session::getSession('cart')[$id];
          $newNum = $currentNum + $num;
          if ($products[0]->quantity < $newNum ) {
           $arr["check"] =2;
           $order=$products[0]->quantity-$currentNum;
           $arr["quantity"] =$order;
           die(json_encode($arr));                                      
         } else {
           $cart[$id] = $newNum;
           Session::createSession('cart',$cart);
         }                                 
       } else {
         if ($products[0]->quantity < $num) {                          
          $arr["check"] =2;
          $arr["quantity"] =$products[0]->quantity;
          die(json_encode($arr));
        } else {
          $cart[$id]=$num;
          Session::createSession('cart',$cart);
        } 
      }                                   
      foreach ( $cart as $key => $value) {
        $coutCart += $value;
      }
      Session::createSession('num',$coutCart);
      $arr["check"] =1;
      $arr["quantity"] =$coutCart;
      die(json_encode($arr));
    }
  }
}    
}
public function buy()
{
  $arrPayments = Payment::all(); 
  $arrStore= array();
  $gender_men_cats=Category::find('gender',1);
  $gender_women_cats=Category::find('gender',0);
  if ( Session::getSession('cart') !=null) {
    foreach (Session::getSession('cart') as $key => $value) {
     $arrStore[$key]= Products::getAllCart($key)[0];              
   }
   return view('public/buy',['arrStore'=>$arrStore,'gender_men_cats'=>$gender_men_cats,'gender_women_cats'=>$gender_women_cats,'arrPayments'=>$arrPayments]);
 }else{
  return redirect('home');
}
}
public function check() {
  if (isset($_POST['smBuy'])) {
        //check stock
   $arrProductsExist= array();
   $checkStock=true;
   if ( Session::getSession('cart') !=null) {
    foreach (Session::getSession('cart') as $key => $value) {
     if (Products::getAllCart($key)[0]->quantity < $value) {
      $checkStock=false;
      break;
    }              
  }
  if (!$checkStock) {
        //stock is unavailble
    Session::createSession('msg','Sorry! Quantity have recently updated. Some product you bought is unavailable !') ;
    redirect('buy');
    die();
  } else {
        //stock is availble
   if (isset($_POST['payments'])) {
    $fullname = trim($_POST['name']);
    $phone = trim($_POST['phone']);
    $email = trim($_POST['email']);
    $address = trim($_POST['address']);
    $payment = $_POST['payments'];
    $note = $_POST['note'];
    $idUser = 0;
    if (isset($_SESSION['login'])) {
     $idUser = $_SESSION['login']->id;
   } else {
    //empty
     if ($fullname =='' || $phone =='' ||  $email =='' ||  $address=='') {
      Session::createSession('msg','Please complete all information !') ;
      redirect('buy');
      die();
    } else {
            //valid 
      $checkPhone =  '/^[0-9]{10,11}$/';
      if (!preg_match($checkPhone, $phone,$match)) {
        Session::createSession('msg','please enter a valid phone !') ;
        redirect('buy');
        die();
      } else {
            //add san pham
        $arrInfoClient=array(
          'username' => '',
          'password' => '',
          'fullname' => $fullname,
          'phone' => $phone,
          'email' => $email,
          'address' => $address,
          'level' => 3,
          );
        if (Users::insert($arrInfoClient)) {
          $UserNew=Users::getIdLast();
          $idUser=$UserNew[0]->id;
        }
      }
    }
  }
  $arrOrder = array(
    'user_id' =>$idUser,
    'date_order' => date('Y-m-d H:m:s',time()),
    'payment_id' => $payment,
    'note' => $note,
    'paid' => ($payment==3) ? 0 : 1,
    );
  if (Orders::insert($arrOrder)) {
    $OrderNew=Orders::getIdLast();
    $idOrder=$OrderNew[0]->id;
    foreach (Session::getSession('cart') as $key => $value) {
      $arrDetail=array(
        'order_id' => $idOrder,
        'product_id' => $key,
        'quantity' => $value,
        );     
      if (Order_details::insert($arrDetail)) {
        if (Products::updateQuantityProduct($key,$value)) {
          continue;
        } else {
          break;
        }
      } else {
        break;
      }
    }
    unset($_SESSION['cart']);
    unset($_SESSION['num']);
    Session::createSession('msg','Thank you for your order!') ;
    redirect('buy');
    die();
  }
}  else {
  Session::createSession('msg','Please choose payment !') ;
  redirect('buy');
  die();
}
}
}
}
}
public function getProductInfoByGender()
{
  $string_gender=trim(parse_url($_SERVER['REQUEST_URI'],PHP_URL_PATH),'/');
  if($string_gender=='men'){
    $id=1;
  }else{
    $id=0;
  }
  $products_info=Category::getProductInfoByGender($id);
  $hot_product=Products_info::getHotProduct();
  $gender_men_cats=Category::find('gender',1);
  $gender_women_cats=Category::find('gender',0);
  return view('public/index',['products_info'=>$products_info,'hot_product'=>$hot_product,
    'gender_men_cats'=>$gender_men_cats,
    'gender_women_cats'=>$gender_women_cats]);
}
public function relatedProducts($id_cat,$id_products_info) {
  $products_info=Products_info::relatedProducts($id_cat,$id_products_info);
  $cats = Category::all();
  $sizes = Sizes::all();
  $hot_product = Products_info::getHotProduct();
  $gender_men_cats=Category::find('gender',1);
  $gender_women_cats=Category::find('gender',0);
  return view('public/index',['products_info' => $products_info,
    'cats' => $cats, 'sizes' => $sizes, 
    'hot_product' => $hot_product,'gender_men_cats'=>$gender_men_cats,'gender_women_cats'=>$gender_women_cats]); 
}
 
  public function getCat() {
            $gender = isset($_POST['gender']) ? $_POST['gender'] : 0;
            $cats = Category::find('gender',$gender);
            $html .= '<option value="-1">----All Kinds----</option>';
            foreach($cats as $item) {
                $html .= '<option value="'.$item->id.'">'.$item->name.'</option>';
            }
            echo $html;
        }
  public function searchProduct() {
      if(isset($_GET['gender']) || isset($_GET['style']) || isset($_GET['price'])) {
          $style = $_GET['style'];
          $price = $_GET['price'];
          $gender = $_GET['gender'];
          $current_page = !empty($_GET['page'])? $_GET['page'] : 1;
          $ArrProducts = Products_info::getProductsSearch(0,0,$style, $price, $gender);
          $count = count($ArrProducts);
          $limit = 12;
          $products_info = Products_info::getProductsSearch($current_page,$limit, $style, $price, $gender);
          $paging = new Pagination();
          $paging->init("search","",$current_page, $limit, $count);
          echo 
          '<div class="box-title">Featutes</div>';    
              foreach($products_info as $item)  {
          echo '<div class="product">
              <div class="cover-img">
                  <a href="detail/'.$item->id.'">
                      <img src="/public/upload/product_info/'.$item->image.'" alt="">
                  </a>
              </div>
              <span class="name">'.$item->name.'</span>
              <span class="price">'.number_format($item->price).' VND</span>
          </div>';
                } 
          echo '<div class="row">
              <div class="col-lg-12">
                  <div class="cover-pagination">
                      '.$paging->ajaxhtml().'
                  </div>
              </div>
          </div>
      </div>';
      }
  }
}

?>
