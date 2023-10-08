import template from './sw-product-detail-upselling.html.twig'

const {mapState} = Shopware.Component.getComponentHelper();
const {Context} = Shopware;
const {Criteria} = Shopware.Data;

Shopware.Component.register('sw-product-detail-upselling', {
    data() {
        return {
            context: null,
            upsellingProducts: new Map,
            criteria: null,
            productRepository: null,
            productUpsellingRepository: null,
        }
    },
    inject: ['repositoryFactory', 'systemConfigApiService'],

    computed: {
        ...mapState('swProductDetail', [
            'product',
        ]),

        hasUpsellingProductIds() {
           return this.upsellingProducts && this.upsellingProducts.length > 0;
        },

        upsellingProductIds() {
            console.log('upsellingProductIds', this.upsellingProducts);
            return Array.from(this.upsellingProducts.keys());
        }
    },

    methods: {
        async updateUpsellingProductIds(newUpsellingProductIds) {
            this.upsellingProducts.forEach(async (upsellingEntity, upsellingProductId, map) => {
                await this.productUpsellingRepository.delete([upsellingEntity.id]);
            });

            newUpsellingProductIds.forEach(async newUpsellingProductId => {
                let upsellingEntity = this.productUpsellingRepository.create(Context.api);
                upsellingEntity.productId = this.product.id;
                upsellingEntity.upsellingProductId = newUpsellingProductId;
                await this.productUpsellingRepository.save(upsellingEntity, Shopware.Context.api);
            });

            this.loadUpsellingProducts();
        },

        async loadUpsellingProducts() {
            if (!this.product || !this.product.extensions || !this.product.extensions.upsellingProducts) {
                return [];
            }

            const criteria = new Criteria();
            criteria.addFilter(Criteria.equals('productId', this.product.id));

            const upsellingProducts = new Map();
            await this.productUpsellingRepository.search(criteria, {...Context.api, inheritance: true}).then(
                (upsellingEntities) => {
                    upsellingEntities.forEach(upsellingEntity => {
                        upsellingProducts.set(upsellingEntity.upsellingProductId, upsellingEntity);
                    });
                });

            this.upsellingProducts = upsellingProducts;
        }
    },

    template,

    created() {
        this.context = {...Shopware.Context.api};
        this.criteria = new Shopware.Data.Criteria();
        this.productRepository = this.repositoryFactory.create('product');
        this.productUpsellingRepository = this.repositoryFactory.create('product_upselling');
    },

    watch: {
        product() {
            this.loadUpsellingProducts();
        }
    }
})