var base_url = 'http://localhost/repo/';
var usuario = '';
var token = '';

function getDataFromCookie(cdata) {
  let data = cdata + "=";
  let portion = document.cookie.split(';');
  for(let i = 0; i < portion.length; i++) {
    let c = portion[i];
    while (c.charAt(0) == ' ') {
      c = c.substring(1);
    }
    if (c.indexOf(data) == 0) {
      return c.substring(data.length, c.length);
    }
  }
  return "";
}

function checkUserFromCookie() {
  let u = getDataFromCookie("username");
  if (u == "") {
    window.location.replace(base_url + "aut/entrar");
  } else {
    usuario = u;
  }
}

function checkTokenFromCookie(){
  let t = getDataFromCookie("token");
  if (t == "") {
    window.location.replace(base_url + "aut/entrar");
  } else {
    token = t;
  }
}

checkUserFromCookie();
checkTokenFromCookie();
