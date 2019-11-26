export default class Error {
    constructor() {
        this.clear();
    }
    set(errors) {
        this.errors = errors;
    }
    all(errors) {
        return this.errors;
    }
    clear(errors) {
        this.errors = {};
    }
    has(field, rule = null) {
        const hasProperty = this.errors.hasOwnProperty(field);
        if (rule === null) {
            return hasProperty;
        }
    }
}
