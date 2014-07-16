// Make a pop-up window function:
var n,link;
 function create_window (image, width,height) {

    width = (+width) +  10;
    height = (+height) + 10;

        if (window.popup && !window.popup.closed) {
                window.popup.resizeTo(width, height);
        }
   
       var specs = "'width=" + width + ", height=" + height+ "', location=yes,scrollbars=yes, menubars=no,toolbars=no, resizable=no,left=300, top=200" ;
        var url = image;
                // Create the pop-up window:
             
              popup = window.open(url, "ImageWindow",specs);
                popup.focus( );
  } // End of function
  
  function loginAlert(link){
      alert("You have to Login First for Updating Profile");
      window.location=link;
  }
 
  
  
  function open_window(url,email){
      var n;
      alert("Please Login First for UPDATING Profile !!");
      alert(email);
     n=window.open(url);
       // n.document.open("text/html","replace");
      //  n.document.write($('emailjs').html());
      n.document.getElementById('abc').value="bgsd";
     // window.opener.document.getElementById('abc').value = 'something';
    //  n.document.getElementById('emailjs')
       
     // $('emailjs', n.document).val('1');
   }