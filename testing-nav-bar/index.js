function toggleNav() {
    var sidenav = document.getElementById("mySidenav");
    var main = document.getElementById("main");
    
    if (sidenav.style.width === "250px") {
      sidenav.style.width = "0";
      main.style.marginLeft = "0";
    } else {
      sidenav.style.width = "250px";
      main.style.marginLeft = "250px";
    }
  }
  