/**
 *  * Return all the parent element of a given element
 *  * if an selector is given than return true
 *
 * @param {Element | null} node
 * @param {string} targetParent
 * @returns {Array<Element> | boolean}
 */
export const parents = (node: Element | null, targetParent = ''): Array<Element> | boolean => {
    const parentElements: Array<Element> = [];

    while (node) {
        const parentNode = node?.parentNode as Element;

        if (targetParent && parentNode?.classList?.contains(targetParent)) return true;

        parentElements.push(node);
        node = node.parentNode as Element;
    }

    return parentElements || [];
};

/**
 * Retrieves the top position of an HTML element relative to its offset parent.
 * If the element is null, the function returns 0.
 *
 * @param {HTMLElement | null} element The HTML element for which to retrieve the top position.
 * @returns {number} The top position of the element relative to its offset parent.
 */
export const getElementTopPosition = (element: HTMLElement | null): number => {
    return element ? element.offsetTop + getElementTopPosition(element.offsetParent as HTMLElement) : 0;
};

/**
 * Returns the parent element of a given node that matches the specified selector.
 *
 * @param {Element | null} node - The node whose parent element is to be found.
 * @param {string} targetParentSelector - The selector to match the parent element against.
 * @returns {Array<Element> | Element | boolean} - The parent element(s) that match the selector, or false if no matching parent element is found.
 */
export const getParentElement = (
    node: Element | null,
    targetParentSelector = ''
): Array<Element> | Element | boolean => {
    let parentElement: Element | null = null;

    while (node) {
        const parentNode = node?.parentNode as Element;

        if (targetParentSelector && parentNode?.classList?.contains(targetParentSelector)) {
            return (parentElement = parentNode);
        }

        node = node.parentNode as Element;
    }

    return parentElement || false;
};
