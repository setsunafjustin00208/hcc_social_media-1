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
        <title> HCC DASHBOARD </title>
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
                alert("Record Successfully Changed");
            }
            function deleteRecord(){
                alert("Record Successfully Deleted");
            }
        </script>

    <meta name = "viewport" content = "width=device-width, initial=1">
    <script type = "text/javascript" src = "<?=base_url()?>bootstrap/js/jquery-3.5.1.js"></script>
    <script type = "text/javascript" src = "<?=base_url()?>bootstrap/js/modernizr.js"></script>
    <script type = "text/javascript" src = "<?=base_url()?>bootstrap/js/jquery.cookie.js"></script>
    <script type = "text/javascript" src = "<?=base_url()?>bootstrap/js/screenfull.js"></script>
    <script type = "text/javascript" src = "<?=base_url()?>bootstrap/js/Chart.bundle.js"></script>


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
        padding-left:40px;
    }
    .dot {
    height: 15px;
    width: 15px;
    background-color: red;
    border-radius: 50%;
    display: inline-block;
  }

  .button-left{
    padding-left: 10px;
    height: 42px;
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
  <div class="">
   <h1 class="float-right headeradmin"><a href="<?=site_url('main/dashboard')?>">Holy Cross College</a></h1>
  </div>
</section>
  
<div class = "main-grid">
    <div class = "agile-grids">
        <div class = "progressbar-heading grids-heading">
            <h2>Users Activity Statistics</h2>
        </div>
    </div>
    <?php 
    //query counts per table
    $numusers = $this->db->query("SELECT COUNT(userID) as uc FROM users");
    $nu=$numusers->row();
    $nummessages = $this->db->query("SELECT COUNT(msgID) as mc FROM messages");
    $nm=$nummessages->row();
    $numcomments = $this->db->query("SELECT COUNT(commentID) as comc FROM comments");
    $nc=$numcomments->row();
    $numlikes = $this->db->query("SELECT COUNT(likeID) as lc FROM likes");
    $nl=$numlikes->row();
    $numstories = $this->db->query("SELECT COUNT(storyID) as sc FROM stories");
    $ns=$numstories->row();
    $numcon = $this->db->query("SELECT COUNT(conID) as cc FROM connection");
    $nco=$numcon->row();

     ?>
<div class = "codes">
    <div class = "agile-container">
        
        <div class="agile-container agile-grids">
            <canvas id="stats"></canvas>
            <script>
                var ctx = document.getElementById('stats').getContext('2d');
                var stats = new Chart(ctx, {
                    type: 'bar',
                    data:{
                       labels: ['users', 'messages', 'comments', 'likes', 'stories', 'connections'],
                       datasets: [{
                                label: 'Activities',
                                data: [<?=$nu->uc?>, <?=$nm->mc?>, <?=$nc->comc?>, <?=$nl->lc?>, <?=$ns->sc?>, <?=$nco->cc?>],
                                backgroundColor: [
                                    'rgba(255, 99, 132, 0.2)',
                                    'rgba(54, 162, 235, 0.2)',
                                    'rgba(255, 206, 86, 0.2)',
                                    'rgba(75, 192, 192, 0.2)',
                                    'rgba(153, 102, 255, 0.2)',
                                    'rgba(255, 159, 64, 0.2)'
                                ],
                                borderColor: [
                                    'rgba(255, 99, 132, 1)',
                                    'rgba(54, 162, 235, 1)',
                                    'rgba(255, 206, 86, 1)',
                                    'rgba(75, 192, 192, 1)',
                                    'rgba(153, 102, 255, 1)',
                                    'rgba(255, 159, 64, 1)'
                                ],
                                borderWidth: 1
                        }]
                    },
                    options:{
                        scales:{
                            yAxes: [{
                                ticks:{
                                    beginAtZero: true
                                }
                            }]
                        }
                    }
                });

            </script>
        </div> 
         
    </div>

</div>

</div>
</section>

</body>
</html>
