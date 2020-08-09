const frondsConfigSym = Symbol("fronds_config");
const eventsSym = Symbol("events");

export class Fronds {

    constructor(config) {
        this[frondsConfigSym] = config;
        this[eventsSym] = [];
    }
    get version() {
        return "0.1.0";
    }

    /**
     * This only returns a single element, the first in the set
     * @param {string} dataAttrName The portion after the data- prefix in a custom attribute
     * @param {string} dataAttrValue The value that will be used to select on
     * @returns {Element}
     */
    static getFirstByDataName(dataAttrName, dataAttrValue) {
        return document.querySelectorAll(`[data-fronds-${dataAttrName}='${dataAttrValue}']`)[0];
    }

    /**
     *
     * @param {Event} event
     */
    attachEvent(event) {
        this[eventsSym].push(event);
    }
}