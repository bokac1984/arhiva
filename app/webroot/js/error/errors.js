$(document).ready(function() {
    $(document).on('click', '#ip-address', function(e) {
    e.preventDefault();
    var posClicked = $(this).position();
    console.log(posClicked.left);
    var newPos = posClicked;
    newPos.left += 20;
    
    $.ajax({
      type: 'POST',
      url: 'http://api.hostip.info/get_json.php',
      data: {ip: $('#search-address').html()},
      dataType: "json",
      success: function(data) {
        var resultDiv = "<div><dl><dt>Country Name</dt><dd>"+data.country_name+"</dd>\n\
<dt>City</dt><dd>"+data.city+"</dd></dl>";
$('body').append("<div class='ip-results' style='top: "+newPos.top+"px; left: "+newPos.left+"px;'><div class='arrow-left'></div>"+resultDiv+"</div>");
      }
    });
  });
  
  $(document).mouseup(function(e)
  {
    var container = $(".ip-results");

    if (!container.is(e.target) // if the target of the click isn't the container...
            && container.has(e.target).length === 0) // ... nor a descendant of the container
    {
      container.remove();
    }
  });
});