Nova.booting((Vue, router, store) => {
    // Detail
    Vue.component('detail-broadcaster-field', require('./components/Detail/BroadcasterField'));
    Vue.component('detail-broadcaster-belongsto-field', require('./components/Detail/BroadcasterBelongsToField'));
    Vue.component('detail-broadcaster-select-field', require('./components/Detail/BroadcasterSelectField'));
    Vue.component('detail-listener-currency-field', require('./components/Detail/ListenerCurrencyField'));
    Vue.component('detail-listener-field', require('./components/Detail/ListenerField'));
    Vue.component('detail-listener-hidden-field', require('./components/Detail/ListenerHiddenField'));

    // Form
    Vue.component('form-broadcaster-field', require('./components/Form/BroadcasterField'));
    Vue.component('form-broadcaster-belongsto-field', require('./components/Form/BroadcasterBelongsToField'));
    Vue.component('form-broadcaster-select-field', require('./components/Form/BroadcasterSelectField'));
    Vue.component('form-listener-currency-field', require('./components/Form/ListenerCurrencyField'));
    Vue.component('form-listener-field', require('./components/Form/ListenerField'));
    Vue.component('form-listener-hidden-field', require('./components/Form/ListenerHiddenField'));

    // Index
    Vue.component('index-broadcaster-field', require('./components/Index/BroadcasterField'));
    Vue.component('index-broadcaster-belongsto-field', require('./components/Index/BroadcasterBelongsToField'));
    Vue.component('index-broadcaster-select-field', require('./components/Index/BroadcasterSelectField'));
    Vue.component('index-listener-currency-field', require('./components/Index/ListenerCurrencyField'));
    Vue.component('index-listener-field', require('./components/Index/ListenerField'));
    Vue.component('index-listener-hidden-field', require('./components/Index/ListenerHiddenField'));

    // Button
    Vue.component('create-relation-custom-button', require('./components/Button/CreateRelationCustomButton'));
})
