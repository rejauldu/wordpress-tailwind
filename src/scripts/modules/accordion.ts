import { getElementTopPosition, getParentElement } from '../utils/helpers';

class Accordion {
    // dropdownMenu: NodeListOf<Element>;
    // hamburger: HTMLElement | null;
    // body: HTMLBodyElement | null;
    // navBar: HTMLElement | null;
    // header: HTMLElement | null;
    // headerContainer: HTMLElement | null;
    // windowWidth: number;
    // containerWidth: number;
    accordionItems: NodeListOf<Element>;
    body: HTMLBodyElement | null;

    constructor() {
        this.accordionItems = document.querySelectorAll('.accordion__item');
        this.body = document.querySelector('body');
        // Grab the elements
        this.events();
    }

    events() {
        this.accordionItems.forEach((element) => {
            element.addEventListener('click', (event) => {
                this.closeOtherAccordionItems(element);
                this.openCurrentAccordionItem(event, element);
            });
        });
    }

    openCurrentAccordionItem(event: Event, element: Element) {
        const target = event.target as Element;
        event.preventDefault();
        event.stopImmediatePropagation();

        const targetedElement = getParentElement(target, 'accordion__item') as Element;

        if (target === element) {
            this.disableBodyScroll();
            target.classList.toggle('accordion__item--active');
            setTimeout(() => {
                window.scrollTo(0, getElementTopPosition(element as HTMLElement) - 200);
                this.enableBodyScroll();
            }, 400);
        }

        if (targetedElement) {
            this.disableBodyScroll();
            targetedElement.classList.toggle('accordion__item--active');
            setTimeout(() => {
                window.scrollTo(0, getElementTopPosition(targetedElement as HTMLElement) - 200);
                this.enableBodyScroll();
            }, 400);
        }
    }

    closeOtherAccordionItems(element: Element) {
        this.accordionItems.forEach((currentElement) => {
            if (element !== currentElement) currentElement.classList.remove('accordion__item--active');
        });
    }

    disableBodyScroll() {
        if (this.body?.style !== undefined) {
            this.body.style.overflowY = 'hidden';
        }
    }

    enableBodyScroll() {
        if (this.body?.style !== undefined) {
            this.body.style.overflowY = 'unset';
        }
    }
}

export default Accordion;
