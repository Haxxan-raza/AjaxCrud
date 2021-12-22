$(document).ready(function(){
    $('#checkbox').click(function(){
        var element = document.body;         
        element.classList.toggle("dark"); 
    });
}); 

//new post
$(document).ready(function(){
    $("#create-new-post").on({
      mouseenter: function(){
        $(this).css("background-color", "blue");
      },  
      mouseleave: function(){
        $(this).css("background-color", "darkgray");
      }, 
      click: function(){
        $(this).css("background-color", "yellow");
      }  
    });
  });
  //search box
  $(document).ready(function(){
    $("#myInput").on("keyup", function() {
      var value = $(this).val().toLowerCase();
      $("#posts-crud tr").filter(function() {
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
      });
    });
  }); 