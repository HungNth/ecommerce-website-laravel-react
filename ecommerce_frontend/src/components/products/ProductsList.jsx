import ProductListItem from './ProductListItem.jsx';

export default function ProductsList({ products }) {
    return (
        <div className="row my-5">
            {
                products.map(product => (
                    <ProductListItem key={product.id} product={product} />
                ))
            }
        </div>
    );
}
