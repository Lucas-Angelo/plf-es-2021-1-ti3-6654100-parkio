

var baseUrl = window.location.origin;
$.ajaxSetup({
    headers: {
        'Authorization': 'Bearer ' + getCookie('X-token'),
    },
    beforeSend: function(xhr, options) {
        if(options.url.substr(0,4) != 'http') options.url = baseUrl + options.url;
    },
    complete: function(xhr, options) {
        if(xhr.status == 401) {
            alert("Permissão Negada!")
            window.location.href = '/auth'
        }
    }
})

function getCookie(cname) {
  var name = cname + "=";
  var ca = decodeURIComponent(document.cookie).split(';');
  for(var i = 0; i <ca.length; i++) {
      var c = ca[i];
      while (c.charAt(0) == ' ')
          c = c.substring(1);
      if (c.indexOf(name) == 0)
          return c.substring(name.length, c.length);
  }
  return "";
}