<?php
$loginVerification = $this->session->userdata('logged_in');
$loginVerificationuser = $this->session->userdata('user_type');

if (!$loginVerification) {
  redirect("main/index");

}
elseif (($loginVerificationuser) != "USER") {
  redirect("main/dashboard");

}

$userOnSession = $this->session->userdata('Fname');
$userID = $this->session->userdata('userID');
?>
<!DOCTYPE html>
<html>
<head>
    <title> USER PAGE </title>
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
        alert("Message Successfully sent!");
      }
      function deleteRecord(){
        alert("Message Successfully Deleted");
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
  .storyBody{
    height: 150px;
  }
    .img-logo-smol{
        width: 55px ;
        height: 55px;
        margin-bottom: 75px;
        margin-top: -5px;
    }
    .message {
        padding: 8px;
        width: 20%;
        margin-bottom: 20px;
        cursor: pointer;
        color: #fff;
        font-size: 14px;
        -webkit-transition: all 1.5s ease-in-out;
        -moz-transition: all 1.5s ease-in-out;
        -o-transition: all 1.5s ease-in-out;
        }
        textarea{
          resize: none;
          border-radius: 10px;
          border-color: blue;
          width: 1000px;
          padding-top: 20px;
          padding-left: 20px;
          text-align: justify;
        }
        .create-button{
          margin-left: 80px;
        }
        .border-rounded{
          border-radius: 2px;
        }
        .border-color{
          border-style: ridge;
          border-color: blue;
          border-radius: 10px;
          width: 500px;
          height: 40px;

        }
      .button-left{
       padding-left: 10px;
       height: 42px;
    }
    /* Header/Blog Title */
.header {
  padding: 30px;
  font-size: 40px;
  text-align: center;
  background: white;
}

/* Create two unequal columns that floats next to each other */
/* Left column */
.leftcolumn {
  float: left;
  width: 75%;
}

/* Right column */
.rightcolumn {
  float: left;
  width: 25%;
  padding-left: 20px;
}

/* Fake image */
.fakeimg {
  background-color: #aaa;
  width: 100%;
  padding: 20px;
}

/* Add a card effect for articles */
.card {
  background-color: #1686E8;
  padding: 20px;
  margin-top: 20px;
}
.card-body{
  background-color: #FFFFFF80;
  padding: 20px;
  margin-top: 20px;
}

/* Clear floats after the columns */
.row:after {
  content: "";
  display: table;
  clear: both;
}

/* Footer */
.footer {
  padding: 20px;
  text-align: center;
  background: #ddd;
  margin-top: 20px;
}
.font-white{
  color: white;
}

/* Responsive layout - when the screen is less than 800px wide, make the two columns stack on top of each other instead of next to each other */
@media screen and (max-width: 800px) {
  .leftcolumn, .rightcolumn {
    width: 100%;
    padding: 0;
  }
}
.edit-title{
  border-color: #7F7F7FFF;
  margin-top: 15px;
  height: 35px;
  width: 300px;
  text-align: center;
}
.edit-text-area{
  height: 150px;
}
.react{
  background-color: #DEFFDBFF;
  padding-top: 15px;
  margin-top: 10px;
  padding-left: 25px;
  height: 50px;
  width: 250px;
}
.sec{
        position: relative;
        right: -1px;
        top:-22px;
    }

    .counter-lg {
        top: -24px !important;
    }

 .button-space-after{
      margin-right: 10px;
    }

    
  </style>  
  
</head>
<body class = "dashboard-page">

  <nav class = "main-menu">
    <ul>
      <li class = "has-subnav">
        <a href = "<?=site_url('main/user_page')?>">
          <i class = "fa fa-home nav-icon"></i>
          <span class = "nav-text">Home</span>
        </a>
      </li>

      <li class = "has-subnav">
        <a href = "<?=site_url('main/profile')?>">
          <i class = "fa fa-user nav-icon" aria-hidden="true"></i>
          <span class = "nav-text">Profile</span>
        </a>
      </li>

      <li class = "has-subnav">
        <a href = "<?=site_url('main/messages')?>">
        <i class = "fa fa-envelope nav-icon"></i>
        <span class ="nav-text">Messages</span>
        </a>

      </li>

      <li class = "has-subnav">
        <a href = "<?=site_url('main/stories')?>">
        <i class = "fa fa-book nav-icon"></i>
        <span class ="nav-text">Stories</span>
        </a>

      </li>
      <li class = "has-subnav">
        <a href = "<?=site_url('main/events')?>">
        <i class = "fa fa-calendar nav-icon"></i>
        <span class ="nav-text">Events</span>
        </a>
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
                      <span class="prfil-img"><i class="fa fa-user" aria-hidden="true">
                      <?php
                          $queryConNotif = $this->db->query("SELECT COUNT(*) as notCon FROM connection where acceptor = '{userID}' and is_confirm = 0");
                          $notCon = $queryConNotif->row();
                          
                          if (($notCon->notCon)>0) {
                            echo "<span class='badge'>$notCon->notCon</­span>"; 
                          }else{

                          }
                          ?></i></span>
                      <div class="clearfix"></div>
                  </div>
              </a>
              <ul class="dropdown-menu drp-mnu">
                <li><a href="#"><i class="fa fa-cog"></i> Settings</a></li>
                <li><a href="<?=site_url('main/view_request')?>"><i class="fa fa-users"></i> Connections<?php
                          $queryConNotif = $this->db->query("SELECT COUNT(*) as notCon FROM connection where acceptor = '{$userID}' and is_confirm = 0");
                          $notCon = $queryConNotif->row();
                          
                          if (($notCon->notCon)>0) {
                            echo "<span class='badge'>$notCon->notCon</­span>"; 
                          }else{

                          }
                          ?></a></li>
                <li><a href="logout"><i class="fa fa-sign-out"></i> Log-out</a></li>

              </ul>
          </li>
      </ul>
      </div>
  </div>
  <div class="w3l_search text-right">
    <?=form_open("main/searchUser")?>
      <input type = "text" name ="key">
      <button type = "submit" value="SEARCH" class = "btn btn-warning button-left">
      <i class="fa fa-search" aria-hidden="true"></i></button>
    </form>
  </div>
  <div class="">
   <h1 class="float-right headeradmin"><a href="<?=site_url('main/user_page')?>">&nbsp;<?=$userOnSession?></a></h1>
  </div>
</section>
<div class = "main-grid">
  <div class = "agile-grids">
    <div class = "progressbar-heading grids-heading">
      
      <h2> <i class="fa fa-envelope"></i> Messages</h2>
      <?php 
      if (isset($_SESSION['message'])) {
  $message = $_SESSION['message'];
  echo "<div><p class='message center-block text-center bg-primary'>" . $message . "</p></div>";
}
       ?>
      
    </div>
  </div>

  <div class = "codes">
    <div class = "agile-container">
      <a href="<?=site_url('main/messages')?>" class="btn btn-default bg-dark disabled"><i class="fa fa-download"></i> Recieved</a>
      <a href="<?=site_url('main/sent')?>" class="btn btn-primary"><i class="fa fa-upload"></i> Sent</a>
      <a data-toggle="modal" data-target="#modalNewMessage" href="#modalNewMessage" class="btn btn-success text-right"><i class="fa fa-plus"></i> New Message</a>

      <!--MODAL FOR EDIT-->
<div id="modalNewMessage" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">New message</h4>
      </div>
      <div class="modal-body">

        <center>
        <?=form_open("main/create_message")?>
                    <input type="hidden" name="time_read" value="<?=date("y_m_d H:i:s")?>">
                                    <input type="hidden" name="sender" value="<?=$userID?>">
                                    <input type="hidden" name="is_read" value=0>
                                    <input type="text" name="Fname" class="edit-title" placeholder="Reciever's First name">
                                    <input type="text" name="Lname" class="edit-title" placeholder="Reciever's Last name">
                                    <input type="text" name="subject" class="edit-title" value="" placeholder="subject">
                                    <div class="clearfix"></div>
                                    <br>
                                    <textarea class="edit-text-area" name="body_message"></textarea>
      </div>
      <div class="modal-footer">
        <input type="submit" class="btn btn-success" value = "Send" onClick = "message()">
        </form>

        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
<!--END MODAL EDIT-->


      <table class="agile-container table table-hover">
        <tr>
          <strong>
          <th>FROM</th>
          <th>ACTION</th>
          <th>SUBJECT</th>
          <th>MESSAGE</th>
          <th>DATE</th>
          </strong>
        </tr>
        <tr>
          <?php 
        $loadMessages=$this->db->query("SELECT * FROM messages INNER JOIN users ON users.userID = messages.reciever WHERE messages.reciever = {$userID} ORDER BY messages.time_read DESC");
                 foreach($loadMessages->result() as $rowMessages) {
                      $sendername=$this->db->query("SELECT * FROM users WHERE userID ={$rowMessages->sender}");
                      foreach ($sendername->result() as $sname) {
                        
                      

         ?>
         <td>
           <?=$sname->Fname?>
          <?php 
            }
           ?>
         </td>
         <td>
           <?php 
            if(($rowMessages->sender)!=1){
              echo "<a class='btn btn-warning button-space-after' data-toggle='modal' data-target='#modal$rowMessages->sender'  href='#modal$rowMessages->sender'><i class='fa fa-edit' aria-hidden='true'></i> Reply</a>";
              echo "<a class='btn btn-danger' data-toggle='modal' data-target='#modalDelete$rowMessages->msgID'  href='#modalDelete$rowMessages->msgID'><i class='fa fa-edit' aria-hidden='true'></i> Delete</a>";

            }else{
              echo "<a class='btn btn-warning disabled button-space-after' data-toggle='modal' data-target='#modal$rowMessages->sender'  href='#modal$rowMessages->sender'><i class='fa fa-edit' aria-hidden='true'></i> Reply</a>";
              echo "<a class='btn btn-danger' data-toggle='modal' data-target='#modalDelete$rowMessages->msgID'  href='#modalDelete$rowMessages->msgID'><i class='fa fa-edit' aria-hidden='true'></i> Delete</a>";

            }
            ?>
         </td>
          <td><?=$rowMessages->subject?></td>
          <td><?=$rowMessages->body_message?></td>
          <td><?=$rowMessages->time_read?></td>
          <!--MODAL FOR EDIT-->
                        <div id="modal<?=$rowMessages->sender?>" class="modal fade" role="dialog">
                          <div class="modal-dialog">

                            <!-- Modal content-->
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Reply</h4>
                              </div>
                              <div class="modal-body">

                                <center>
                                <?=form_open("main/send_message/$rowMessages->sender")?>
                                    <input type="hidden" name="time_read" value="<?=date("y_m_d H:i:s")?>">
                                    <input type="hidden" name="sender" value="<?=$userID?>">
                                    <input type="hidden" name="reciever" value="<?=$rowMessages->sender?>">
                                    <input type="hidden" name="is_read" value=0>
                                    <input type="text" name="subject" class="edit-title" value="<?=$rowMessages->subject?>" readonly>
                                    <div class="clearfix"></div>
                                    <br>
                                    <textarea class="edit-text-area" name="body_message"></textarea>

                              </div>
                              <div class="modal-footer">
                                <input type="submit" class="btn btn-success" value = "send" onClick = "message()">
                                </form>

                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                              </div>
                            </div>

                          </div>
                        </div>
                        <!--END MODAL EDIT-->
           <!--MODAL DELETE-->
                        <div id="modalDelete<?=$rowMessages->msgID?>" class="modal fade" role="dialog">
                          <div class="modal-dialog">

                            <!-- Modal content-->
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Delete Record</h4>
                              </div>
                              <div class="modal-body">

                                <center>
                                <?=form_open("main/delete_message/$rowMessages->msgID")?>

                                    <p>Do you want to delete this message permanently?</p>


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
          
        </tr>
            <?php 

            }
           ?>
          
      </table>
    </div>
  </div>
</div>
</section>

</body>
</html>