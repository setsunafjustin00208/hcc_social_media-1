<?php

$loginVerification = $this->session->userdata('logged_in');
$loginVerificationuser = $this->session->userdata('user_type');

if (!$loginVerification) {
    redirect("main/index");

}
elseif (($loginVerificationuser) != "ADMIN") {
    redirect("main/user_page");

}



?>

<!DOCTYPE html>
<html>
<head>
        <title> ACTIVATION </title>
        <link href = "<?=base_url()?>bootstrap/css/basictable.css" rel ="stylesheet" type = "text/css">
        <link href = "<?=base_url()?>bootstrap/css/bootstrap.css" rel ="stylesheet" type = "text/css">
        <link href = "<?=base_url()?>bootstrap/css/examples.css" rel ="stylesheet" type = "text/css">
        <link href = "<?=base_url()?>bootstrap/css/font-awesome.css" rel ="stylesheet" type = "text/css">
        <link href = "<?=base_url()?>bootstrap/css/font.css" rel ="stylesheet" type = "text/css">
        <link href = "<?=base_url()?>bootstrap/css/ladda.min.css" rel ="stylesheet" type = "text/css">
        <link href = "<?=base_url()?>bootstrap/css/lsb.css" rel ="stylesheet" type = "text/css">
        <link href = "<?=base_url()?>bootstrap/css/monthly.css" rel ="stylesheet" type = "text/css">
        <link href = "<?=base_url()?>bootstrap/css/morris.css" rel ="stylesheet" type = "text/css">
        <link href = "<?=base_url()?>bootstrap/css/style.css" rel ="stylesheet" type = "text/css">
        <link href = "<?=base_url()?>bootstrap/css/table-style.css" rel ="stylesheet" type = "text/css">
        <link href = "<?=base_url()?>bootstrap/css/typo.css" rel ="stylesheet" type = "text/css">

        <script type = "text/javascript" src = "<?=base_url()?>bootstrap/js/jquery.min.js"></script>
        <script type = "text/javascript" src = "<?=base_url()?>bootstrap/js/bootstrap.js"></script>

        <script type = "text/javascript">
            function message(){
                alert("Account Status Changed");
            }
            function deleteRecord(){
                alert("Request Successfully Deleted");
            }
        </script>

    <meta name = "viewport" content = "width=device-width, initial=1">
    <script type = "text/javascript" src = "<?=base_url()?>bootstrap/js/jquery2.0.3.min.js"></script>
    <script type = "text/javascript" src = "<?=base_url()?>bootstrap/js/modernizr.js"></script>
    <script type = "text/javascript" src = "<?=base_url()?>bootstrap/js/jquery.cookie.js"></script>
    <script type = "text/javascript" src = "<?=base_url()?>bootstrap/js/screenfull.js"></script>

    <script type ="text/javascript">
        $(function (){
            $('#supported').text('supported/allowed: ' +!!screenfull.enabled);

            if(!screenfull.enabled){
                return false;
            }

            $('#toggle').click(function(){
                screenfull.toggle($('#container')[0]);


            });

            return 0;
        });
    </script>

    <style type="text/css">
    .admin_container{
    padding-left: 8%;
    }
     .img-logo-smol{
        width: 55px ;
        height: 55px; 
        margin-bottom: 75px;
    }
    .headeradmin{
        margin-top: 5px;
        margin-bottom 0px;
    }
     .sec{
        position: relative;
        right: -1px;
        top:-22px;
    }

    .counter-lg {
        top: -24px !important;
    }
    .font-badge{
        font-family: sans-serif; !important

    }
    .text-area-roa{
      width: 50%;
      height: 150px;
      background-color: white;
      border-style: solid;
      border-radius: 5px;
      border-width: 2px;
      padding-top: 20px;
    }
    .button-left{
    padding-left: 10px;
    height: 42px;
  }
    </style>


</head>
<body class = "dashboard-page">
    <script type = "text/javascript">
        var theme=$.cookie('protonTheme') || 'default';
        $('body').removeClass (function(index,css){
                return(css.match (/\btheme-\S+/g)|| []).join('');
        });
        if(theme !== 'default') $('body').addClass(theme);

    </script>

    <nav class = "main-menu">
        <ul>
            <li>
                <a href = "<?=site_url('main/dashboard')?>">
                    <i class = "fa fa-home nav_icon"></i>
                    <span class = "nav-text">Dashboard</span>
                </a>
            </li>
            <li class = "has-subnav">
                <a href = "<?=site_url('main/statistics')?>">
                <i class = "fa fa-list-ul nav_icon"></i>
                <span class ="nav-text">Statistics</span>
                </a>
            </li>

            <li class = "has-subnav">
                <?php 
                $countactivation=$this->db->query("SELECT COUNT(*) as count FROM activation");
                $crow=$countactivation->row();

                if(($crow->count)==0){

                ?>
                <a href = "<?=site_url('main/activation_page')?>">
                <i class = "fa fa-users nav_icon"><span  class="sec badge font-badge"></span></i>
                <span class ="nav-text">Account Activation Requests &nbsp;</span>
                </a>

                <?php 
                    }else{
                 ?>
                <a href = "<?=site_url('main/activation_page')?>">
                <i class = "fa fa-users nav_icon"><span  class="sec badge font-badge"><?=$crow->count?></span></i>
                <span class ="nav-text">Account Activation Requests &nbsp;</span>
                </a>
                 <?php 
                        }
                  ?>
            </li>
        </ul>

    </nav>

<section class = "wrapper scrollable">

<section class = "title-bar">
   <i class="d-block"><img class="img-responsive img-logo-smol logo mx-auto img-fluid float-left" src="<?=base_url()?>bootstrap/images/hcc-new.png"></i> 
    <div class="profile_details_left">
 <div class="profile_details">
      <ul>
          <li class="dropdown profile_details_drop">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                  <div class="profile_img">
                      <span class="prfil-img"><i class="fa fa-user" aria-hidden="true"></i></span>
                      <div class="clearfix"></div>
                  </div>
              </a>
              <ul class="dropdown-menu drp-mnu">
                <li><a href="<?=site_url('main/dashboard')?>"><i class="fa fa-cog"></i> Settings</a></li>
                <li><a href="logout"><i class="fa fa-sign-out"></i> Log-out</a></li>
                  
              </ul>
          </li>
      </ul>
      </div>
  </div>
 <div class="w3l_search text-right">
    <?=form_open("main/searchUsers")?>
      <input type = "text" name ="key">
      <button type = "submit" value="SEARCH" class = "btn btn-warning button-left">
      <i class="fa fa-search" aria-hidden="true"></i></button>
    </form>
  </div>
  <div class="headeradmin">
    <h1><a href="<?=site_url('main/dashboard')?>">Holy Cross College</a></h1>
  </div>

</section>

<div class = "main-grid">
    <div class = "agile-grids">
        <div class = "progressbar-heading grids-heading">
            <h2>Activation Account Request</h2>
        </div>  
    </div>

<div class = "codes">
<div class = "agile-container">
<table class = "agile-container table table-hover">
    <tr>
        <th class="text-center">First name</th>
        <th class="text-center">Middle initial</th>
        <th class="text-center">Last name</th>
        <th colspan="2" class="text-center">Action</th>
    </tr>

<?php 

if(isset($_POST['key'])){
    $key = $_POST['key'];
  $queryForUsers =$this->db->query("SELECT * FROM activation INNER JOIN users ON users.Fname LIKE CONCAT('%{$key}', activation.Fname, '%{$key}') AND users.Lname LIKE CONCAT('%{$key}',activation.Lname,'%{$key}')");
}else{
    $queryForUsers =$this->db->query("SELECT * FROM activation INNER JOIN users where activation.Fname = users.Fname");

    
      
}
foreach($queryForUsers->result() as $rowUsers): 
?>
        <tr>    
            <?php

                        if(($crow->count)==0){
                          
                        echo '<td> There are no requests......</td>';

                        }else{
                         

                ?>
                <td class="text-center"><?=$rowUsers->Fname?></td>
                <td class="text-center"><?=$rowUsers->Mi?></td>
                <td class="text-center"><?=$rowUsers->Lname?></td>
              
                <?php 
                   if(($rowUsers->status)=="DISABLE"){
                        
              
                 ?>
                 <td class="text-center"><a class="btn btn-primary" data-toggle="modal" data-target="#modalActivation<?=$rowUsers->username?>"  href="#modalActivation<?=$rowUsers->username?>" href="#"><i class="fa fa-check-circle-o" aria-hidden="true"></i> Activate!</a>
                  <?php 

                  } else if(($rowUsers->status)=="ACTIVE") {

                   ?>
                   <td class="text-center"><a class="btn btn-default disabled" data-toggle="modal" data-target="#modalActivation<?=$rowUsers->username?>"  href="#modalActivation<?=$rowUsers->username?>" href="#"><i class="fa fa-check-circle-o" aria-hidden="true"></i> Activate!</a>
                   <?php 
                 }
                    ?>
                 <td><a class="btn btn-danger" data-toggle="modal" data-target="#modalDelete<?=$rowUsers->activationID?>"  href="#modalDelete<?=$rowUsers->activationID?>" href="#"><i class="fa fa-trash-o" aria-hidden="true"></i> Ignore</a></td>
               


        </tr>
        <!--MODAL DELETE-->


<div id="modalActivation<?=$rowUsers->username?>" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Activate Account</h4>
      </div>
      <div class="modal-body">
        <div class="agile-container">
          <h4>Reason For Activation</h4>
          <br>
              <p class="text-center center-block text-area-roa"><?=$rowUsers->roa?></p>
          </div>

      <div class="clearfix"></div>
      <br>
      <div>
        <center>
        <?=form_open("main/activateaccount/$rowUsers->username")?>
          
             <?php 
                if(($rowUsers->status)=="DISABLE"){
                    echo "<input type='checkbox' name='status' value='ACTIVE'> ENABLE USER</input>";
                }
             ?>
     

        </center>
        </div>
      </div>
      <div class="modal-footer">
        <input type="submit" class="btn btn-danger" value = "YES" onClick = "message()">
        </form>
        <button type="button" class="btn btn-default" data-dismiss="modal">CANCEL</button>
      </div>
    </div>

  </div>
</div>

<!--END OF MODAL DELETE-->
<!--MODAL DELETE-->


<div id="modalDelete<?=$rowUsers->activationID?>" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Delete Request</h4>
      </div>
      <div class="modal-body">

        <center>
        <?=form_open("main/deleteRequest/$rowUsers->activationID")?>

            <p>Do you want to remove this request?</p>
     

        </center>

      </div>
      <div class="modal-footer">
        <input type="submit" class="btn btn-danger" value = "YES" onClick = "deleteRecord()">
        </form>

        <button type="button" class="btn btn-default" data-dismiss="modal">CANCEL</button>
      </div>
    </div>

  </div>
</div>

<!--END OF MODAL DELETE-->

    <?php  
        }
    endforeach;
    ?>
    </table>
    </div>
    </div>

</section>  
</div>

</body>
</html>