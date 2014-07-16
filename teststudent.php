<?php
   session_start();
    if(!isset($_SESSION['login_username'])){
         header("Location: signin.php");
       }
       
       
      include('header.php');
   
   ?>
    

    <body id="register">
        
     
       
         <fieldset class='loginwall'>
             
             
          <table>
              <tr>
                <td style="padding-left:250px;"><a href="logout.php" name="signin"><button id="signin" style="height: 40px; width: 200px;">&dbkarow; New Login</button></a></td>
                <td> <a href="userregistrationhistory.php" name="userhistory"><button id="historybutt" style="height: 40px; width: 200px;">User Registration History</button></a></td>
                <td> <a href="courseregistrationhistory.php" name="coursehistory"><button id="coursehistorybutt" style="height: 40px; width: 220px;">Course Registration History</button></a></td>
                <td> <?php  
                                       
                                   $updateloginlink ="/PHP/ScienceRegistration/updateloginhtml.php";
                                   
                                  
		             echo "<a href=\"javascript:create_window('$updateloginlink','500','800')\"><button id='edit' style='height: 40px; width: 200px;'>Update Login Data</button></a></td>";?>
                    
                 
                <td> <a href="contact.php" name="datahistory"><button id="contactbutt" style="height: 40px; width: 200px;">Contact US</button></a></td>
                
                <td style="padding-left:50px;"><b> Hello </b><font color='#74D8FF'><b><?php 
                                                                                             echo $_SESSION['login_username'];
                                                                                    
                
                                                                                            //    echo $rowsc[Name];
                                               ?></b></font> ,Welcome to <b>Quiz Mantra | <a href="logout.php">LogOut</a> </b> </td>
          </tr>
            
         </table>
             
             
            <fieldset><legend><font color='black'  size="6"><b style="font-family:  'Hoefler Text', Georgia, 'Times New Roman', serif;">TEST SESSION </b></font></legend>
                
            <div id="linkdiv">
                
                <table><tr>
                        <td style="padding-bottom: 0%;padding-left: 2%;padding-right: 40%;"><div style="width:90%; background-image:url(images/tree.jpg) ;height:370px; width:650px; background-size: 650px 450px"><p style="font-family:  'Hoefler Text', Georgia, 'Times New Roman', serif;"> <table cellpadding="15" cellspacing="10"><tr><td colspan="8" style="padding-left:60%;">Science</td></tr><tr><td colspan="3" style="padding-left:100%;">Computers</td><td colspan="2">History</td><td colspan="2">Languages</td></tr><tr><td colspan="2" style="padding-left:100%;">GK</td><td colspan="2">Programming</td><td colspan="2">Environment</td><td colspan="2">Aptitute</td></tr><tr><td colspan="3" style="padding-left:100%;">English</td><td colspan="2">Current GK</td><td colspan="3">Technology</td></tr></table><td>  <div></td>
                        
                           <td style="padding-left:35%;width:70%;" rowspan="2">
                              <div style="width:70%;height:80%;border:5px solid #000;padding-left:5%;border-color: #36AE79">                    
                           
                                
                                <table>
                                   <tr>
                                      <td>  
                                          
                                           <table cellspacing="10">
                                            
                                            <form method="post" action="teststudent.php" name="test">
                                           
                                               <tr><td><label style="font-size: 25px;">Category : <hr></td></tr>
                                                  
                                                <tr><td><input type="submit" name="category" value="Aptitute" style="height: 30px;width: 150px;" /></td> </tr>
                                                <tr><td><input type="submit" name="category" value="Business" style="height: 30px;width: 150px;" /></td></tr>
                                                 <tr><td><input type="submit" name="category" value="Computer" style="height: 30px;width: 150px;" /></td></tr>
                                                 <tr> <td><input type="submit" name="category" value="Engineering" style="height: 30px;width: 150px;"  /></td></tr>
                                                  <tr><td><input type="submit" name="category" value="English" style="height: 30px;width: 150px;" /></td></tr>
                                                  <tr> <td><input type="submit" name="category" value="GK" style="height: 30px;width: 150px;" /></td></tr>
                                                  <tr>  <td><input type="submit" name="category" value="Programming" style="height: 30px;width: 150px;" /></td></tr>
                                                   <tr> <td><input type="submit" name="category" value="Reasoning" style="height: 30px;width: 150px;"  /></td></tr>
                                                  <tr>  <td><input type="submit" name="category" value="Science" style="height: 30px;width: 150px;"  /></td> </tr>
                                                  <tr> <td><input type="submit" name="category" value="Technology" style="height: 30px;width: 150px;" /></td><tr>
                                                 
                                             </form> 
                                          </table>
                                            
                                       </td>
                                   
                                            
                                            
                                            
                                            
                                    <td style="float:left;">   
                                        <form method="post" action="testsession.php">
                                           <table cellpadding='10'>
                                                    
                                              <tr><td><label style="font-size: 25px;">Subject : <hr></td></tr>
                                                 <tr>
                                                   <td>
                                                        <?php 
                                                            function options($result){

                                                                  echo "<select name='subjects' style='height:40px;width:200px;>";
                                                                          while($row = mysqli_fetch_array($result))
                                                                               {
                                                                                 echo "<option name='subjects'>" . $row['Sub'] . "</option>";
                                                                              }
                                                                    echo "</select>"; 
                                                                 }  
                                                                 
                                                          if($_SERVER['REQUEST_METHOD']=='POST'){ 

                                                               $conn= mysqli_connect("localhost","root","mummy","quizmantra");

                                                               if(isset($_POST['category'])){
                                                                if($_POST['category']){
                                                                      $cat=$_POST['category'];
                                                                          $result=mysqli_query($conn,"SELECT Sub FROM Category WHERE Cat='$cat' ");

                                                                            options($result); 
                                                                }
                                                               }


                                                            } ?>

                                                    </td>
                                                  </tr>
                                                    
                                                <tr><td style="padding-top:70%;"><label>Suffle Questions :</label><input type="checkbox" name="suffle" value="suffle" /></td></tr>
                                                <tr> <td><label>Disable Time :</label><input type="checkbox" name="disabletime" value="disabletime" /></td></tr>
                                                <tr><td><input type="submit" value="TEST START" style="height: 30px; width: 200px; background-color: #C0FAE7"></td></tr>
                                                <tr><td><a href="footer.php"><input type="button" value="TEST HISTORY" style="height: 30px; width: 200px; background-color: #C0FAE7"></a></td></tr>
  
                                            </form>        
                                          </table>
                                                
                                       </td>
                                      </tr>
                                           
                                 </table>
                                            
                                            
                                        
                            </div>       
                          </td>  
                       </tr>
                      <tr>
                              <td style="padding-bottom: 0%;padding-left: 2%;padding-right: 40%;"><div style="width:90%; background-image:url(images/whiteboardhome.jpg) ;height:320px; width:600px; background-size: 600px 320px"><p style="padding-top: 5%;padding-left: 5%;font-family:  'Hoefler Text', Georgia, 'Times New Roman', serif;"><em><b>Quiz Mantra</b></em> provides online quizzes <br>and different subject's tests. <em><b>Online quizzes</b></em> are a popular form of entertainment for web surfers. Online quizzes are generally for entertainment and knowledge purposes though some online quiz like us. Websites feature online quizzes on many subjects.<br><br>Mantra Quizzes are set up to actually test knowledge or identify a person's attributes. <br>Some companies use online quizzes as an efficient way of testing a potential hire's knowledge without that candidate needing to travel. Online dating services often use personality quizzes to find a match between similar members.</p></td>
                      </tr>
                 </table>  
           </div>
         </fieldset>
                
        </fieldset>
      
    <?php
          include("loginfooter.html");
  ?>
  