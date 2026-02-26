import { useEffect, useState } from 'react';
import ProductsList from './products/ProductsList.jsx';
import { axiosRequest } from '../helpers/config.js';

export default function Home() {
    const [products, setProducts] = useState([]);
    const [colors, setColors] = useState([]);
    const [sizes, setSizes] = useState([]);
    const [loading, setLoading] = useState(false);
    
    useEffect(() => {
        const fetchAllProducts = async() => {
            setLoading(true);
            try {
                const response = await axiosRequest.get('/products');
                setProducts(response.data.data);
                setColors(response.data.colors);
                setSizes(response.data.sizes);
            } catch (e) {
                console.log(e);
            }
        };
        
        fetchAllProducts();
    }, []);
    
    return (
        <ProductsList products={products} />
    );
}
