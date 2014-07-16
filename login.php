<?php 
session_start();

include('db.php');

  $user= mysqli_real_escape_string($conn,$_POST['email']);
  $pass= mysqli_real_escape_string($conn,$_POST['password']);

  
    $fetch=mysqli_query($conn,"SELECT Name,Role FROM Registration WHERE Email='$user' AND Pass='$pass' ");
    $count=mysqli_num_rows($fetch);
    
      
    
    if($count!="")
    {
        
        $_SESSION['login_username']=$user;
        
        while($rows= mysqli_fetch_array($fetch)){
            
                 if($rows['Role']=='0' || $rows['Role']=='2'){
                     header("Location: adminteacherpanel.php"); 
               } 
                 
                 else{
                      header("Location: teststudent.php"); 
                 }
        }
       
        
         
    }
    else
    {
    include('header.php');
        ?>



     <body id="register">
       
         <fieldset class='loginwall'>
             
                 <table><tr>
                          <td  style="padding-left:600px;"> <a href="home.php" name="home"><button id="home" style="height: 40px; width: 200px;">&Longleftarrow; Home</button></a></td>
                           <td> <a href="signup.php" name="signup"><button id="signup" style="height: 40px; width: 200px;">&dbkarow; Sign UP</button></a></td>
                           <td> <a href="contact.php" name="datahistory"><button id="contactbutt" style="height: 40px; width: 200px;">Contact US</button></a></td>
                           <td style="padding-left:100px;"><p class="error"><b> <font color="#74D8FF">Sorry! You Have Not Registered User Please <em>Sign UP</em> Then Log In</font></b></p></td>
                       </tr>

                   </table>

             <form method="post" action="login.php" name="login">
               <fieldset><legend><font color='white'><b>SIGN IN :</b></font></legend>
            
                 <div id='loginarea'>
                   <table cellpadding='15'>
                       <tr><td rowspan="5" style="padding-right: 200px">
                               <img src="http://3.bp.blogspot.com/_HsXEqUxv8gU/S-SbezUBYmI/AAAAAAAAA2c/sddG5Nylpok/s1600/science+logo+copy.jpg" width="900" height="500"></img>
                           </td>
                      
                       <tr>
                           <td style="padding-top: 100px"><label><font color='white'>Email ID : </label></td>
                           <td style="padding-top:  100px"><input type="email" class="loginmail" name="email" size="21" maxlength="30" required="required" value="<?php   

                                                                                                                if(!empty($_POST['email'])){
                                                                                                                  echo $_POST['email'];}
                                                                                                             ?>" />
                                                     </td>
                                                     
                       </tr>
                       <tr>
                                                     
                            <td ><label><font color='white'>Password  : </label></td>
                            <td ><input type='password' class="loginpass" name="password" size="21" maxlength="20" required="required" value="<?php 
                                                                                                                if(!empty($_POST['password'])){
                                                                                                                echo $_POST['password'];
                                                                                                            }
                                                                                                            ?>" />
                                                     </td>

                                                     
                       </tr>  
                       
                       <tr>
                            <td style="padding-bottom: 200px"><p align="center"><input type="submit" name="submit" value="Log In"></p></td>
                                                     
                       </tr>
                       <tr>      
                            
                                                     
                    </tr> 
                      
                  </table>
               </div>
            </fieldset>
          </form>
            
    </fieldset>
      
      <?php

   }

?>

