FooTable.MyFiltering = FooTable.Filtering.extend({
    construct: function (instance) {
        this._super(instance);
    },
    $create: function () {
        this._super();
        var self = this;
    },
});
