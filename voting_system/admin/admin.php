<?php
 
require('qs_connection.php');
require_once('admin_users.php');
require_once('qs_functions.php');

$err_string = "";

@session_start();

// << END OF "after session init"  [Login To Admin]
@ob_start();
if (isset($_POST["act"])) {
    $userlevel = 0;
// >> START OF "before check user login" 
    $sql = "";
    $sql .= "  SELECT `username` , `password` , `leve` , `leve` FROM `admin`\n";
    $sql .= " WHERE ";
    $sql .= " `username` = '".qsrequest("User"). "'" ;
    $sql .= " AND `password` = '" .qsrequest("Password"). "'";
if(!$result = @mysql_query($sql)){
    $err_string .= "<strong>Error:</strong> while connecting to database<br>" . mysql_error();
}else{
    $num_rows = mysql_num_rows($result);
    $row = mysql_fetch_array($result);
}
if ($err_string != "") {
    print "<Center><Table Border=\"0\" Cellspacing=\"1\" bgcolor=\"#CCCCCC\" >";
    print "<tr>";
    print "<td height=\"80\" align=\"Default\" bgcolor=\"#FFFFFF\">";
    print "<font color=\"#000099\" size=\"2\">";
    print $err_string;
    print "</font>";
    print "</td>";
    print "</tr>";
    print "</Table></Center>";
    exit;
}
    if ($num_rows >0) {
        $userlevel = $row[2];
    }
    if ($result > 0) {
      mysql_free_result($result);
    }

    if (!$userlevel > 0) {
        $_SESSION["Admin_Logon"] = "TRUE";
        $_SESSION["Admin_UserLogon"] = qsrequest("User");
        $_SESSION["Admin_UserLevel"] = $userlevel;
        $RedirectURL = qssession("Admin_RedirectURL");
        if ($RedirectURL == "") {
          $RedirectURL = "home.php";
        }
        if (qssession("firstredirecturl") == "") {
          $_SESSION["firstredirecturl"] = $RedirectURL;

        }
         header ("Location: $RedirectURL");

        @ob_end_flush();
        exit;
    } else {
        $err_string = "Login failed";
    }
// >> START OF "after check secure level"  [Login To Admin]
} else{
    if ((qssession("Admin_UserLogon") != "") && (qssession("Admin_Logon") == "True")) {
        $err_string = "Permission failed";
    }
}
?>
<HTML>
<div class="wrap">

<HEAD>

<Title>Login To Admin</Title>
<link rel="icon" href="../pictures/favicon.jpg">

<link rel="stylesheet" type="text/css" href="candidate.css">
<link rel="stylesheet" type="text/css" href="./pictures/header_move.css">
<script type="text/javascript" src="./js/yahoo-min.js" ></script>
<script type="text/javascript" src="./js/dom-min.js" ></script>
<script type="text/javascript" src="./js/event-min.js" ></script>

<script type="text/javascript">

  
  // This should always happen first, any user custom-code should run after
  YAHOO.util.Event.onDOMReady( function() { qsPageOnLoadController(); } );  

</script>

<script type="text/javascript">

// Declares all constants and arrays
// for all page items used on the page

// Declare Field Indexes for all page items
var qsPageItemsCount = 3
var _Username                                 = 0;
var _Password                                 = 1;
var _Leve                                     = 2;

// Declare Fields Prompts
var fieldPrompts = [];
fieldPrompts[_Username] = "Username";
fieldPrompts[_Password] = "Password";
fieldPrompts[_Leve] = "Leve";

// Declare Fields Technical Names
var fieldTechNames = [];
fieldTechNames[_Username] = "Username";
fieldTechNames[_Password] = "Password";
fieldTechNames[_Leve] = "Leve";

// This function dynamically assigns element 'ID' attributes to all relevant elements
function qsAssignElementIDs() {

  // STEP 1: Assign an ID to all field PROMPTS (TD captions)
  // Scan all table TD tags for those that match field prompts
  var TDs = document.getElementsByTagName("td");
  for (var i=0; i < TDs.length; i++) {
    var element = TDs[i];
    // Check if the TD found is one of the Page Items header
    // This can only be an approximation as some TDs other than the actual field prompts
    // may contain the same caption. In that case all TDs found will carry the same ID.
    if (element.className == "ThRows" || element.className == "TrOdd") {
      for (var f=0; f < qsPageItemsCount; f++) {
        if (element.innerHTML == fieldPrompts[f]) {
            element.id = fieldTechNames[f] + "_caption_cell";
          element.innerHTML = "<div id='" + fieldTechNames[f] + "_caption_div'>" + element.innerHTML + "</div>";
        }
      }
    }
  }

  // STEP 2: Assign an ID to all Input controls on the form
  document.getElementsByName("4")[0].id = fieldTechNames[_Username];
  document.getElementsByName("5")[0].id = fieldTechNames[_Password];
}

// This function defines object names for all page items used on the page.
// You can refer to these objects in your JavaScript code and avoid getElementById().
// Entry Fields (when present) are accessible via their technical names.
// The prompts of Entry Fields (when present) are accessible using SomeItemName_Prompt object names.
// 
function qsPageItemsAbstraction() {
  qs_form   = document.getElementsByName("qs_login_form")[0];   //Define Form Object by Name.



}

</script>



<script type="text/javascript">

// This function dynamically assigns custom events
// to page item controls on this page
function qsAssignPageItemEvents() {
}

</script>




<script>

function usrEvent__Login_To_Admin__onload() {
  
}



function usrEvent__Login_To_Admin__onunload() {
  
}



function usrEvent__Login_To_Admin__onresize() {
  // >> START OF "Login To Admin -> On Resize" [onresize] 
}



// This function controls the OnUnload event dispatching
function qsPageOnUnloadController() {   
}



// This function controls the OnResize event dispatching
function qsPageOnResizeController() {   
   var lastResult = false                              
   return true;                                        
}                                                      



// This function controls the OnLoad events dispatching
function qsPageOnLoadController() {   
   var lastResult = false                              

   // Invoke the technical field names abstraction initialization
   qsPageItemsAbstraction();


   // Invoke the Element IDs assignment function
   qsAssignElementIDs();

   // Invoke the Page Items custom events assignments
   qsAssignPageItemEvents();
   // Assign Event Handlers for page-level events
   YAHOO.util.Event.addListener(window, "beforeunload", qsPageOnUnloadController);
   YAHOO.util.Event.addListener(window, "resize", qsPageOnResizeController);
   // Set focus on first enterable page item available
  document.getElementsByName("User")[0].focus(); 
   return true;                                        
}                                                      






function usrEvent__Login_To_Admin__onsubmit(frm) {
  // >> START OF "Login To Admin -> On Submit" [onsubmit] 
}



function usrEvent__Login_To_Admin__onreset() {
  
}



// This function controls the OnSubmit event dispatching
function qsFormOnSubmitController(frm) {                 
   var lastResult = false                              
   return true;                                        
}                                                      



// This function controls the OnReset event dispatching
function qsPageOnResetController() {   
   var lastResult = false                              
   return true;                                        
}                                                      


</script>


<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">

</HEAD>
<BODY>
<div class="wrap">
<div id="admin_login">
<Center>
<center><hr /><font size="5">
Login To Admin
</font><hr /></center><br>

<?php
// >> START OF "after page header"  
?>
<A NAME=top></A>

<table id="QS_Content_Layout_1_Table">
  <tr id="QS_Content_Layout_1_TopRow">
    <td id="QS_Content_Layout_1_NorthWest">
            <div id="QS_Content_Layout_1_NorthWestDiv">

        </div>
    </td>
    <td id="QS_Content_Layout_1_North">
            <div id="QS_Content_Layout_1_NorthDiv">

        </div>
    </td>
    <td id="QS_Content_Layout_1_NorthEast">
            <div id="QS_Content_Layout_1_NorthEastDiv">

        </div>
    </td>
  </tr>
  <tr id="QS_Content_Layout_1_MiddleRow">
    <td id="QS_Content_Layout_1_West">
            <div id="QS_Content_Layout_1_WestDiv">

        </div>
    </td>
    <td id="QS_Content_Layout_1_Center">
            <div id="QS_Content_Layout_1_CenterDiv">

<Form name="qs_login_form" method="post" action="" onSubmit="return qsFormOnSubmitController(this)"  onReset="return qsPageOnResetController(this)" >

<Table Border="0" Cellpadding="5" Cellspacing="2" BgColor="#FFFFFF">

<?php
$css_class = "\"TrOdd\"";
?>
<tr>
<td colspan="2" class="ThRows">Login To Admin</td>
</tr>
<?php
if ($err_string != "") {
    print "<tr>";
    print "<td class=\"ThRows\"><Strong>Error:</Strong></td>";
    print "<td class=" . $css_class . " align=Default>" . $err_string . "</td>";
    print "</tr>";
}
?>
<tr>
<td class="ThRows">Username:</td>
<td class="TrOdd" align=Default><input name="User" type="text"></td>
</tr>
<tr>
<td class="ThRows">Password:</td>
<td class="TrOdd" align=Default><input name="Password" type="password"></td>
</tr>
<div id="admin_login"><tr align="center">

<td colspan="5"><button>
<input type="hidden" name="act" value="n">
<input type="submit" name="QS_Submit" value="Submit"></button></td></tr></div>
</Table><br>
</Form>

</div>
        </div>
    </td>
    <td id="QS_Content_Layout_1_East">
            <div id="QS_Content_Layout_1_EastDiv">
<?php
// >> START OF "content layout 1 - east"
?>
        </div>
    </td>
  </tr>
  <tr id="QS_Content_Layout_1_BottomRow">
    <td id="QS_Content_Layout_1_SouthWest">
            <div id="QS_Content_Layout_1_SouthWestDiv">
<?php
// >> START OF "content layout 1 - south west" 
?>
        </div>
    </td>
    <td id="QS_Content_Layout_1_South">
            <div id="QS_Content_Layout_1_SouthDiv">
<?php
// >> START OF "content layout 1 -
?>
        </div>
    </td>
    <td id="QS_Content_Layout_1_SouthEast">
            <div id="QS_Content_Layout_1_SouthEastDiv">
<?php
// >> START OF "content layout 1 - south east" 
?>
        </div>
    </td>
  </tr>
</table>

<h2><a NAME=bottom href="index.php">BACK</a></h2>
<?php
// >> START OF "before page footer" 
?>
</Center></td>

</BODY>

</HTML>

