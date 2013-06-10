function leftsidebar() {
    if (document.getElementById('hideme')) {
       document.getElementById('hideme').id = "openme";
       document.getElementById('openme').style.display = "none";
    }
    else {
       document.getElementById('openme').id = "hideme";
       document.getElementById('hideme').style.display = "";
    }
}
