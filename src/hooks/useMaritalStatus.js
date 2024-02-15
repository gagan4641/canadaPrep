import { useEffect, useState } from "react";
import ApiConfig from "../api/config/ApiConfig";

const useMaritalStatus = () => {

    const [maritalStatuses, setMaritalStatuses] = useState([]);
    const [loading, setLoading] = useState(false);

    async function fetchMaritalStatuses() {
        setLoading(true);
        try {
            const response = await ApiConfig.get('/maritalStatuses');
            setMaritalStatuses(response.data);
        } catch (error) {
            throw error;
        }
        setLoading(false);
    }

    useEffect(() => {
        fetchMaritalStatuses();
    }, [])
    
    return {maritalStatuses, loading}
}

export default useMaritalStatus;