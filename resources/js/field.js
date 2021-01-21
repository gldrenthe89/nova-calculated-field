Nova.booting((Vue, router, store) => {
    Vue.component('index-broadcaster-field', require('./components/broadcaster-field/IndexField'));
    Vue.component('detail-broadcaster-field', require('./components/broadcaster-field/DetailField'));
    Vue.component('form-broadcaster-field', require('./components/broadcaster-field/FormField'));

    Vue.component('index-broadcaster-select-field', require('./components/broadcaster-select-field/IndexField'));
    Vue.component('detail-broadcaster-select-field', require('./components/broadcaster-select-field/DetailField'));
    Vue.component('form-broadcaster-select-field', require('./components/broadcaster-select-field/FormField'));

    Vue.component('index-broadcaster-belongsto-field', require('./components/broadcaster-belongsto-field/IndexField'));
    Vue.component('detail-broadcaster-belongsto-field', require('./components/broadcaster-belongsto-field/DetailField'));
    Vue.component('form-broadcaster-belongsto-field', require('./components/broadcaster-belongsto-field/FormField'));

    Vue.component('index-listener-field', require('./components/listener-field/IndexField'));
    Vue.component('detail-listener-field', require('./components/listener-field/DetailField'));
    Vue.component('form-listener-field', require('./components/listener-field/FormField'));

    Vue.component('index-listener-currency-field', require('./components/listener-currency-field/IndexField'));
    Vue.component('detail-listener-currency-field', require('./components/listener-currency-field/DetailField'));
    Vue.component('form-listener-currency-field', require('./components/listener-currency-field/FormField'));
})
