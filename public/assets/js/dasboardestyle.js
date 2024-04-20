const leftSideMenu=document.querySelector("aside");
const menuBtn=document.querySelector("#menu-btn");
const closeBtn=document.querySelector("#close-btn");
const themeToggler=document.querySelector(".theme-toggler");


//show sidebare
menuBtn.addEventListener('click',()=>{
    leftSideMenu.style.display='block'
});

//close side bare
closeBtn.addEventListener('click',()=>{

    leftSideMenu.style.display='none'
})
// relade in resece fix css fast
window.onresize = function(){ location.reload();}

themeToggler.addEventListener('click',()=>{ 
document.body.classList.toggle('dark-theme-variables');
// now we just need to switch active icone from this 2
themeToggler.querySelector('span:nth-child(1)').classList.toggle('active');
themeToggler.querySelector('span:nth-child(2)').classList.toggle('active');
});



// JavaScript to show/hide the menu and close it when clicking outside
document.addEventListener("DOMContentLoaded", function() {
  var menuImage = document.getElementById("menuImage");
  var menu = document.getElementById("action");

  // Show/hide the menu when clicking the image
  menuImage.addEventListener("click", function(event) {
      if (menu.style.display === "none") {
          menu.style.display = "block";
      } else {
          menu.style.display = "none";
      }
      event.stopPropagation(); // Prevent the click event from bubbling up
  });

  // Close the menu when clicking outside of it
  document.addEventListener("click", function(event) {
      if (event.target !== menuImage && !menu.contains(event.target)) {
          menu.style.display = "none";
      }
  });
});



  