# SwagTrainingUpsellingProducts
**This Shopware plugin creates a new association `upsellingProducts` to add upselling products to a given product. It is a demo of how to setup a One-To-Many associations.**

## Proof of Concept
Run the following command where the first UUID belongs to a product which you want to extend and the second UUID belongs to a product that you want to add as an upselling product to the first product:
```bash
bin/console product_upselling:create 558ac698b5caf31b233a3e95b60536e8 f997317c12e0b2105363932ba9c69e42
```

Next, run the following command:
```bash
bin/console product_upselling:product:view 558ac698b5caf31b233a3e95b60536e8
```

It should now add a block to the product detail page showing the upselling product.

## Todo
- Use media images for upselling products
- Connect the Admin API towards the Administration product edit form

