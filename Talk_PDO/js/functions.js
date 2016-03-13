$(document).ready(function(){
   $('#login_form').submit(function(evt){
       evt.preventDefault();
       $.ajax({
               url:'controller/login.php',
               type:'post',
               data:$('#login_form').serialize(),
               success:function(data) {
                   if(data==="ok")
                       window.location='view/homepage.php';
                   else alert(data);
               },
               error: function(xhr, ajaxOptions, thrownError) {
                            alert(xhr.status);
                            alert(thrownError); 
                            }
              });
          });   
});

