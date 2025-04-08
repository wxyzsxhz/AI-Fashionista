const container = document.querySelector('.container');

const cloneContainer = container.cloneNode(true);
cloneContainer.id = "dark-container";
document.body.appendChild(cloneContainer);
cloneContainer.classList.remove ('active');

const toggleIcons = document.querySelectorAll('.toggle-icon');
const icons = document.querySelectorAll('.toggle-icon i');
const darkContainer = document.querySelector('#dark-container');

const darkContainerImg = document.querySelector('#dark-container .home-img img');

darkContainerImg.style.width = '450px'; // You can change '200px' to your desired width.
darkContainerImg.style.height = '450px'; // You can change '150px' to your desired height.
darkContainerImg.style.position = 'relative'; 
darkContainerImg.style.right = '50%'; 
darkContainerImg.style.margin = '50%'; 
darkContainerImg.src = "image/image2.png";

const darkContainerLogo = document.querySelector('#dark-container .logo img');
darkContainerLogo.src = "image/logo2.png";

toggleIcons.forEach(toggle => {
toggle.addEventListener ('click' , () => {

toggle.classList.add('disabled');
         setTimeout(() => 
         {
             toggle.classList.remove('disabled');
         }, 1500);
        
         icons.forEach(icon => 
         {
             icon.classList.toggle('bx-sun');
         });

         container.classList.toggle('active');
         darkContainer.classList.toggle('active');
     });
 });

 darkHeader.forEach(toggle => 
     {
         toggle.addEventListener ('click' , () => 
         {
    
             toggle.classList.add('disabled');
             setTimeout(() => 
             {
                 toggle.classList.remove('disabled');
             }, 1500);
            
             icons.forEach(icon => 
             {
                 icon.classList.toggle('bx-sun');
             });
    
             container.classList.toggle('active');
             darkContainer.classList.toggle('active');

         });
     });