
<?php
error_reporting(0);
session_start();
include_once '../oesdb.php';
 include('../header.php');

 
 ?>
<fieldset class="loginwall2">
<fieldset><legend><font color='black'  size="4"><b style="font-family:  'Hoefler Text', Georgia, 'Times New Roman', serif;">TEST MANAGE </b></font></legend>

<?php

    if (!isset($_SESSION['admname'])) {
        $_GLOBALS['message'] = "Session Timeout.Click here to <a href=\"../index.php\">Re-LogIn</a>";
    }
    
    else if (isset($_REQUEST['logout'])) {
       unset($_SESSION['admname']);
      header('Location: ../index.php');
    }

    else if (isset($_REQUEST['dashboard'])) {
        header('Location: admwelcome.php');
    }
    
    else if (isset($_REQUEST['delete'])) {
            unset($_REQUEST['delete']);
            $hasvar = false;

                foreach ($_REQUEST as $variable) {


                    if (is_numeric($variable)) { 
                       $hasvar = true;

                       if (!@executeQuery("delete from test where testid=$variable")) {
                           if (mysql_errno () == 1451)
                                $_GLOBALS['message'] = "Too Prevent accidental deletions, system will not allow propagated deletions.<br/><b>Help:</b> If you still want to delete this test, then first delete the questions that are associated with it.";
                           else
                               $_GLOBALS['message'] = mysql_errno();
                        }
                    }
               }


            if(!isset($_GLOBALS['message']) && $hasvar == true)
                $_GLOBALS['message'] = "Selected Tests are successfully Deleted";


            else if (!$hasvar) {
                $_GLOBALS['message'] = "First Select the Tests to be Deleted.";
            }
     } 
     
     

        else if (isset($_REQUEST['savem'])) {
    
                $fromtime = $_REQUEST['testfrom'] . " " . date("H:i:s");
                $totime = $_REQUEST['testto'] . " 23:59:59";
                $_GLOBALS['message'] = strtotime($totime) . "  " . strtotime($fromtime) . "  " . time();
                
                
                if(strtotime($fromtime) > strtotime($totime) || strtotime($totime) < time())
                    $_GLOBALS['message'] = "Start date of test is less than end date or last date of test is less than today's date.<br/>Therefore Nothing is Updated";
                
                else if(empty($_REQUEST['testname']) || empty($_REQUEST['testdesc']) || empty($_REQUEST['totalqn']) || empty($_REQUEST['duration']) || empty($_REQUEST['testfrom']) || empty($_REQUEST['testto']) || empty($_REQUEST['testcode'])) {
                  
                    $link="PHP/quizmantra/admin/testmng.php?edit=".$_SESSION['link'];
                 
                   echo '<script type="text/javascript">'; 
                   echo 'alert("Some of fields are Remaining, Please Try Again");'; 
          
                  //  echo 'window.location.href = '.$link;
                  echo '</script>';
                  
                 
                    $_GLOBALS['message'] = "Some of the required Fields are Empty.Therefore Nothing is Updated";
                } 
                
                else {
                    $query = "update test set testname='" . htmlspecialchars($_REQUEST['testname'], ENT_QUOTES) . "',testdesc='" . htmlspecialchars($_REQUEST['testdesc'], ENT_QUOTES) . "',subid=" . htmlspecialchars($_REQUEST['subject'], ENT_QUOTES) . ",testfrom='" . $fromtime . "',testto='" . $totime . "',duration=" . htmlspecialchars($_REQUEST['duration'], ENT_QUOTES) . ",totalquestions=" . htmlspecialchars($_REQUEST['totalqn'], ENT_QUOTES) . ",testcode='" . htmlspecialchars($_REQUEST['testcode'], ENT_QUOTES) . "'where testid=" . $_REQUEST['testid'] . ";";
                   
                    if (!@executeQuery($query))
                        $_GLOBALS['message'] = mysql_error();
                    else
                        $_GLOBALS['message'] = "Test Information is Successfully Updated.";
                }
                
                closedb();
        }
        
        
        
          else if (isset($_REQUEST['savea'])) {
    
                $noerror = true;
                $fromtime = $_REQUEST['testfrom'] . " " . date("H:i:s");
                $totime = $_REQUEST['testto'] . " 23:59:59";
                
                
                    if(strtotime($fromtime) > strtotime($totime) || strtotime($fromtime) < (time() - 3600)) {
                         $noerror = false;
                         $_GLOBALS['message'] = "Start date of test is either less than today's date or greater than last date of test.";
                    }

                    else if((strtotime($totime) - strtotime($fromtime)) <= 3600 * 24) {
                        $noerror = true;
                        $_GLOBALS['message'] = "Note:<br/>The test is valid upto " . date(DATE_RFC850, strtotime($totime));
                    }



                       $result = executeQuery("select max(testid) as tst from test");
                       $r = mysql_fetch_array($result);
                       
                       
                    if (is_null($r['tst'])){
                        $newstd = 1;
                    }
                    
                    else{
                        $newstd=$r['tst'] + 1;
                    }
                    
                          if(strcmp($_REQUEST['subject'], "<Choose the Subject>") == 0 || empty($_REQUEST['testname']) || empty($_REQUEST['testdesc']) || empty($_REQUEST['totalqn']) || empty($_REQUEST['duration']) || empty($_REQUEST['testfrom']) || empty($_REQUEST['testto']) || empty($_REQUEST['testcode'])) {
                                  $_GLOBALS['message'] = "Some of the required Fields are Empty";
                             } 
                             
                          else if ($noerror){
                             
                               $query = "insert into test values($newstd,'" . htmlspecialchars($_REQUEST['testname'], ENT_QUOTES) . "','" . htmlspecialchars($_REQUEST['testdesc'], ENT_QUOTES) . "',(select curDate()),(select curTime())," . htmlspecialchars($_REQUEST['subject'], ENT_QUOTES) . ",'" . $fromtime . "','" . $totime . "'," . htmlspecialchars($_REQUEST['duration'], ENT_QUOTES) . "," . htmlspecialchars($_REQUEST['totalqn'], ENT_QUOTES) . ",0,'" . htmlspecialchars($_REQUEST['testcode'], ENT_QUOTES) . "',NULL)";
      
                               if (!@executeQuery($query)) {
                                   if (mysql_errno () == 1062)
                                       $_GLOBALS['message'] = "Given Test Name voilates some constraints, please try with some other name.";
                                   else
                                       $_GLOBALS['message'] = mysql_error();
                               }
      
                               else{
                                   $_GLOBALS['message'] = $_GLOBALS['message'] . "<br/>Successfully New Test is Created.";
                               }
    
                                   
                           }
   
                  closedb();

                               
             }
             
             
            else if(isset($_REQUEST['manageqn'])) {

                        $testname = $_REQUEST['manageqn'];
                        $result = executeQuery("select testid from test where testname='" . htmlspecialchars($testname, ENT_QUOTES) . "';");

                            if ($r = mysql_fetch_array($result)) {
                                $_SESSION['testname']=$testname;
                                $_SESSION['testqn']=$r['testid'];

                                header('Location: prepqn.php');
                            }
                }   
      ?>



    <html>
        <head>
        <title>Manage Tests</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <link rel="stylesheet" type="text/css" href="sc.css"/>
        <link rel="stylesheet" type="text/css" media="all" href="../calendar/jsDatePick.css" />
        <script type="text/javascript" src="../calendar/jsDatePick.full.1.1.js"></script>
        <script type="text/javascript">
            window.onload = function(){
                new JsDatePick({
                    useMode:2,
                    target:"testfrom"
                    //limitToToday:true <-- Add this should you want to limit the calendar until today.
                });

                new JsDatePick({
                    useMode:2,
                    target:"testto"
                    //limitToToday:true <-- Add this should you want to limit the calendar until today.
                });
            };
        </script>

        <script type="text/javascript" src="../validate.js" ></script>
    </head>
        
        
        <body id="test">
            
            
                <?php
                if ($_GLOBALS['message']) {
                   echo "<div class=\"message\" style='float:right;'><font color='#A80707'><b>".$_GLOBALS['message']."</font></b></div>";
                }
                ?>
                        <div id="container">
                            <div class="header">

                            </div>
           <form name="testmng" action="testmng.php" method="post">
                              
                                     <div style="width:60%;height:80%;border:1px solid #000;padding-left:30%;border-color: #36AE79;">
                                           <div class="menubar">

                                         <table id="menu"><tr style="float:right;">
                                        
                                        
                        <?php
                        if (isset($_SESSION['admname'])) {
                        ?>
                                                <td><input type="submit" value="ADMIN HOME" name="dashboard" class="subbtn" title="Dash Board" style="color: #36AE79;height: 40px;width: 180px" /></td>

                        <?php
                            if(isset($_REQUEST['add'])) {
                        ?>
                                                <td><input type="submit" value="Cancel" name="cancel" class="subbtn" title="Cancel" style="color: #36AE79;height: 40px;width: 180px" /></td>
                                                <td><input type="submit" value="Save" name="savea" class="subbtn" onclick="validatetestform('testmng')" title="Save the Changes" style="color: #36AE79;height: 40px;width: 180px" /></td>

                        <?php
                            }

                            else if(isset($_REQUEST['edit'])) { 
                        ?>
                                                <td><input type="submit" value="Cancel" name="cancel" class="subbtn" title="Cancel" style="color: #36AE79;height: 40px;width: 180px" /></td>
                                                <td><input type="submit" value="Save" name="savem" class="subbtn" onclick="validatetestform('testmng')" title="Save the changes" style="color: #36AE79;height: 40px;width: 180px" /></td>

                        <?php
                            } 

                            else{ 
                        ?>
                                                <td><input type="submit" value="Delete" name="delete" class="subbtn" title="Delete" style="color: #36AE79;height: 40px;width: 180px" /></td>
                                                <td><input type="submit" value="Add" name="add" class="subbtn" title="Add" style="color: #36AE79;height: 40px;width: 180px" /></td>
                        <?php }
                         ?>
                         <td style="padding-left:50px;"><b> Hello </b><font color='#74D8FF'><b><?php 
                                                                                                     echo $_SESSION['admname'];

                                                      ?></b></font> ,Welcome to <b>Quiz Mantra | <input type="submit" value="LogOut" name="logout" class="subbtn" title="Log Out" style="color: #36AE79;height: 40px;width: 180px" /></b></td>
                                                 <?php
                         } 
                        ?>
                                            </tr></table>

                                        </div>
                                     </div>

                                   <div class="page">
                        <?php

                
                if (isset($_SESSION['admname'])) {

                    if (isset($_REQUEST['forpq']))
                        echo "<div class=\"pmsg\" style=\"text-align:center\"> Which test questions Do you want to Manage? <br/><b>Help:</b>Click on Questions button to manage the questions of respective tests</div>";
                    if (isset($_REQUEST['add'])) {

                ?>
                              
                                    <table cellpadding="20" cellspacing="20" style="text-align:left;" >
                                        <tr>
                                            <td>Subject Name</td>
                                            <td>
                                                <select name="subject">
                                                    <option selected value="<Choose the Subject>">&lt;Choose the Subject&gt;</option>
               

                 <?php
                        $result = executeQuery("select subid,subname from subject;");
                        
                            while ($r = mysql_fetch_array($result)) {
                                echo "<option value=\"" . $r['subid'] . "\">" . htmlspecialchars_decode($r['subname'], ENT_QUOTES) . "</option>";
                            }
                            
                        closedb();
                ?>
                                                </select>
                                            </td>

                                        </tr>
                                        
                                        
                                        <tr>
                                            <td>Test Name</td>
                                            <td><input type="text" name="testname" value="" size="16" onkeyup="isalphanum(this)" /></td>
                                            <td><div class="help"><b>Note:</b><br/>Test Name must be Unique<br/> in order to identify different<br/> tests on same subject.</div></td>
                                        </tr>
                                        <tr>
                                            <td>Test Description</td>
                                            <td><textarea name="testdesc" cols="20" rows="3" ></textarea></td>
                                            <td><div class="help"><b>Describe here:</b><br/>What the test is all about?</div></td>
                                        </tr>
                                        
                                        <tr>
                                            <td>Total Questions</td>
                                            <td><input type="text" name="totalqn" value="" size="16" onkeyup="isnum(this)" /></td>

                                        </tr>
                                        
                                        <tr>
                                            <td>Duration(Mins)</td>
                                            <td><input type="text" name="duration" value="" size="16" onkeyup="isnum(this)" /></td>

                                        </tr>
                                        
                                        <tr>
                                            <td>Test From </td>
                                            <td><input id="testfrom" type="text" name="testfrom" value="" size="16" readonly /></td>
                                        </tr>
                                        
                                        <tr>
                                            <td>Test To </td>
                                            <td><input id="testto" type="text" name="testto" value="" size="16" readonly /></td>
                                        </tr>

                                        <tr>
                                            <td>Test Secret Code</td>
                                            <td><input type="text" name="testcode" value="" size="16" onkeyup="isalphanum(this)" /></td>
                                            <td><div class="help"><b>Note:</b><br/>Candidates must enter<br/>this code in order to <br/> take the test</div></td>
                                        </tr>

                                    </table>
                                  

                <?php
                    }
                    
                    else if (isset($_REQUEST['edit'])) {

                        $result = executeQuery("select t.totalquestions,t.duration,t.testid,t.testname,t.testdesc,t.subid,s.subname,t.testcode as tcode,DATE_FORMAT(t.testfrom,'%Y-%m-%d') as testfrom,DATE_FORMAT(t.testto,'%Y-%m-%d') as testto from test as t,subject as s where t.subid=s.subid and t.testname='" . htmlspecialchars($_REQUEST['edit'], ENT_QUOTES) . "';");
                        
                        if (mysql_num_rows($result) == 0) {
                            header('Location: testmng.php');
                         } 
                         
                        else if ($r = mysql_fetch_array($result)) {

                   ?>
                                    <table cellpadding="20" cellspacing="20" style="text-align:left;margin-left:15em" >
                                        <tr>
                                            <td>Subject Name</td>
                                            <td>
                                                <select name="subject">
                   <?php
                            $result = executeQuery("select subid,subname from subject;");
                            
                            while ($r1 = mysql_fetch_array($result)) {
                                if (strcmp($r['subname'], $r1['subname']) == 0)
                                    echo "<option value=\"" . $r1['subid'] . "\" selected>" . htmlspecialchars_decode($r1['subname'], ENT_QUOTES) . "</option>";
                                else
                                    echo "<option value=\"" . $r1['subid'] . "\">" . htmlspecialchars_decode($r1['subname'], ENT_QUOTES) . "</option>";
                            }
                            closedb();
                  ?>
                                                </select>
                                            </td>

                                        </tr>
                                        
                                        <tr>
                                            <td>Test Name</td>
                                            <td><input type="hidden" name="testid" value="<?php echo $r['testid']; ?>"/><input type="text" name="testname" value="<?php echo htmlspecialchars_decode($r['testname'], ENT_QUOTES); $_SESSION['link']=htmlspecialchars_decode($r['testname'], ENT_QUOTES); ?>" size="16" onkeyup="isalphanum(this)" /></td>
                                            <td><div class="help"><b>Note:</b><br/>Test Name must be Unique<br/> in order to identify different<br/> tests on same subject.</div></td>
                                        </tr>
                                        
                                        <tr>
                                            <td>Test Description</td>
                                            <td><textarea name="testdesc" cols="20" rows="3" ><?php echo htmlspecialchars_decode($r['testdesc'], ENT_QUOTES); ?></textarea></td>
                                            <td><div class="help"><b>Describe here:</b><br/>What the test is all about?</div></td>
                                        </tr>
                                        
                                        <tr>
                                            <td>Total Questions</td>
                                            <td><input type="text" name="totalqn" value="<?php echo htmlspecialchars_decode($r['totalquestions'], ENT_QUOTES); ?>" size="16" onkeyup="isnum(this)" /></td>

                                        </tr>
                                        
                                        <tr>
                                            <td>Duration(Mins)</td>
                                            <td><input type="text" name="duration" value="<?php echo htmlspecialchars_decode($r['duration'], ENT_QUOTES); ?>" size="16" onkeyup="isnum(this)" /></td>

                                        </tr>
                                        
                                        <tr>
                                            <td>Test From </td>
                                            <td><input id="testfrom" type="text" name="testfrom" value="<?php echo $r['testfrom']; ?>" size="16" readonly /></td>
                                        </tr>
                                        
                                        <tr>
                                            <td>Test To </td>
                                            <td><input id="testto" type="text" name="testto" value="<?php echo $r['testto']; ?>" size="16" readonly /></td>
                                        </tr>

                                        <tr>
                                            <td>Test Secret Code</td>
                                            <td><input type="text" name="testcode" value="<?php echo htmlspecialchars_decode($r['tcode'], ENT_QUOTES); ?>" size="16" onkeyup="isalphanum(this)" /></td>
                                            <td><div class="help"><b>Note:</b><br/>Candidates must enter<br/>this code in order to <br/> take the test</div></td>
                                        </tr>

                                    </table>
                <?php
                                              closedb();
                                 }
                    }

                  else {

                        $result = executeQuery("select t.testid,t.testname,t.testdesc,s.subname,t.testcode as tcode,DATE_FORMAT(t.testfrom,'%d-%M-%Y') as testfrom,DATE_FORMAT(t.testto,'%d-%M-%Y %H:%i:%s %p') as testto from test as t,subject as s where t.subid=s.subid order by t.testdate desc,t.testtime desc;");
                            
                        if (mysql_num_rows($result) == 0) {
                                 echo "<h3 style=\"color:#0000cc;text-align:center;\">No Tests Yet..!</h3>";
                              } 
                              
                            else {
                                                    $i = 0;
                                                   
                ?>
                                                    <table cellpadding="30" cellspacing="10" class="datatable">
                                                        <tr>
                                                            <th>&nbsp;</th>
                                                            <th>Test Description</th>
                                                            <th>Subject Name</th>
                                                            <th>Test Secret Code</th>
                                                            <th>Validity</th>
                                                            <th>Edit</th>
                                                            <th style="text-align:center;">Manage<br/>Questions</th>
                                                        </tr>
                <?php
                                                    while ($r = mysql_fetch_array($result)) {
                                                        $i = $i + 1;
                                                        if ($i % 2 == 0)
                                                            echo "<tr class=\"alt\">";
                                                        else
                                                            echo "<tr>";
                                                        echo "<td style=\"text-align:center;\"><input type=\"checkbox\" name=\"d$i\" value=\"" . $r['testid'] . "\" /></td><td> " . htmlspecialchars_decode($r['testname'], ENT_QUOTES) . " : " . htmlspecialchars_decode($r['testdesc'], ENT_QUOTES)
                                                        . "</td><td>" . htmlspecialchars_decode($r['subname'], ENT_QUOTES) . "</td><td>" . htmlspecialchars_decode($r['tcode'], ENT_QUOTES) . "</td><td>" . $r['testfrom'] . " To " . $r['testto'] . "</td>"
                                                        . "<td class=\"tddata\"><a title=\"Edit " . htmlspecialchars_decode($r['testname'], ENT_QUOTES) . "\"href=\"testmng.php?edit=" . htmlspecialchars_decode($r['testname'], ENT_QUOTES) . "\"><img src=\"../images/edit.png\" height=\"30\" width=\"40\" alt=\"Edit\" /></a></td>"
                                                        . "<td class=\"tddata\"><a title=\"Manage Questions of " . htmlspecialchars_decode($r['testname'], ENT_QUOTES) . "\"href=\"testmng.php?manageqn=" . htmlspecialchars_decode($r['testname'], ENT_QUOTES) . "\"><img src=\"../images/mngqn.png\" height=\"30\" width=\"40\" alt=\"Manage Questions\" /></a></td></tr>";
                                           
                                                      
                                                    }
                ?>
                                                </table>
           <?php
                                   }
                                closedb();
                       }
              }
           ?>

                </div>
            </form>

        </div>
    </body>
    
</fieldset>
</fieldset>
<?php
   include('../loginfooter.html');
