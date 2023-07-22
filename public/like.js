const checked = document.querySelectorAll(".checked button");
const like = document.getElementById("overall_like").getAttribute();
console.log(like)
checked.forEach((star, idx) =>{
    star.addEventListener("click", () => {
        checked.forEach((otherStar, otherIndex) =>{
            if(otherIndex <= idx){
                otherStar.classList.remove("off");
                otherStar.classList.add("active");
            }
            if(otherIndex > idx){
                otherStar.classList.remove("active");
                otherStar.classList.add("off");
            }
        })
        console.log(`star of index ${idx + 1} was clicked`);
    });
});
