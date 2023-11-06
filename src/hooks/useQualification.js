import { useEffect, useState } from "react";
import ApiConfig from "../api/config/ApiConfig";

const useQualification = () => {

    const [qualifications, setQualifications] = useState([]);
    const [loading, setLoading] = useState(false);

    async function fetchQualifications() {
        setLoading(true);
        try {
            const response = await ApiConfig.get('/qualifications');
            setQualifications(response.data);
        } catch (error) {
            throw error;
        }
        setLoading(false);
    }

    useEffect(() => {
        fetchQualifications();
    }, [])
    
    return {qualifications, loading}
}

export default useQualification;