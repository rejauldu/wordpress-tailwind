/**
 * The navbar class
 */
class Navbar {
    navbar: HTMLElement | null;
	
	navMenu: HTMLElement | null;

    navbarToggler: HTMLElement | null;

    /**
     * Construct function
     */
    constructor() {
        this.navbar = document.querySelector( '.navbar' );
        this.navMenu = document.querySelector('.i4t-collapse.navbar-collapse');
        this.navbarToggler = document.querySelector('[data-bs-toggle="collapse"].navbar-toggler');

        this.events();
    }

    /**
     * Attaches event listeners to the hamburger icon and close menu icon to toggle the mobile navigation menu.
     * @function events
     * @memberof [Name of the class or component where this function is defined]
     * @returns {void}
     */
    events() {
        this.navbarToggler?.addEventListener('click', (event: Event) => {
            this.toggleMobileNavigationMenu(event);
        });
		window.onscroll = () => {
            this.changeNavbarVisibility();
        }
    }

    /**
     * Toggles the mobile navigation menu and updates the styling of related elements.
     *
     * @param {Event} event - The event object triggered by the navigation menu toggle action.
     *
     * @description
     *
     * This function handles the toggling of the mobile navigation menu and updates the styling of the navigation bar and header elements accordingly. It prevents event propagation and default action to ensure proper functioning.
     *
     * @params event
     * @returns {void}
     */
    toggleMobileNavigationMenu(event: Event) {
        event.stopPropagation();
        event.preventDefault();
        event.stopImmediatePropagation();
        if ( this.navMenu ) {
            if ( this.navMenu?.classList.contains( "show" ) ) {
                this.hideNavbar();
            } else {
                this.showNavbar();
            }
        }
    }

    /**
     * Displays the navbar by adding the "show" class and removing the "bs-collapse" class.
     * Initiates the collapsing animation and sets the height to the scrollHeight.
     * After the animation duration, removes the "collapsing" class, adds the "bs-collapse" class, and resets the height to null.
     *
     * @returns {void}
     */
    showNavbar () { 
        this.navMenu?.classList.add( 'show' );
        this.navMenu?.classList.remove( 'i4t-collapse' );
        this.navMenu?.classList.add( 'collapsing' );
        if(this.navMenu)
            this.navMenu.style.height = this.navMenu?.scrollHeight + "px";
        setTimeout(() => {
            this.navMenu?.classList.remove( 'collapsing' );
            this.navMenu?.classList.add( 'i4t-collapse' );
            if(this.navMenu)
                this.navMenu.style.height = null as any;
        }, 350 );
    }

    /**
     * Hides the navbar by setting its height to scrollHeight, initiating the collapsing animation,
     * and removing the "show" class. After the animation duration, resets the height to null,
     * removes the "collapsing" class, and adds the "bs-collapse" class.
     *
     * @returns {void}
     */
    hideNavbar () {
        if(this.navMenu)
            this.navMenu.style.height = this.navMenu?.scrollHeight + "px";
        this.navMenu?.classList.add( 'collapsing' );
        
        this.navMenu?.classList.remove( 'i4t-collapse' );
        this.navMenu?.classList.remove( 'show' );
        //
        setTimeout(() => {
            if(this.navMenu)
                this.navMenu.style.height = null as any;
        }, 0);
        setTimeout(() => {
            this.navMenu?.classList.remove( 'collapsing' );
            this.navMenu?.classList.add( 'i4t-collapse' );
        }, 350);
    }
	 
	changeNavbarVisibility() {
        if ( window.scrollY > 180 ) {
            this.navbar?.classList.add('sticky-top');
        } else {
            this.navbar?.classList.remove('sticky-top');
        }
    }
}

export default Navbar;
