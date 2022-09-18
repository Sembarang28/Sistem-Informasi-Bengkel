//Login Sebagai User
document.getElementById("logUser").addEventListener("click", function(){
    document.querySelector(".userLgn").style.display = "flex";
})

//Login Sebagai Admin
document.getElementById("logAdmin").addEventListener("click", function(){
    document.querySelector(".adminLgn").style.display = "flex";
})

//Login Sebagai Owner
document.getElementById("logOwner").addEventListener("click", function(){
    document.querySelector(".ownerLgn").style.display = "flex";
})

//Close Form Login User
document.querySelector(".closeUser").addEventListener("click", function(){
    document.querySelector(".userLgn").style.display = "none";
})

//Close Form Login User
document.querySelector(".closeAdmin").addEventListener("click", function(){
    document.querySelector(".adminLgn").style.display = "none";
})

//Close Form Login User
document.querySelector(".closeOwner").addEventListener("click", function(){
    document.querySelector(".ownerLgn").style.display = "none";
})