class ScrollHandler {

    constructor()
    {
        this.navbarClasses = document.querySelector('.navbar').classList;
        this.colorItems = document.querySelectorAll('.nav-link');
    }
	 OnScrollInput() {
        try {
            if (window.scrollY > 0) {
                navbarClasses.replace('bg-light', 'bg-dark');
                colorItems.forEach(function (colorItem) {
                    colorItem.setAttribute("style", "color: #fff;");
                });
            } else {
                navbarClasses.replace('bg-dark', 'bg-light');
                colorItems.forEach(function (colorItem) {
                    colorItem.setAttribute("style", "color: #000;");
                });
            }
        } catch (e) {
            try {
                console.log(e);
                this.navbarClasses = document.querySelector('.navbar').classList;
                this.colorItems = document.querySelectorAll('.nav-link');
            } catch (exception_in_exception) {
                console.log(exception_in_exception);
            }
        }
    }
}
