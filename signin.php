
<?php
    include('header.php');
 
 ?>
<body id="register" style="overflow: scroll;">
       
         <fieldset class='loginwall'>
             
             <table><tr>
                          <td  style="padding-left:100%;"> <a href="home.php" name="home"><button id="home" style="height: 40px; width:200px;">&Longleftarrow; Home</button></a></td>
                           <td style="padding-left:101%;"> <a href="signup.php" name="signup"><button id="signup" style="height: 40px; width: 200px;">&dbkarow; Sign UP</button></a></td>
                           <td style="padding-left:102%;"> <a href="contact.php" name="datahistory"><button id="contactbutt" style="height: 40px; width: 200px;">Contact US</button></a></td>
                       </tr>
                   </table>
          <!--  <h3 class='regheading'><font color='white'>REGISTRATION</font></h3>-->
             
             <form method="post" action="login.php" name="login">
               <fieldset><legend><b>SIGN IN :</b></legend>
            
                 <div id='loginarea'>
                   <table cellpadding='10%'>
                       
                       <tr>
                           <td rowspan="5" style="padding-right:5%;padding-left:5%;width:45%;">
                               <img src="images/whiteboard.jpg" alt="scienceclub" style="width:80%;height: 30%;" />
                           </td>
                           <td style="padding-top:100px;padding-left:8%;"><label>Email ID : </label></td>
                           
                               <td style="padding-top:100px"> <input type="email" class="loginmail" id="emailjs" name="email" size="30" maxlength="30" required="required" value="<?php   

                                                                                                                if(!empty($_POST['email'])){
                                                                                                                  echo $_POST['email'];}
                                                                                                             ?>" />
                                                     </td>
                                                     
                       </tr>
                       <tr>
                                                     
                           <td style="padding-left:8%;"><label>Password  : </label></td>
                           <td><input type='password' class="loginpass" name="password" size="30" maxlength="20" required="required" value="<?php 
                                                                                                                if(!empty($_POST['password'])){
                                                                                                                echo $_POST['password'];
                                                                                                            }
                                                                                                            ?>" />
                                                     </td>

                                                     
                       </tr>  
                       
                       <tr>
                           <td style="padding-bottom: 200px; padding-right: 8%;" colspan="2"><p align="center"><input type="submit" name="submit" value="Log In" style="color: #36AE79;height: 40px;width: 180px"></p></td>
                                                     
                       </tr>
                       <tr>      
                            
                                                     
                    </tr> 
                      
                  </table>
               </div>
            </fieldset>
          </form>
            
    </fieldset>
      
 <?php
     include("loginfooter.html");
  ?>
 