
<script>
   var bs= document.querySelectorAll(".nav-link");
   bs.addEventListener('click',function(){
    for(var i;i<bs.length;i++){
        var b=bs[i];
        b.classList.add("active")
        console.log("c'est bon")
    }
   })
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>
</html>