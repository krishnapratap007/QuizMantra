<?php
 session_start();
 
    if(!isset($_SESSION['login_username'])){
         header("Location: signin.php");
       }
     
   include('header.php');
      

      $timesum=0;
      $marksum=0;
      $maxsequence=0;
      $maxpage=0;
      $pagecount=1;
   
    
                $conn= mysqli_connect("localhost","root","mummy","quizmantra");

                                                            
                       if($_COOKIE['subject']){
                              $sub=($_COOKIE['subject']);
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


<script>
    
function startTime() {
    var today = new Date();
    var h = today.getHours();
    var m = today.getMinutes();
    var s = today.getSeconds();
    // add a zero in front of numbers<10
    m = checkTime(m);
    s = checkTime(s);
    document.getElementById("txt").innerHTML = h+ ":" + m + ":" + s;
    t = setTimeout(function(){startTime()}, 500);
}

function checkTime(i) {
    if (i < 10) {
        i= "0" + i;
    }
    return i;
}

    var time=<?php echo $timesum;?>;
      time=time*60*1000;
     setTimeout(function () {  window.location.href = "/PHP/ScienceRegistration/signin.php";}, time ); //will call the function after 2 secs.
   
   
  
</script>
    



<body id="test" onload="startTime()">
       
    <fieldset class='loginwall2'  onload="timeout()">
             
            <fieldset><legend><font color='black'  size="6"><b style="font-family:  'Hoefler Text', Georgia, 'Times New Roman', serif;">TEST </b></font></legend>
                
                <table cellspacing="10" width="100%" style="font-weight: bold;">
                       
                    
                                           
                                  <tr><td style=" width: 40%; float: right;"><label>Subject : </label><?php echo $sub ?></td>
                                      <td style="width:30%;"><label>Time Duration : </label><?php echo $timesum.' '.'Min' ?></td>
                                      <td style="width:400px;"><label>No. of Question. : </label><?php echo $maxsequence ?></td>
                                  </tr>
                                  
                                  
                                     <tr>
                                         <td style=" width: 40%; float: right;"><label>No. of Pages  : </label><?php echo $maxpage ?></td>
                                         <td style=" width: 30%;"><label>No. of Questions per Page : </label><?php echo '8' ?></td>
                                         <td style=" width: 400px;"><label>Total Marks : </label><?php echo $marksum ?></td>
                                     </tr>
                                     
                                     <tr>
                                         <td style=" width: 40%;"><div style="color: green;" id="txt"></div></td>
                                         <td style=" width: 30%;"><label>Flaged Questions : </label><?php echo '8' ?></td>
                                         <td style=" width: 400px;"><label>Total Marks : </label><?php echo $marksum ?></td>
                                     </tr>
                                
                                            
                 </table>  
                
         </fieldset>  <br><br>
         <form action="testexecution.php" method="post">
            <div id="linkdiv">
                 
                     
                    <?php                 
                            $result2=mysqli_query($conn,"SELECT Sequenceno,Question,a,b,c,d,Flaged FROM testpaper WHERE Sub='$sub' AND Pageno='$pagecount' ");
                                   while($row2 = mysqli_fetch_array($result2)){
                                   
                    ?>
                
                <table width="100%">
                    <tr><td colspan="2"><?php echo ' '.$row2['Sequenceno'].' . '.$row2['Question']  ?></td></tr> 
                    <tr></tr>
                    <tr><td style="width: 30%;"><?php  echo 'a . '; ?><input type="radio" name="c1" value="a"> <?php echo $row2['a'] ?> </td><td style="width: 30%"><?php  echo 'b . '; ?><input type="radio" name="c1" value="b"> <?php echo $row2['b'] ?> </td> </tr>
                     <tr><td style="width: 30%"><?php  echo 'c . '; ?><input type="radio" name="c1" value="c"> <?php echo $row2['c'] ?> </td><td style="width: 30%"><?php  echo 'd . '; ?><input type="radio" name="c1" value="d"> <?php echo $row2['d'] ?> </td> </tr>
                      </table>
               <br>
                 <?php
                                     }
                 ?>  
               <p align="right"><input type="button" name="category" value="next" style="height: 30px;width: 150px;" /></p>
             </form>                    
            </div>
             
        </fieldset>
      
    <?php
          include("loginfooter.html");
  ?>
  