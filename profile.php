     
         <table><tr>
        
                          <td  style="padding-left:600px;"> <a href="home.php" name="home"><button id="home" style="height: 40px; width: 200px;">&Longleftarrow; Home</button></a></td>
                           <td> <a href="signin.php" name="signin"><button id="signin" style="height: 40px; width: 200px;">&dbkarow; Sign IN</button></a></td>
                           <td> <a href="contact.php" name="contact"><button id="contactbutt" style="height: 40px; width: 200px;">Contact US</button></a></td>
                           <td>  <a href="signup.php" name="back"><button onclick="history.go(-1);" id="backbutt" style="height: 40px; width: 200px;">Back to Sign UP</button></a></td>
                           <td> <?php 
                                 $urllink ="/PHP/QuizMantra/signin.php";
                                  
		                   echo "<a href=\"javascript:loginAlert('$urllink')\"><button id='edit' style='height: 40px; width: 200px;'>Edit Profile</button></a></td>";?>
                        </tr>
                        </table>

              <?php
                
                 
                 
                 if($name=='admin' && $pass=='admin'){
                  mysqli_query($conn,"INSERT INTO Registration(Name,Email,Pass,Mob,DOB,Role) VALUES('$name','$email','$pass','$mob','$date','0')");   
                 }
                 
                 else{
                    mysqli_query($conn,"INSERT INTO Registration(Name,Email,Pass,Mob,DOB,Role) VALUES('$name','$email','$pass','$mob','$date','1')"); 
                 }
               //   mysqli_query($conn,"INSERT INTO StudentDetails(Name,Mob,Email,Pass) VALUES('$name','$mob','$email','$pass')");  
                          
               ?>    
                
                  <fieldset><legend><strong>Submitted Details :</strong></legend><br>
                         <font color='#B90707'>Thank You : <b> <em><?php echo $name; ?></em></b> for Registration.<br></font>Now You Could Login with ID : <font color='#74D8FF'><b><i><?php echo $email; ?></i></b></font><br><br><br>
                         <table id="outputtable" cellpadding="10" border="2" align="center">
                              
                             <tr><td>Email :</td><td><font color='#74D8FF'><b><?php echo $email; ?></b></font></td></tr>
                              <tr><td>Password :</td><td><font color='#96A617'><b><?php echo $pass; ?></b></font></td></tr>
                                 <tr><td>Name :</td><td><font color='#B90707'><b> <em><?php echo $name; ?></em></b></font></td></tr>
                                 <tr><td>Mobile :</td><td><font color='#74D8FF'><b><?php echo $mob; ?></b></font></td></tr>
                                      <tr><td>DOB :</td><td><b><?php echo $date; ?></b></td></tr>
                         </table>
                                                              
                   </fieldset>           
                               
                