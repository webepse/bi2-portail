/* JS pour le menu */

/* select des élements pour le menu (balise html) */
const burger = document.querySelector("#burger")
const menuMobile = document.querySelector("#menu-mobile")

/* select multiple (querySelector ALL) */
const links = document.querySelectorAll("#menu-mobile nav ul li a")
console.log(links)

console.log(burger)
/* écouteur d'event pour cliquer sur menu */
/* node.addEvenListener(evenement, function anym ou flechée avec instruction à faire lors de l'event) */
burger.addEventListener('click',()=>{
    /* ajouter une class et toggle c'est ajoute ou supprime automatiquement */
    burger.classList.toggle('open')
    menuMobile.classList.toggle('open-menu')
})

/* boucler un tableau car j'ai fait une select multiple (querySelectorAll) */
links.forEach(lien => {
    lien.addEventListener('click', () => {
        /* pas de toggle ici, tout ce que je veux faire c'est retirer les classes de mes éléments */
        burger.classList.remove('open')
        menuMobile.classList.remove('open-menu') 
    })
})

// array.forEach(function anonyme)

// function a ou flechée :   (paramètres) => {instruction}

/* array.forEach((iteration){
    instruction : action à faire sur chaque itération
})*/

// const bi2 = ["JS","Elise","Gregor","Lionel","Liza","Maude","Maxime","Lisa","Maxence"]
// console.log(bi2)

// bi2.forEach((student) => {
//     console.log(student)
// })

// for(let cpt = 0; cpt<= 8; cpt++)
// {
//     console.log(cpt + " :" + bi2[cpt])
// }

// // array map 

// const tab = [1,2,3,4,5]
// const newTab = tab.map((ite)=>{
//     return ite+1
// })
// console.log(newTab)
// console.log(tab)
