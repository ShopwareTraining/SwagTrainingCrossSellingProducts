import './component/sw-product-detail-upselling';

Shopware.Module.register('swag-training-cross-selling-products', {
    routeMiddleware(next, currentRoute) {
        if (currentRoute.name === 'sw.product.detail') {
            currentRoute.children.push({
                name: 'sw.product.detail.upselling',
                component: 'sw-product-detail-upselling',
                path: 'upselling',
                meta: {
                    parentPath: 'sw.product.index',
                    privilege: 'product.viewer',
                },
            });
        }
        next(currentRoute);
    }
});
