
	<div class="container">
		<br><br>
		<div class="row">
			<div class="col-md-6 col-md-offset-3">
				<div class="cform" id="contact-form">
	            	<div class="panel panel-default">
					    <div class="panel-heading">
					        <h4 class="section-heading animated" data-animation="bounceInUp"><span class="glyphicon glyphicon-lock"></span>Sign In</h4></div>
					        <div class="panel-body">
					            <form class="form-horizontal" role="form" method="post" action="signin">
					            <div class="form-group">
					            	<label for="username" class="col-sm-3 control-label">Username</label>
									<div class="col-sm-9">
									<input type="input" name="Username" class="form-control" id="Username" placeholder="Your Username" required/>
									</div>
								</div>
								<div class="form-group">
									<label for="password" class="col-sm-3 control-label">Your Password</label>
									<div class="col-sm-9">
										<input type="password" class="form-control" name="Password" id="Password" placeholder="Your Password" required/>
									</div>
								</div>
								<div class="form-group">
									<div class="col-sm-offset-3 col-sm-9">
										<a id="modal-68214" href="#modal-container-68214" data-toggle="modal">Forgot password?</a>		
									</div>
								</div>
								<div class="form-group last">
									<div class="col-sm-offset-3 col-sm-9">
										<button type="submit" class="btn btn-primary btn-sm">Sign in</button>
									</div>
								</div>
								</form>
							</div>
							<div class="panel-footer">Not Registred? 
								<a href="signup">Register here</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	
	<div class="modal fade" id="modal-container-68214" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<form  method="post" action="forgetpassword">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					<h4 class="modal-title" id="myModalLabel">
						Forgot Password
					</h4>
				</div>
				<div class="modal-body">
						<label for="username" class="col-sm-3 control-label">Username</label>
						<input type="input" name="Username" class="form-control" id="Username" placeholder="Your Username" required/>
						<label for="email" class="col-sm-3 control-label">Your Email</label>
						<input type="input" class="form-control" name="email" id="email" placeholder="Your email" required/>
				</div>
				<div class="modal-footer">
					 <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					 <button type="submit" class="btn btn-primary">Submit</button>
				</div>				 
				</form>
			</div>
		</div>
	</div>