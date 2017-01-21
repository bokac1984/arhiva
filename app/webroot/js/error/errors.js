$(document).ready(function() {
    $(document).on('click', '.ip-address', function(e) {
    e.preventDefault();
    var posClicked = $(this).position();
    var newPos = posClicked;
    newPos.left += 20;
    
    var Ip = $(this).parent().find('.search-address').html();

    
    var newTop = newPos.top + 130;
    
    $.ajax({
      type: 'POST',
      url: '/error_manager/error_logs/getIpData',
      data: {ip: Ip},
      dataType: "json",
      success: function(data) {
          var info = JSON.parse(data);
        var resultDiv = "<div><dl><dt>Hostname</dt><dd>"+info.hostname+"</dd>\n\
<dt>Country</dt><dd>"+info.country+"</dd><dt>Region</dt><dd>"+info.region+"</dd><dt>City</dt><dd>"+info.city+"</dd>\n\
<dt>Location</dt><dd>"+info.loc+"</dd><dt>Organisation</dt><dd>"+info.org+"</dd></dl>";
$('body').append("<div class='ip-results' style='top: "+newTop+"px; left: "+newPos.left+"px;'><div class='arrow-left'></div>"+resultDiv+"</div>");
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