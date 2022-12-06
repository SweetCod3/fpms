<!-- modal -->
     <div class="modal fade" id="login" style="width:100%;">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h4>Account Login</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              </div>
              <div class="modal-body">
              <div class="row">
              <div class="col-lg-12">
                <form method="post">
                  <input type="email" class="form-control" name="EmailAddress" placeholder="Enter your Email Address">
                  <p></p>
                  <input type="password" name="Password" class="form-control" placeholder="Password">
                  <p></p>
                    <button class="btn btn-success" name="login_btn">
                      <i class="fa fa-lock"></i> Login Account
                    </button>
                  
                </form>
                  
              </div>
              </div>
              
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div> 
    <!-- end modal -->
  <!-- modal -->
     <div class="modal fade" id="feedback" style="width:100%;">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h4>Send Feedback</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              </div>
              <div class="modal-body">
              <div class="row">
              <div class="col-lg-12">
                <form method="post">
                  <input type="email" class="form-control" name="FeedbackEmail" placeholder="Enter your Email Address" required>
                  <p></p>
                  <input type="text" name="FeedbackName" class="form-control" placeholder="Name" required>
                  <p></p>
                  <select class="form-control" name="FeedbackRate">
                    <option>Select Feedback Rate</option>
                    <option>1</option>
                    <option>2</option>
                    <option>3</option>
                    <option>4</option>
                    <option>5</option>
                  </select>
                  <p></p>
                  <textarea required class="form-control" name="FeedbackComment" placeholder="Please enter your message"></textarea>
                  <p></p>
                    <button class="btn btn-success" name="send_btn">
                      <i class="fa fa-save"></i> Send Feedback
                    </button>
                  
                </form>
                  
              </div>
              </div>
              
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div> 
    <!-- end modal -->

    <!-- modal -->
     <div class="modal fade" id="signup" style="width:100%;">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h4>Create Account</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              </div>
              <div class="modal-body">
              <div class="row">
              <div class="col-lg-12">
                <form method="post">
                  <input type="email" class="form-control" name="EmailAddress" placeholder="Enter your Email Address" required>
                  <p></p>
                  <input type="text" name="FirstName" class="form-control" placeholder="First Name" required>
                  <p></p>
                  <input type="text" name="LastName" class="form-control" placeholder="Last Name" required>
                  <p></p>
                  <input type="password" name="Password" class="form-control" placeholder="Password" required>
                  <p></p>
                  <input type="password" name="ConfirmPassword" class="form-control" placeholder="Confirm Password" required>
                  <p></p>
                  <input type="text" maxlength="11"  name="ContactNumber" class="form-control" placeholder="Contact Number" required>
                  <p></p>
                  <input type="text" name="PermanentAddress" class="form-control" placeholder="Permanent Address" required>
                  <p></p>
                    <button class="btn btn-success" name="save_btn">
                      <i class="fa fa-save"></i> Signup
                    </button>
                  
                </form>
                  
              </div>
              </div>
              
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div> 
    <!-- end modal -->