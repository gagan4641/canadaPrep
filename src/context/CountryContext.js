import { createContext, useEffect, useState } from "react";
import ApiConfig from "../api/config/ApiConfig";


export const CountryContext = createContext();

export function CountryContextProvider ({children}) {

    const [countries, setCountries] = useState([]);
    const [loading, setLoading] = useState(false);
    const value = {countries, loading};

    useEffect(() => {

        async function fetchCountries() {
            setLoading(true);
            try {
                const response = await ApiConfig.get('/countries');
                setCountries(response.data);
            } catch (error) {
                throw error;
            }
            setLoading(false);
        }

        fetchCountries();
    }, [])
    
    return <CountryContext.Provider value={value}>
        {children}
    </CountryContext.Provider>
}