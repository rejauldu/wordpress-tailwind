/**
 * The navbar class
 */
class Accordion {
    panels: NodeListOf<HTMLElement> | null;

    /**
     * Construct function
     */
    constructor() {
        // Grab the elements
        this.panels = document.querySelectorAll('.panel');
        this.events();
    }

    /**
     * Attaches event listeners to the hamburger icon and close menu icon to toggle the mobile navigation menu.
     *
     * @memberof Accordion
     */
    events() {
        this.panels?.forEach((panel, index) => {
            panel?.querySelector('.panel-heading')?.addEventListener('click', e => {
                this.togglePanel(e, index);
            });
        });
    }

    /**
     * Toggles the mobile navigation menu and updates the styling of related elements.
     *
     * This function handles the toggling of the mobile navigation menu and updates the styling of the navigation bar and header elements accordingly. It prevents event propagation and default action to ensure proper functioning.
     *
     * @param {Event} event
     * @param {number} currentIndex
     * @memberof Accordion
     * @returns {void}
     */
    togglePanel(event: Event, currentIndex: number) {
        const currentTarget = event.target as HTMLElement;

        this.panels?.forEach((panel, i) => {
            if (i !== currentIndex) {
                panel.querySelector('.panel-heading')?.classList.remove('active');
                panel.querySelector('.panel-content')?.classList.remove('show');
            }
        });

        currentTarget?.parentElement?.querySelector('.panel-heading')?.classList.add('active');
        currentTarget?.parentElement?.querySelector('.panel-content')?.classList.add('show');
    }
}

export default Accordion;
