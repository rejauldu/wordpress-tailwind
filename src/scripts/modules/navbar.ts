import { parents } from 'utils/helpers';

class Navbar {
    hamburger: HTMLElement | null;
    navBar: HTMLElement | null;
    closeMenuIcon: HTMLElement | null;

    constructor() {
        // Grab the elements
        this.hamburger = document.querySelector('.hamburger');
        this.navBar = document.querySelector('.navigation-menu');
        this.closeMenuIcon = document.querySelector('.close-menu-icon');

        this.events();
    }

    /**
     * Attaches event listeners to the hamburger icon and close menu icon to toggle the mobile navigation menu.
     * @function events
     * @memberof [Name of the class or component where this function is defined]
     * @returns {void}
     */
    events() {
        this.hamburger?.addEventListener('click', (event: Event) => {
            this.toggleMobileNavigationMenu(event);
        });

        this.closeMenuIcon?.addEventListener('click', (event: Event) => {
            this.toggleMobileNavigationMenu(event);
        });
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
     * @param event
     * @returns {void}
     */
    toggleMobileNavigationMenu(event: Event) {
        event.stopPropagation();
        event.preventDefault();
        event.stopImmediatePropagation();

        this.navBar?.classList.toggle('navigation-menu--active');
        this.navBar?.classList.toggle('shadow-md');
        document.querySelector('.header')?.classList.toggle('shadow-md');
    }
}

export default Navbar;
