<?php
require dirname(__DIR__).'/public/require/header.view.php';
?>
<div class="content" id="content">
    <section id="checkout" class="checkout">
        <div class="row">
            <div class="col-sm-12 col-xs-12 col-md-12 col-lg-12">
                <div class="title-checkout">
                    <span>Checkout</span>
                </div>
                <div class="box-content">

                    <div class="row">

                        <div class="col-sm-12 col-xs-4 col-md-4 col-lg-4">
                            <div class="billing-info">
                                <div class="title-box-info">Info of Client</div>
                                <form id="form-info-client" name='buy' method="POST" action="/buy/check">

                                    <?php
                                    if (isset($_SESSION['login'])) {
                                        $user = $_SESSION['login'];
                                        ?>
                                            <input type="text" name="name" value="<?php echo $user->username;?>" required >
                                        <input type="text" name="phone" value="<?php echo $user->phone;?>" disabled >
                                        <input type="email" name="email" value="<?php echo $user->email;?>" disabled >
                                        <textarea name="address" disabled="Address" disabled ><?php echo $user->address;?></textarea>
                                        <textarea name="note" placeholder="Note" ></textarea> 
                                        <?php }
                                        else
                                         { ?>
                                        <input type="text" name="name" value="" placeholder="Name"  required >
                                        <input type="text" name="phone" value="" placeholder="Phone" required >
                                        <input type="email" name="email" value ="" placeholder="Email" required >
                                        <textarea name="address" placeholder="Address" required ></textarea>
                                        <textarea name="note" placeholder="Note" ></textarea>
                                        <?php } ?>
                                        
                                    </div>
                                </div>
                                
                                <span style="color: red">
                                    <?php
                                    if (isset($_SESSION['msg'])) {
                                        echo $_SESSION['msg'];
                                        unset($_SESSION['msg']);
                                    }
                                    ?>                                               
                                </span>

                                <div class="col-sm-12 col-xs-2 col-md-2 col-lg-2">
                                    <div class="payments">
                                        <div class="title-box-payments">Payments</div>

                                        <?php foreach ($arrPayments as $item) {
                                         ?>
                                         <div class="visa">
                                             <input type="radio" name="payments" value="<?php echo $item->id; ?>">
                                             <label for="visa"><?php echo $item->name; ?></label>
                                         </div>
                                         <?php
                                     } ?>
                                 </div>
                             </div>
                             <div class="col-sm-12 col-xs-6 col-md-6 col-lg-6">
                                <div class="summary-order">
                                    <div class="title-box-summary">Summary</div>
                                    <div class="content-summary">
                                        <ul>
                                            <li>
                                                <div class="row">
                                                    <div class="col-sm-2 col-xs-2 col-md-2 col-lg-2">
                                                        Name
                                                    </div>
                                                    <div class="col-sm-2 col-xs-2 col-md-2 col-lg-2">
                                                        Size
                                                    </div>
                                                    <div class="col-sm-2 col-xs-2 col-md-2 col-lg-2">
                                                     Color
                                                 </div>
                                                 <div class="col-sm-2 col-xs-2 col-md-2 col-lg-2">
                                                    Quantity
                                                </div>
                                                <div class="col-sm-2 col-xs-2 col-md-2 col-lg-2">
                                                    Price
                                                </div>
                                            </div>
                                        </li>

                                        <?php
                                        if (isset($arrStore)) {
                                            $totalPrice =0;
                                            foreach ($arrStore as $key => $value) {

                                                foreach ($_SESSION['cart'] as $k => $val) {
                                                    if ($k ==$key) {
                                                     $numCart =$val;
                                                     $totalPrice += $val* $value->price;
                                                 }
                                             }

                                             ?>
                                             <li>
                                                <div class=" row">
                                                    <div class="col-sm-2 col-xs-2 col-md-2 col-lg-2">
                                                        <?php echo $value->namesp?>
                                                    </div>
                                                    <div class="col-sm-2 col-xs-2 col-md-2 col-lg-2">
                                                        <?php echo $value->size?>
                                                    </div>
                                                    <div class="col-sm-2 col-xs-2 col-md-2 col-lg-2">
                                                        <?php echo $value->color?>
                                                    </div>
                                                    <div class="col-sm-2 col-xs-2 col-md-2 col-lg-2">
                                                        <?php echo $numCart?>
                                                    </div>
                                                    <div class="col-sm-2 col-xs-2 col-md-2 col-lg-2">
                                                        <?php echo ($numCart * $value->price)?>
                                                    </div>
                                                </div>
                                            </li>

                                            <?php
                                        }
                                    }
                                    ?>
                                    <li>
                                        <div class="row">
                                            <div class="col-sm-8 col-xs-8 col-md-8 col-lg-8">
                                                Totals :
                                            </div>
                                            <div class="col-sm-4 col-xs-4 col-md-4 col-lg-4">
                                                <div class="total-cost"><?php echo $totalPrice?></div>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="row">
                                            <div class="col-sm-12 col-xs-12 col-md-12 col-lg-12">
                                                <button type='submit' name ='smBuy' class="submit">Submit</button>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</section>
    <?php
    require dirname(__DIR__).'/public/require/login-register.view.php';
    ?>
</div>
<script type="text/javascript" src="/public/assets/js/appDetail.js"></script>
<?php
require dirname(__DIR__).'/public/require/footer.view.php';
?>
