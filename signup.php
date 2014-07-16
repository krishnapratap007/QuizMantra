<?php
include('header.php');
//include('db.php');

$display=TRUE;
       

    $name='';
    $mob=0;
    $email='';
    $pass='';$rpass='';
    $date='';
    $resultemail='';
    $countvar='';

   $arr=array();
       
     
   if($_SERVER['REQUEST_METHOD']=='POST'){   
    
      
       
    $conn= mysqli_connect("localhost","root","mummy","quizmantra");

             if(mysqli_connect_errno()){
                   echo "connection is not established :".mysqli_connect_error();
               }
               

                        if(!empty($_POST['email'])){

                                 if(!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/",$_POST['email'])){
                                            $arr[0]='<p class="error"><b> <font color="0066FF">your email is wrong, Use <em>PROPER FORMAT (hints: @ , .)!!</em></font></p></b>';
                                    }


                                 else {
                                       $email= mysqli_real_escape_string($conn,$_POST['email']);
                                    
                                         $resultemail=mysqli_query($conn,"SELECT Email FROM Registration WHERE Email='$email'");
                                         $countvar=mysqli_num_rows($resultemail);
                                       
                                          if($countvar>0){
                                             $arr[0]='<p class="error"><b> <font color="red">Record already exist</font></p></b><br>';
                                          }
                                      }
                             }        

                         
                        else {
                                $arr[0]='<p class="error"><b> <font color="0066FF">your forget to enter your email!!</font></p></b>';
                            }
                         
                         
                            
                            
                            
                          if(empty($_POST['password'])){
                                   $arr[1]='<p class="error"><b> <font color="33CCFF">you forget to enter your <em>password!!</em></font></p></b>';
                                }
                                else{
                                   $pass= mysqli_real_escape_string($conn,$_POST['password']);   }
                                
                                   
                                   
                                
                           if(empty($_POST['rpassword']) ){
                                   $arr[5]='<p class="error"><b> <font color="33CCFF">you forget to enter your <em>re-password!!</em></font></p></b>';
                                }
                                
                            else{
                                    
                                    if(($_POST['rpassword'])== $_POST['password']){
                                        $rpass= mysqli_real_escape_string($conn,$_POST['rpassword']);
                                    }
                                    
                                    else{
                                       $arr[5]='<p class="error"><b> <font color="33CCFF">your password does not match to previous<em>password!!</em></font></p></b>'; 
                                    }
                               }       
                                   
                                   
                                
                            if(!empty($_POST['name'])){
                                 if(strlen($_POST['name'])>'25'){
                                        $arr[2]='<p class="error"><b> <font color="green">your name length is too<em> LARGE!!</em></font></p></b>';
                                   }
                                 else
                                     $name=  mysqli_real_escape_string($conn,$_POST['name']);   
                                }

                            else{
                                $arr[2]='<p class="error"><b> <font color="green">you forget to enter your name!!</font></p></b>'; }
                                
                                
                                
                                
                                
                         if(!empty($_POST['number'])){
                                    if(!(is_numeric($_POST['number']))){
                                         $arr[3]='<p class="error"><b> <font color="#146585">your Mob no. is wrong, contains only <em>NUMERIC DIGITS!!</em></font></p></b>';
                                      }
                                    else
                                          $mob=mysqli_real_escape_string($conn,$_POST['number']);
                                 }

                          else{
                                   $arr[3]='<p class="error"><b> <font color="#FFFF66">you forget to enter your mobile number!!</font></b></p>';  }
                                
                                 
                                   
                                   
                                   
                                   
                        if(empty($_POST['date'])){
                                       
                                     $arr[4]='<p class="error"><b> <font color="#0066FF">you forget to enter the <em>DOB!!</em></font></b></p> ';
                                  }
                                  else{
                                       $date= mysqli_real_escape_string($conn,$_POST['date']);  }
        
                  ?>   

   
          <?php        
          
          if(empty($arr)){
                 $display=FALSE;
               
                      
                       include("profile.php");
                   
              }                  
                                  
               
   }

if($display==TRUE){

  ?>
              <script type="text/javascript" charset="utf-8" src="popup.js"></script>  
            <link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
              <script src="//code.jquery.com/jquery-1.10.2.js"></script>
              <script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
              <link rel="stylesheet" href="/resources/demos/style.css">
              <script>
                 $(function() {
                 $( "#datepicker" ).datepicker();
                 $( "#format" ).change(function() {
                  $( "#datepicker" ).datepicker( "option", "dateFormat", $( this ).val() );
              });
            });
           </script>       

    <body id="register">
       
         <fieldset class='loginwall'>
                  <table><tr>
                          <td  style="padding-left:700px;"> <a href="home.php" name="home"><button id="home" style="height: 40px; width: 200px;">&Longleftarrow; Home</button></a></td>
                           <td> <a href="signin.php" name="signin"><button id="signin" style="height: 40px; width: 200px;">&dbkarow; Sign In</button></a></td>
                           <td> <a href="contact.php" name="datahistory"><button id="contactbutt" style="height: 40px; width: 200px;">Contact US</button></a></td>
                       </tr>
                   </table>
          
    
    
           
     
                   
        <form method="post" action="signup.php" enctype=""> 
          <fieldset><legend><b>SIGN UP :</font></b></legend>
           
             
                   <table cellpadding='15'>
          
                       
                       <tr>
                           
                           <td rowspan="8" style="padding-right:700px; padding-left: 100px;">
                               <img src="images/bulb.jpg" alt="Molecule Wallpaper" width="500" height="600" />
                       
                           </td>
                           
                           
                           <tr><td colspan="3"><label for="t1"><font color='#B90707'>You are a New User, Please Register then Log In !!</label></td></tr>
                           
                      
                           <td ><label for="t1">Name :</label></td>
                           <td ><input type="text" class="regt1" name="name" size="21" maxlength="50" value="<?php

                                                                                                                if(!empty($_POST['name'])){
                                                                                                               echo $_POST['name'];
                                                                                                         }?>" />


                                           </td>
                                           
                                           <td>                                        <?php 
                                                                                            if(!$name && !empty($arr[2])){
                                                                                              echo $arr[2];
                                                                                            }
                                                                                           
                                                                                         ?></td>
                    
                    </tr>
                  
                       
                    <tr>
                        
                            <td><label>Email ID : </label></td>
                            <td><input type="email" class="regt2" name="email" size="21" maxlength="50" value="<?php   

                                                                                                                if(!empty($_POST['email'])){
                                                                                                                  echo $_POST['email'];}
                                                                                                             ?>" />
                                                     </td>

                                                     <td>                      <?php if(!$email && !empty($arr[0])){
                                                                                         echo $arr[0];
                                                                                       }
                                                                                   else if($countvar && !empty($arr[0])){
                                                                                          echo $arr[0];
                                                                                      }
                                                                                  
                                                                              ?></td>
                    </tr>
                    
                    
                    <tr>
                            
                            <td><label>Password  : </label></td>
                            <td><input type='password' class="regt3" name="password" size="21" maxlength="30" value="<?php 
                                                                                                                if(!empty($_POST['password'])){
                                                                                                                echo $_POST['password'];
                                                                                                            }
                                                                                                            ?>" />
                                                     </td>

                                                     <td>                        <?php if(!$pass && !empty($arr[1])){
                                                                                      echo $arr[1];
                                                                                    }?> </td>

                      </tr>
                      
                      <tr>
                            
                            <td><label> Re Password  : </label></td>
                            <td><input type='password' class="regt3b" name="rpassword" size="21" maxlength="30" value="<?php 
                                                                                                                if(!empty($_POST['rpassword'])){
                                                                                                                echo $_POST['rpassword'];
                                                                                                            }
                                                                                                            ?>" />
                                                     </td>

                                                     <td>                        <?php if(!$rpass && !empty($arr[5])){
                                                                                      echo $arr[5];
                                                                                    }?> </td>

                      </tr>
                      
                      
                      <tr>
                          <td><label>Mob. No:</label></td>
                                <td><input type=text class="regt4" name="number" size="21" maxlength="11" value="<?php  
                                                                                                                        if(!empty($_POST['number'])){
                                                                                                                         echo $_POST['number'];
                                                                                                                } ?>" />
                                                   </td>
                                                    <td>                              <?php   if(!$mob && !empty($arr[3])){
                                                                                               echo $arr[3];
                                                                                           }
                                                                                      ?></td>
                    </tr>
                    
                    
                    <tr>
  
			<td><label>DOB  :  </label> </td>
                        
                        <td colspan="2"><input type="text" id="datepicker"  class="regt5" name="date" size="21" maxlength="15" value="<?php 
                                                                                                            if(!empty($_POST['date'])){
                                                                                                             echo $_POST['date'];
                                                                                                        }
                                                                                                      ?>" />
                                    
                           
                                    <select id="format">
                                    <option value="mm/dd/yy">Default - mm/dd/yy</option>
                                        <option value="yy-mm-dd">In USE - yyyy-mm-dd</option>
                                    </select>
                                    
                           </td>
                                      
                                      
                                      <td>                                   
                                                                            <?php  if(!$date && !empty($arr[4])){
                                                                                echo $arr[4];
                                                                                }?></td>

			
			
                   </tr>     
                   <tr><td></td>
                       <td><p><input type="submit" name="submit" value="Sign Up" style="color: #36AE79;height: 40px;width: 150px;font-size: 20px"></p></td></tr>
                      
                 
                   
                </table>
             </div>
          </fieldset>
        </form>     
                   
<?php  }   ?>             
                     
   </fieldset>
      
  <?php
       include("loginfooter.html");
  ?>
 