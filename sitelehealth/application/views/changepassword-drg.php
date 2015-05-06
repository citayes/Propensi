<div id="wrapper">
    <!-- Sidebar -->
    <div id="sidebar-wrapper">
    <!-- Sidebar content-->
    <?php
        $pengguna = new pengguna();
        $pengguna->where('username', $_SESSION['drg'])->get();
        $profile="";
        $profile .="<br><center><img alt='140x140' src='../../".$pengguna->foto."' style='width:125px; height:125px;' class='img-circle'>
        <p><b>".$pengguna->nama."</b><br>
        <p>".$pengguna->username."<br>
        <p>".$pengguna->email."<br>
        <p>".$pengguna->role."</p></center>";
        echo $profile;
    ?>
    </div>
    <!-- /#sidebar-wrapper -->
    <!-- Page Content -->
    <div id="page-content-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="col-md-8 col-md-offset-2">
                      <div class="cform" id="contact-form">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                              <h4 class="section-heading animated" data-animation="bounceInUp"><span class="glyphicon glyphicon-lock"></span>Change Password</h4></div>
                              <div class="panel-body">
                                <form class="form-horizontal" role="form" method="post" action="change">
                                  <div class="form-group">
                                  <label class="col-sm-3 control-label" for="oldpassword">Your Old Password</label>
                                    <div class="col-sm-9">
                                      <input type="password" class="form-control" name="OldPassword" id="password" placeholder="Your Old Password" required autofocus/>
                                    </div>
                                  </div>
                                  <div class="form-group">
                                  <label class="col-sm-3 control-label" for="oldpassword">Your New Password</label>
                                    <div class="col-sm-9">
                                      <input type="password" class="form-control" name="NewPassword" id="password" placeholder="Your New Password"/>
                                    </div>
                                  </div>
                                  <div class="form-group">
                                  <label class="col-sm-3 control-label" for="newpassword">Re-type Your New Password</label>
                                    <div class="col-sm-9">
                                      <input type="password" class="form-control" name="RNewPassword" id="password" placeholder="Re-type Your New Password"/>
                                    </div>
                                  </div>
                                  <div class="form-group last">
                                    <div class="col-sm-offset-3 col-sm-9">
                                      <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                                    </div>
                                  </div>
                                </form>
                              </div>
                              <div class="panel-footer">
                              </div>
                            </div>
                          </div>
                      </div>
                    </div>                    
                </div>
            </div>
        </div>
    </div>
    <!-- /#page-content-wrapper -->

</div>
<!-- /#wrapper -->