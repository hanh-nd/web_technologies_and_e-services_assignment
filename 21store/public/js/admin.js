function onMenuClick() {
    const subMenuList = document.querySelectorAll(".sub-menu");
    for (let i = 0; i < subMenuList.length; i++) {
        const subMenu = subMenuList[i];
        if (window.getComputedStyle(subMenu).display === "none") {
            subMenu.style.display = "inline";
        } else {
            subMenu.style.display = "none";
        }
    }
}
