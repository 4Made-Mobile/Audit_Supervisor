/*jshint browser:true */
/*global $ */(function()
{
 "use strict";
 /*
   hook up event handlers 
 */
 function register_event_handlers()
 {
     
     $(document).on("click", "#limparform", function(evt){
         limpar_campos();
     });
     
     $(document).on("click", "#limparfeedback", function(evt){
         limpar_campos();
     });
    
  }
 document.addEventListener("app.Ready", register_event_handlers, false);
})();
