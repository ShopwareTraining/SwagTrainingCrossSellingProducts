import template from './sw-product-detail-upselling.html.twig'

Shopware.Component.register('sw-product-detail-upselling', {
    data() {
      return {
          context: null,
          productIds: [],
          criteria: null,
          repository: null
      }
    },
    inject: ['repositoryFactory', 'systemConfigApiService'],

    computed: {
        getProductIds() {
            console.log('Product IDs', this.productIds);
            return this.productIds.join(', ');
        }
    },

    methods: {
        updateProductIds(values) {
            this.productIds = values;
        }
    },

    template,

    created() {
        this.systemConfigApiService.getValues('SwagTrainingUpsellingProducts.config.products')
            .then((values) => {
                Object.keys(values).forEach((key) => {
                    this.productIds.push(values[key]);
                });
            });

        this.context = { ...Shopware.Context.api };
        this.criteria  = new Shopware.Data.Criteria();
        this.repository = this.repositoryFactory.create('product');
    },
})