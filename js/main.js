 function trie(){
    console.log("bonjour")
}
/*
  function headers(){
let links = document.querySelectorAll(".nav-link")
    for(let link of links){
      link.addEventListener("click",function(e){
          for(let nav of links){
              nav.classList.remove("text-success")
          }
          link.classList.remove("nav-link")
      })
    }
  }
  */
 function form(){
      let name=document.querySelector(".regex-nom")
      name.addEventListener("keyup",function(e){
         let current= e.currentTarget.value
         let div = document.querySelector(".regex-ajout")
    if (current.match(/[^AZa-z0-9\.]/)){
     div.classList.remove("d-none")
   }else{
      if(div.classList.contains("d-none")){
          
      }else{
          div.classList.add("d-none")
      }
   }
      })
  }
  function autogrow(){
    let textarea= document.querySelector(".autogrow")
    textarea.addEventListener("focus",function(e){
      textarea.style.overflow="hidden"
      textarea.style.height=textarea.scrollHeight + "px";
    })
    textarea.addEventListener("input",function(e){
      textarea.style.overflow="hidden"
      textarea.style.height=textarea.scrollHeight + "px";
    })
  }
  trie() 
form()
autogrow()
