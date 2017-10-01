$("#form1").submit(function() {
 
   var $form = $(this);
   $.ajax({
               type: "POST",
               url: "commend/addPersonal",
               data: $form.serialize(),
               success: function(data){
                           alert(data);
                       }
   });
   return false;
});