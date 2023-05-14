import { getElementTopPosition, getParentElement } from '../utils/helpers';

class Faq {
    faqItems: NodeListOf<Element>;
    body: HTMLBodyElement | null;

    constructor() {
        this.faqItems = document.querySelectorAll('.faq__item');
        this.body = document.querySelector('body');
        this.events();
    }

    events() {
        if (this.faqItems.length < 1) return;

        this.faqItems?.forEach((element) => {
            element.addEventListener('click', (event) => {
                this.closeOtherFaqItems(element);
                this.openCurrentFaqItem(event, element);
            });
        });
    }

    openCurrentFaqItem(event: Event, element: Element) {
        const target = event.target as Element;
        event.preventDefault();
        event.stopImmediatePropagation();

        const targetedDescription = element.querySelector('.faq__description');
        const faqIcon = element.querySelector('.faq-icon');
        const shortDescription = element.querySelector('.faq__short-description');

        targetedDescription?.classList.add('faq__description--active');
        faqIcon?.classList.add('faq-icon--active');
        shortDescription?.classList.add('faq__short-description--active');
    }

    closeOtherFaqItems(element: Element) {
        this.faqItems.forEach((currentElement) => {
            if (element !== currentElement) {
                const targetedDescription = currentElement.querySelector('.faq__description');
                const faqIcon = currentElement.querySelector('.faq-icon');
                const shortDescription = currentElement.querySelector('.faq__short-description');

                targetedDescription?.classList.remove('faq__description--active');
                faqIcon?.classList.remove('faq-icon--active');
                shortDescription?.classList.remove('faq__short-description--active');
            }
        });
    }
}

export default Faq;
