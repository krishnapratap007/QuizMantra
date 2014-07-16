<?php
 session_start();
    if(!isset($_SESSION['login_username'])){
         header("Location: signin.php");
       }
     
       include('header.php');
       setcookie('subject');

      $timesum=0;
      $marksum=0;
      $maxsequence=0;
      $maxpage=0;

                                                               
                $conn= mysqli_connect("localhost","root","mummy","quizmantra");

                                                            
                       if($_POST['subjects']){
                              $sub=$_POST['subjects'];
                            
                              setcookie('subject', $sub);
                      
                               
                                  $result=mysqli_query($conn,"SELECT MAX(Sequenceno),SUM(Marks),SUM(Time),MAX(Pageno) FROM testpaper WHERE Sub='$sub' ");

                                     while($row = mysqli_fetch_array($result))
                                                                     {
                                                                      $timesum=$row['SUM(Time)'];
                                                                        $marksum=$row['SUM(Marks)'];
                                                                        $maxsequence=$row['MAX(Sequenceno)'];
                                                                        $maxpage=$row['MAX(Pageno)'];

                                                                   }
                                                             
                        }


   
   ?>
    


    <body id="register">
       
         <fieldset class='loginwall'>
             
            <fieldset><legend><font color='black'  size="6"><b style="font-family:  'Hoefler Text', Georgia, 'Times New Roman', serif;">TEST SESSION </b></font></legend>
                
                
            <div id="linkdiv">
                
                <table><tr>
                        <td style="padding-bottom: 0%;padding-left: 2%;padding-right: 40%;"><div style="width:90%; background-image:url(images/tree.jpg) ;height:370px; width:650px; background-size: 650px 450px"><p style="font-family:  'Hoefler Text', Georgia, 'Times New Roman', serif;"> <table cellpadding="15" cellspacing="10"><tr><td colspan="8" style="padding-left:60%;">Science</td></tr><tr><td colspan="3" style="padding-left:100%;">Computers</td><td colspan="2">History</td><td colspan="2">Languages</td></tr><tr><td colspan="2" style="padding-left:100%;">GK</td><td colspan="2">Programming</td><td colspan="2">Environment</td><td colspan="2">Aptitute</td></tr><tr><td colspan="3" style="padding-left:100%;">English</td><td colspan="2">Current GK</td><td colspan="3">Technology</td></tr></table><td>  <div></td>
                        
                           <td style="padding-left:35%;width:70%;" rowspan="2">
                              <div style="width:70%;height:80%;border:5px solid #000;padding-left:5%;border-color: #36AE79">                    
                           
                                
                                 
                                          
                                           <table cellspacing="10">
                                            
                                            <form method="post" action="testexecution.php" name="test">
                                           
                                               <tr><td><label style="font-size: 25px;">Overview : <hr></td></tr>
                                                  
                                                <tr><td colspan="2"><p><b>Rules and Regulations : </b>This Question Paper has no negative marking.only one option will be right. <p></td> </tr>
                                                <tr><td><label>Subject : </label></td><td><?php echo $sub ?></td></tr>
                                                <tr><td><label>Time Duration : </label></td><td><?php echo $timesum.' '.'Min' ?></td></tr>
                                                <tr> <td><label>No. of Question. : </label></td><td><?php echo $maxsequence ?></td></tr>
                                                 <tr><td><label>No. of Pages  : </label></td><td><?php echo $maxpage ?></td></tr>
                                                 <tr><td><label>No. of Questions per Page : </label></td><td><?php echo '5' ?></td></tr>
                                                  <tr><td><label>Total Marks : </label></td><td><?php echo $marksum ?></td></tr>
                                                   <tr><td><label>Marking System : </label></td><td><?php echo '% and Grading' ?></td></tr>
                                                 
                                                  
                                                  <tr> <td><input type="submit" name="category" value="START" style="height: 50px;width: 250px;" /></td><tr>
                                                 
                                             </form> 
                                          </table>
                                            
                                      
                                   
                                            
                                            
                                            
                                  
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
  