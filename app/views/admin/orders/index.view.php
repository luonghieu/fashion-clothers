<?php

require dirname(__DIR__).'/require/header.view.php';
?>

<div class="main-container ace-save-state" id="main-container">
  <script type="text/javascript">
    try{ace.settings.loadState('main-container')}catch(e){}
  </script>
  <?php 
  require dirname(__DIR__).'/require/leftbar.view.php';
  ?>
  <div class="main-content">
    <div class="main-content-inner">
      <div class="breadcrumbs ace-save-state" id="breadcrumbs">
        <ul class="breadcrumb">
          <li>
            <i class="ace-icon fa fa-home home-icon"></i>
            <a href="">Home</a>
          </li>
          <li class="active">Dashboard</li>
        </ul><!-- /.breadcrumb -->

      </div>

      <div class="page-content">
        <div class="ace-settings-container" id="ace-settings-container">
          <div class="btn btn-app btn-xs btn-warning ace-settings-btn" id="ace-settings-btn">
            <i class="ace-icon fa fa-cog bigger-130"></i>
          </div>

          <div class="ace-settings-box clearfix" id="ace-settings-box">
            <div class="pull-left width-50">
              <div class="ace-settings-item">
                <div class="pull-left">
                  <select id="skin-colorpicker" class="hide">
                    <option data-skin="no-skin" value="#438EB9">#438EB9</option>
                    <option data-skin="skin-1" value="#222A2D">#222A2D</option>
                    <option data-skin="skin-2" value="#C6487E">#C6487E</option>
                    <option data-skin="skin-3" value="#D0D0D0">#D0D0D0</option>
                  </select>
                </div>
                <span>&nbsp; Choose Skin</span>
              </div>

              

              <div class="ace-settings-item">
                <input type="checkbox" class="ace ace-checkbox-2 ace-save-state" id="ace-settings-add-container" autocomplete="off" />
                <label class="lbl" for="ace-settings-add-container">
                  Inside
                  <b>.container</b>
                </label>
              </div>
            </div><!-- /.pull-left -->

            <div class="pull-left width-50">

              <div class="ace-settings-item">
                <div class="pull-left">
                  <select id="skin-colorpicker" class="hide">
                    <option data-skin="no-skin" value="#438EB9">#438EB9</option>
                    <option data-skin="skin-1" value="#222A2D">#222A2D</option>
                    <option data-skin="skin-2" value="#C6487E">#C6487E</option>
                    <option data-skin="skin-3" value="#D0D0D0">#D0D0D0</option>
                  </select>
                </div>
                <span>&nbsp; Choose Skin</span>
              </div>
              <div class="ace-settings-item">
                <input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-compact" autocomplete="off" />
                <label class="lbl" for="ace-settings-compact"> Compact Sidebar</label>
              </div>

              <div class="ace-settings-item">
                <input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-highlight" autocomplete="off" />
                <label class="lbl" for="ace-settings-highlight"> Alt. Active Item</label>
              </div>
            </div><!-- /.pull-left -->
          </div><!-- /.ace-settings-box -->
        </div><!-- /.ace-settings-container -->

        <div class="page-header">
          <h1 style="font-weight: bold">
            Orders
          </h1>
        </div><!-- /.page-header -->

        <div class="row">
          <div class="col-xs-12">
            <!-- PAGE CONTENT BEGINS -->
            <div class="row">
              <div class="col-xs-12">
                <?php 
                if(isset($_SESSION['msg'])){
                  ?>
                  <div class="alert alert-success" role="alert">
                    <strong>
                      <?php 
                      echo $_SESSION['msg']; 
                      unset($_SESSION['msg']);
                      ?>        
                    </strong> 
                  </div>
                  <?php } ?>

                  <div class="row text-center">
                    <div class="col-xs-12">
                      <!-- PAGE CONTENT BEGINS -->
                      <form class="form-horizontal" id="search-orders" role="form" action="/admin/orders/search" method="post">
                        <?php
                        $search_key = array(
                          'fullname'  => '',
                          'paid'      => -1,
                          'shipped'   => -1,
                          'payment_id'   => -1,
                          'status'    => -1,
                          'date_order'=> ''
                          );
                        if(isset($search_Order))
                        {
                          foreach(array_keys($search_Order) as $key) {
                            $search_key[$key] = $search_Order[$key];
                          }
                        }
                        ?>
                        <div class="row">
                          <div class="col-xs-2">
                          </div>
                          <div class="col-xs-2" style="margin-left: 30px">
                          </div>
                          <div class="col-sm-1" style="margin-left: 30px">
                            Status
                          </div>
                          <div class="col-xs-1" style="margin-left: 30px">
                            Paid
                          </div>
                          <div class="col-xs-1" style="margin-left: 20px">
                            Shipped
                          </div>
                          <div class="col-sm-1" style="margin-left: 40px">
                            Payment
                          </div>
                        </div>

                        <div class="row">
                          <div class="col-xs-2">
                           <div class="form-group">
                             <div class="pos-rel">
                              <input class="typeahead scrollable" name="fullname" type="text" value="<?=$search_key['fullname']?>" placeholder="Fullname" />
                            </div>
                          </div>
                        </div>
                        <div class="col-xs-2" style="margin-left: 40px">
                         <div class="form-group">
                           <div class="pos-rel">
                             <input name="date_order" type="date" value="<?=$search_key['date_order']?>" id="date_order"/>
                           </div>
                         </div>
                       </div>
                       <div class="col-xs-1" style="margin-left: 40px">
                         <div class="form-group">
                           <select id="status" name="status" class="multiselect">
                             <option <?=$search_key['status'] == -1 ? 'selected="selected"':''?> value="-1">--Status--</option>
                             <option <?=$search_key['status'] == 0 ? 'selected="selected"':''?> value="0">Confirmed</option>
                             <option <?=$search_key['status'] == 1 ? 'selected="selected"':''?> value="1">Pending</option>
                             <option <?=$search_key['status'] == 2 ? 'selected="selected"':''?> value="3">Cancel</option>
                           </select>
                         </div>
                       </div>
                       <div class="col-xs-1" style="margin-left: 30px">
                         <div class="form-group">
                           <select id="paid" name="paid" class="multiselect">
                            <option <?=$search_key['paid'] == -1 ? 'selected="selected"':''?> value="-1">--paid--</option>
                            <option <?=$search_key['paid'] == 1 ? 'selected="selected"':''?> value="1">Yes</option>
                            <option <?=$search_key['paid'] == 0 ? 'selected="selected"':''?> value="0">No</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-sm-1" style="margin-left: 20px">
                       <div class="form-group">
                         <select id="shipped" name="shipped" class="multiselect" >
                          <option <?=$search_key['shipped'] == -1 ? 'selected="selected"':''?> value="-1">--shipped--</option>
                          <option <?=$search_key['shipped'] == 1 ? 'selected="selected"':''?> value="1">Yes</option>
                          <option <?=$search_key['shipped'] == 0 ? 'selected="selected"':''?> value="0">No</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-sm-1" style="margin-left: 40px">
                     <div class="form-group">
                       <select id="payment" name="payment" class="multiselect" >
                        <option <?= $search_key['payment_id'] == -1 ? 'selected="selected"':''?> value="-1">--payment--</option>
                        <?php
                        foreach ($payments as $item) {
                          ?>
                          <option <?php if($search_key['payment_id']==$item->id) echo 'selected="selected"';?> value="<?php echo $item->id;?>"><?php echo $item->name;?></option>
                          <?php
                        }
                        ?>
                      </select>
                    </div>
                  </div>
                  <div class="col-xs-2" style="margin-left: 10px">
                    <div class="form-group">
                      <button class="btn btn-success  fa fa-plus-square fa-lg" type="submit" name="search">Search</button>
                    </div>
                  </div>
                </div>
              </form>
              <!-- PAGE CONTENT ENDS -->
            </div><!-- /.col -->
          </div>
          <form action="/admin/orders/destroyAll" method="post">
            <table id="simple-table" class="table  table-bordered table-hover">
              <thead>
                <tr>
                  <th class="text-center">
                    Id
                  </th>
                  <th class="text-center">
                    Username
                  </th>
                  <th class="text-center">
                    Fullname
                  </th>
                  <th class="text-center">
                    Address
                  </th>
                  <th class="text-center">
                    Order date
                  </th>
                  <th class="text-center">
                    Status
                  </th>
                  <th class="text-center">
                    Paid
                  </th>
                  <th class="text-center">
                    Shipped
                  </th>
                  <th class="text-center">
                    Payment
                  </th>
                  <th class="text-center">
                    Note
                  </th>
                  <th class="text-center">
                    Detail
                  </th>
                  <th class="text-center">
                    Action
                  </th>
                  <th class="text-center">
                    Delete all
                    <input type="checkbox" name="checkall" id="checkall" value="" />
                    <button class="btn btn-success  fa fa-plus-square fa-lg" type="submit" name="delete" id="delAll">Delete</button>
                  </th>
                </tr>
              </thead>

              <tbody>
                <?php 
                if(!empty($orders))
                { 
                  foreach($orders as $item){
                    $id=$item->id_order;
                    $username=$item->username;
                    $fullname=$item->fullname;
                    $address=$item->address;
                    $date_order=$item->date_order;
                    $status=$item->status;
                    $paid=$item->paid;
                    $shipped=$item->shipped;
                    $payment=$item->name;
                    $note=$item->note;
                    ?>
                    <tr>
                      <td class="text-center">
                        <?php echo $id;?>
                      </td>
                      <td class="text-center">
                        <?php 
                        if(!empty($username)) echo $username;
                        else echo 'Khach vang lai';
                        ?>
                      </td>
                      <td class="text-center">
                        <?php echo $fullname;?>
                      </td>
                      <td class="text-center">
                        <?php echo $address;?>
                      </td>
                      <td class="text-center">
                        <?php echo date("d/m/Y H:i:s", strtotime($date_order));?>
                      </td>
                      <td class="text-center">
                       <select id="status-<?php echo $id ?>" <?php if($_SESSION['user'][0]->level!=1) echo "disabled";?> name="status" class="multiselect status">
                         <option <?php if($status==0) echo 'selected="selected"';?> value="0">Confirmed</option>
                         <option <?php if($status==1) echo 'selected="selected"';?> value="1">Pending</option>
                         <option <?php if($status==2) echo 'selected="selected"';?> value="2">Cancel</option>
                       </select>
                     </td>
                     <td class="text-center">
                       <?php 
                       if($_SESSION['user'][0]->level!=1){
                        ?>
                        <img src="/public/admin/assets/images/<?php 
                        if($paid==1){
                          echo "active.gif";
                        }else{
                          echo "deactive.gif";
                        }
                        ?>" alt="">
                        <?php
                      } else {
                        ?>
                        <a href="javascript:void(0)"  class="edit_paid_active" id="paid-<?php echo $id; ?>">
                          <img src="/public/admin/assets/images/<?php 
                          if($paid==1){
                            echo "active.gif";
                          }else{
                            echo "deactive.gif";
                          }
                          ?>" alt="">
                        </a>
                        <?php
                      }
                      ?>
                    </td>
                    <td class="text-center">
                     <?php 
                     if($_SESSION['user'][0]->level!=1){
                      ?>
                      <img src="/public/admin/assets/images/<?php 
                      if($shipped==1){
                        echo "active.gif";
                      }else{
                        echo "deactive.gif";
                      }
                      ?>" alt="">
                      <?php
                    } else {
                      ?>
                      <a href="javascript:void(0)"  class="edit_shipped_active" id="shipped-<?php echo $id; ?>">
                        <img src="/public/admin/assets/images/<?php 
                        if($shipped==1){
                          echo "active.gif";
                        }else{
                          echo "deactive.gif";
                        }
                        ?>" alt="">
                      </a>
                      <?php
                    }
                    ?>
                  </td>
                  <td class="text-center">
                   <?php echo $payment?>
                 </td>
                 <td class="text-center">
                  <?php echo $note;?>
                </td>
                <td class="text-center">
                  <a href="/admin/orders/detail/<?php echo $id;?>" alt="">Details</a>
                </td>
                
                <td class="text-center">
                  <div class="hidden-sm hidden-xs btn-group">
                    <a class="btn btn-xs btn-danger" onclick="return confirm('Are you sure to delete ? ');" href="/admin/orders/delete/<?php echo $id; ?>">
                      <i class="ace-icon fa fa-trash-o bigger-120"></i>
                    </a>
                  </div>
                </td>
                <td class="text-center">
                  <input type="checkbox" name="dels[]" value="<?php echo $id;?>" />
                </td>
              </tr>
              <?php 
            }
          }else{
            ?>
            <tr>
              <td class="text-center" colspan="13">No data</td>
            </tr>
            <?php 
          }
          ?>                      
        </tbody>
      </table>
    </form>
  </div>
</div><!-- /.row -->

<div class="row text-center cover-pagination">
  <?php 
  if(isset($paging)) {
    echo $paging;
  }
  ?>
</div>
<!-- PAGE CONTENT ENDS -->

</div><!-- /.row -->
</div><!-- /.page-content -->
</div>
</div><!-- /.main-content -->
</div>
</div>
<?php 
require dirname(__DIR__).'/require/footer.view.php';
?>
