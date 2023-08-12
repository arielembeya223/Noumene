
<script>
 let headers = document.querySelectorAll(".nav-link") 
 let sum = 0
 for(let header of headers){

    header.addEventListener("click",function(){
         sum++
    if(sum>1){
        for(let navs of headers){
            navs.classList.remove("active")
        }
    }
            header.classList.add("active")
    })
 }
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>
</html>