        //Need Explaination todo:
    document.getElementById('userIcon').innerHTML = "<?php echo substr($userName, 0, 1); ?>"

        document.getElementById('userName').innerHTML = "<?php echo $userName; ?>"
       
        function myFunction(x) {
            if (x.matches) { // If media query matches
                document.getElementById("mySidebar").style.width = "200px";
                document.getElementById("close-btn").style.display = "none";
                document.getElementById("main").style.marginLeft = "200px";
                document.getElementById("logo").style.removeProperty("height");
                document.getElementById("logo").style.removeProperty("width");
                document.getElementById("logo").style.marginRight = "200px";
                // document.getElementById("mySidebar").style.removeProperty("display");
            } else {
                // MOBILE PE
                document.getElementById("mySidebar").style.removeProperty("width");
                document.getElementById("mySidebar").style.width = "0";
                document.getElementById("open-btn").style.margin = "15px 15px";
                document.getElementById("logo").style.height = "55px";
                document.getElementById("logo").style.width = "193px";
                document.getElementById("logo").style.marginRight = "0";
                document.getElementById("open-btn").style.height = "55px";
                document.getElementById("open-btn").style.margin = "0px";
                document.getElementById("mySidebar").style.width = "0";
                document.getElementById("main").style.marginLeft = "0";
                document.getElementById("close-btn").style.removeProperty("display");
            }
        }

        var x = window.matchMedia("(min-width: 992px)")
        myFunction(x) // Call listener function at run time
        x.addListener(myFunction) // Attach listener function on state changes


        function openNav() {
            document.getElementById("mySidebar").style.width = "200px";
            // document.getElementById("mySidebar").style.display = "block";
        }

        function closeNav() {
            document.getElementById("mySidebar").style.width = "0";
        }
