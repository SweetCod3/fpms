<footer class="footertop">
        <div class="container">
          <div class="row">
          <div class="col-md-6">
            <h5><i class="fa fa-user"></i> About Us</h5>
            <hr>
            <ul style="list-style: none; padding:5px;">
              <li>
                <a href="" class="footer_description">Privacy Policy</a>
              </li>
              <li>
                <a href="" class="footer_description">Terms and Conditions</a>
              </li>
              <li>
                <a href="" class="footer_description">About Enhancezo</a>
              </li>
            </ul>
          </div>
          <div class="col-md-6">
            <h5><i class="fa fa-phone"></i> Customer Support</h5>
            <hr>
            <ul style="list-style: none; padding:5px;">
              <li>
                <a href="" class="footer_description">Help Center</a>
              </li>
              <li>
                <a href="" class="footer_description">How to buy</a>
              </li>
              <li>
                <a href="" class="footer_description">How to return</a>
              </li>
            </ul>
          </div>
        </div>
        <hr>
        <p>Allrights reserved 2022</p>
      </div>
  </footer>
    </main>

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

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="js/jquery-3.3.1.slim.min.js.download" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
    <script src="js/popper.min.js.download"></script>
    <script src="js/bootstrap.min.js.download"></script>
    <!-- Just to make our placeholder images work. Don't actually copy the next line! -->
    <script src="js/holder.min.js.download"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
    <script type="text/javascript">
      $(document).ready( function () {
    $('#myTable').DataTable();
} );
    </script>
        <script type="text/javascript">
      $(document).ready( function () {
    $('#example1').DataTable({
      "pageLength": 5
    });
} );
    </script>
  <!--Start of Tawk.to Script-->
    <script type="text/javascript">
    var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
    (function(){
    var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
    s1.async=true;
    s1.src='https://embed.tawk.to/5b5fca8cdf040c3e9e0c1d0c/default';
    s1.charset='UTF-8';
    s1.setAttribute('crossorigin','*');
    s0.parentNode.insertBefore(s1,s0);
    })();
    </script>
</body></html>