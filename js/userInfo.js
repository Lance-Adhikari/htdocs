function loadUserInfo() {
var xmlhttp = new XMLHttpRequest();
xmlhttp.onreadystatechange = function() {
  if (this.readyState == 4 && this.status == 200) {
     
    var userInfoJson = JSON.parse(this.responseText);
    document.getElementById("uid").value = userInfoJson["userid"];
    document.getElementById("fn").value = userInfoJson.firstName;
    document.getElementById("ln").value = userInfoJson.lastName;
    document.getElementById("pn").value = userInfoJson.phoneNumber;
    document.getElementById("em").value = userInfoJson.email;
    document.getElementById("myImg").src = userInfoJson.picture;
    document.getElementById("myImg2").src = userInfoJson.picture;
    document.getElementById("myImg3").src = userInfoJson.picture;
  } 
};
xmlhttp.open("GET", "php/account.php", true);
xmlhttp.send();
}