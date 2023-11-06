import { useEffect, useState } from "react";
import ApiConfig from "../api/config/ApiConfig";

const useCategory = () => {

    const [categories, setCategories] = useState([]);
    const [loading, setLoading] = useState(false);

    async function fetchCategories() {
        setLoading(true);
        try {
            const response = await ApiConfig.get('/categories');
            setCategories(response.data);
        } catch (error) {
            throw error;
        }
        setLoading(false);
    }

    useEffect(() => {
        fetchCategories();
    }, [])
    
    return {categories, loading}
}

export default useCategory;