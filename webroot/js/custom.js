/* When the user clicks on the button, 
toggle between hiding and showing the dropdown content */
function myFunction() {
    document.getElementById("myDropdown").classList.toggle("show");
}

// Close the dropdown menu if the user clicks outside of it
window.onclick = function(event) {
  if (!event.target.matches('.menu-dropbtn')) {

    var dropdowns = document.getElementsByClassName("dropdown-content");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }
  }
}


// function openCollapse() {
// 	var coll = document.getElementsByClassName("collapsible");
// 	var i;

// 	for (i = 0; i < coll.length; i++) {
// 	    coll[i].addEventListener("click", function() {
// 	        this.classList.toggle("active");
// 	        var content = this.nextElementSibling;
// 	        if (content.style.display === "block") {
// 	            content.style.display = "none";
// 	        } else {
// 	            content.style.display = "block";
// 	        }
// 	    });
// 	}
// }

// function expander(id, maxheight, time) {
//     var slice = document.getElementById(id);
//     var height = Number(slice.style.height.replace('px', ''));
//     var expandRate = maxheight / time;
//     var i = 0;

//     var timer = setInterval(function () {
//         height = height + expandRate;

//         if (i < time) {
//             i++;
//             slice.style.height = height + 'px';
//         } else {
//             clearInterval(timer);
//         }
//     }, 1);
// }

// function reducer(id, minHeight, time) {
//     var slice = document.getElementById(id);
//     var height = Number(slice.style.height.replace('px', ''));
//     var collapseRate = Math.abs(height - minHeight) / time;
//     var i = 0;

//     var timer = setInterval(function () {
//         height = height - collapseRate;

//         if (i < time) {
//             i++;
//             slice.style.height = height + 'px';
//         } else {
//             clearInterval(timer);
//         }
//     }, 1);
// }