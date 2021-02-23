export default function initDropdownMenu(){
    fetch("/api/pages/menu/eb54ac405903a46249b719b87e6068bb")
        .then((res) => res.json())
        .then((fullNavItems) => {
            const fullNav = document.querySelector(".full-nav");
            const fullNavBtn = document.querySelector(".full-nav__button");
            const fullNavContent = document.querySelector(".full-nav-lightbox-content");


            fullNavBtn.addEventListener("click", openMenu);

            function openMenu() {
              fullNavBtn.classList.add(".full-nav__transform");
              fullNav.classList.remove("full-nav-lightbox--closed");
              fullNav.classList.add("full-nav-lightbox--opened");
            }
        
            fullNavBtn.addEventListener("click", closeMenu);

            function closeMenu() {
              fullNavBtn.classList.remove(".full-nav__transform");
              fullNav.classList.remove("full-nav-lightbox--opened");
              fullNav.classList.add("full-nav-lightbox--closed");
            }
            



            fullNavBtn.addEventListener(
              "click",
              toggleActiveClassOnParticularGroupList
            );
        
            
            function createElement(className) {
              const result = document.createElement("div");
              result.classList.add(className);
              return result;
            }

            function constructLink(item) {
              const fullNavItemLink = createLinkElement(
                "full-nav-lightbox-content-item__link"
              );
              fullNavItemLink.innerText = item.title;
              fullNavItemLink.href = item.ref;
              return fullNavItemLink;
            }

            function createLinkElement(className) {
              const result = document.createElement("a");
              result.classList.add(className);
              return result;
            }
            

        
            fullNavItems.forEach(function(group) {
              const fullNavItem = createElement("full-nav-lightbox-content-item");
        
              const fullNavItemTitle = createElement(
                "full-nav-lightbox-content-item__title"
              );
              fullNavItemTitle.innerText = group.title;
        
              const fullNavItemList = createElement(
                "full-nav-lightbox-content-item__list"
              );
        
              const fullNavItemLink = constructLink(group);
              fullNavItemList.appendChild(fullNavItemLink);
        
              group.subPages.forEach(function(item) {
                const fullNavItemLink = constructLink(item);
                fullNavItemList.appendChild(fullNavItemLink);
              });
        
              fullNavItems.appendChild(fullNavItemTitle);
              fullNavItems.appendChild(fullNavItemList);
        
              fullNavItems.appendChild(fullNavItem);
            });
        
            
        
            function toggleActiveClassOnParticularGroupList(e) {
              /*if (window.innerWidth > 640) return;*/
        
              if (isFullNavItemTitle(e.target)) {
                const fullNavItemList = e.target.nextElementSibling;
        
                if (fullNavItemList.getBoundingClientRect().height !== 0) {
                  fullNavItemList.style.setProperty("height", "0px");
                  return;
                }
        
                fullNavItemList.style.setProperty("height", "unset");
                const menuGroupListHeight = `${
                  fullNavItemList.getBoundingClientRect().height
                }px`;
        
                fullNavItemList.style.setProperty("height", "0px");
                setTimeout(() => {
                  fullNavItemList.style.setProperty("height", fullNavItemListHeight);
                }, 0);
              }
            }
        
            function isFullNavItemTitle(element) {
              return element.classList.contains("full-nav-lightbox-content-item__title");
            }
        
            
        
            
        
            
          });
}