<script type="text/javascript">
$(document).ready(function(){
    $(function() {
 		function split( val ) {
                return val.split( /,\s*/ );
        }
                function extractLast( term ) {
                 return split( term ).pop();
        }

        $( "#search" )
            // don't navigate away from the field on tab when selecting an item
              .bind( "keydown", function( event ) {
                if ( event.keyCode === $.ui.keyCode.TAB &&
                        $( this ).data( "autocomplete" ).menu.active ) {
                    event.preventDefault();
                }
            })
            .autocomplete({
                source: function( request, response ) {
                    $.getJSON( "<?php echo base_url();?>index.php/frontpage/livesearch",{  //Url of controller
                        term: extractLast( request.term )
                    },response );
                },
                search: function() {
                    // custom minLength
                    var term = extractLast( this.value );
                    if ( term.length < 1 ) {
                        return false;
                    }
                },
                focus: function() {
                    // prevent value inserted on focus
                    return false;
                },
                select: function( event, ui ) {
                    var terms = split( this.value );
                    // remove the current input
                    terms.pop();
                    // add the selected item
                    //terms.push( ui.item.value );
                    var arr = ui.item.value.split("#");
                    if (arr[0] == "T") {
                        window.location.href = "<?php echo base_url();?>index.php/docente/profile/" + arr[1];
                    } else if (arr[0] == "C") {
                        window.location.href = "<?php echo base_url();?>index.php/disciplina/profile/" + arr[1];
                    } else if (arr[0] == "W") {
                        window.location.href = "<?php echo base_url();?>index.php/trabalho/profile/" + arr[1];
                    }
                    // add placeholder to get the comma-and-space at the end
                    terms.push( "" );
                    this.value = terms.join( "," );
                    return false;
                }
            });
          
 });
});
</script>

<!-- Signup modal -->
<div class="modal fade" id="signupmodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Quick Register</h4>
      </div>
      <div class="modal-body">
        <ul class="nav nav-tabs">
            <li class="active"><a href="#teacher" data-toggle="tab">Teacher</a></li>
            <li><a href="#student" data-toggle="tab">Student</a></li>
        </ul>
      </div>
      <div class="tab-content">
        <div class="tab-pane active" id="teacher">
            <div style ="margin-left: 10px">    
                <form role="form" id ="myform" method ="post" action="<?php echo base_url() ."index.php/docente/quickRegister"?>">
                    <div class="form-group">
                        <label for="email">Email address</label>
                        <input type="email" class="form-control" id="email" name ="email" placeholder="Enter email">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name ="password"placeholder="Password">
                    </div>
                    <div class="form-group">
                        <label for="confirmpassword">Confirm Password</label>
                        <input type="password" class="form-control" id="conpassword" name ="confpassword" placeholder="Confirm Password">
                    </div>
                    <button type="submit" class="btn btn-primary">Create teacher</button>
                </form>
            </div>
        </div>
        <div class="tab-pane" id="student">
            <div style ="margin-left: 10px">    
                <form role="form" id ="myform" method ="post" action="<?php echo base_url() ."index.php/aluno/quickRegister"?>">
                    <div class="form-group">
                        <label for="email">Email address</label>
                        <input type="email" class="form-control" id="email" name ="email" placeholder="Enter email">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name ="password" placeholder="Password">
                    </div>
                    <div class="form-group">
                        <label for="confirmpassword">Confirm Password</label>
                        <input type="password" class="form-control" id="confpassword" name ="confpassword" placeholder="Confirm Password">
                    </div>
                    <div class="form-group">
                        <label for="token">Class token</label>
                        <input type="text" class="form-control" id="token" name ="token" placeholder="Enter class token">
                    </div>
                    <button type="submit" class="btn btn-primary">Create student</button>
                </form>
            </div>
        </div>
    </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-info" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


<div class ="container-fluid" style ="padding: 0">
    <div class ="top" style ="background-image:url('<?php echo base_url('assets/img/office.png') ?>')">
        <div class ="row" style ="margin: 0; padding: 0;">
            <div class ="col-md-6 col-md-offset-1" style ="margin-top: 35px;">
                <p class ="text" style ="background-color: black">search and share knowledge</p>
            </div>
        </div>
        <div class ="row" style ="margin: 0; padding: 0;">
            <div class ="col-md-5 col-md-offset-2" style ="margin-top: 140px;">
                <form class="form" role="form" method ="get" action ="<?php echo base_url() . "index.php/frontpage/search" ?>">
                    <div class ="row" style ="margin: 0; padding: 0;">
                        <p class ="textLabel">Search on public repository</p>
                    </div>
                    <div class ="row" style ="margin: 0; padding: 0;">
                        <div class="form-group col-md-10">
                            <input type="text" class="form-control" name ="search" id="search" placeholder="Classes, teachers, keywords">
                        </div>
                        <div class="form-group col-md-2" style ="padding-left: 0">
                            <button type="submit" class="btn btn-danger"><span class="glyphicon glyphicon-search"></span></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class ="row" style ="margin: 0; padding: 0;">    
        <div class ="col-md-12 bar">
        </div>
    </div>
    <div class ="row" style ="margin: 0; padding: 0; margin-top: 30px;">
        <div class ="col-md-6 col-md-offset-1">
            <h3 class ="titles">Tour</h3>
            <hr class ="style-eight">
            <div class="video-responsive">
                <iframe src="//player.vimeo.com/video/5799640?title=0&amp;byline=0&amp;color=fa0a4e" width="690" height="388" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
            </div>
        </div>
        <div class ="col-md-3 col-md-offset-1">
            <h3 class ="titles">Features</h3>
            <hr class ="style-eight">
            <ul class ="textLabel" style ="color: #e74c3c; margin-left: 15px; padding-top: 0px">
                <li>Automatic evaluation</li>
                <li style ="padding-top: 20px">Public repository</li>
                <li style ="padding-top: 20px">Manage work groups</li>
                <li style ="padding-top: 20px">Control class students</li>
                <li style ="padding-top: 20px">Import and Export grades</li>
                <li style ="padding-top: 20px">Remember personal events</li>
                <li style ="padding-top: 20px">Connect with myAcademia</li>
                <li style ="padding-top: 20px">Responsive design</li>
            </ul>
        </div>
    </div>
<div class = "footer" style ="height: 70px; background-color: black; margin-top: 60px; bottom: 0px;">
    <div class ="row" style ="margin-left: 20px; padding-top 50px;">
        <div class ="col-md-8">
            <p class ="text">Anywhere</p>
            <p style ="font-size: 20px; color: white; font-family: Tahoma;">Any questions contact us by email el2014pi@gmail.com</p>
        </div>
    </div>
</div>
</div>