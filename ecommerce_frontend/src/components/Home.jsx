import { useEffect, useState } from 'react';
import axios from 'axios';
import ProductsList from './products/ProductsList.jsx';

export default function Home() {
    const [products, setProducts] = useState([]);
    const [colors, setColors] = useState([]);
    const [sizes, setSizes] = useState([]);
    const [loading, setLoading] = useState(false);
    
    useEffect(() => {
        const fetchAllProducts = async () => {
            setLoading(true);
            try {
                const response = await axios.get('https://ecommerce_backend.test/api/products');
                setProducts(response.data.data);
                setColors(response.data.colors)
                setSizes(response.data.sizes)
            } catch (e) {
                console.log(e);
            }
        }
        
        fetchAllProducts();
    }, []);
    
    return (
        <ProductsList products={products} />
    );
}
