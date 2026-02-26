import ProductListItem from './ProductListItem.jsx';

export default function ProductsList({products}) {
    return (
        <div>
            {
                products.map(product => (
                    <ProductListItem key={product.id} product={product} />
                ))
            }
        </div>
    );
}
