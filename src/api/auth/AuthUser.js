import { useState } from 'react';
import ApiConfig from '../config/ApiConfig';
import { useNavigate } from 'react-router-dom';

function AuthUser() {

    const navigate = useNavigate();
    const getToken = () => {
        const tokenString = localStorage.getItem('token');
        const userToken = JSON.parse(tokenString);
        return userToken;
    }
    const getUser = () => {
        const userString = localStorage.getItem('user');
        const userDetail = JSON.parse(userString);

        return userDetail;
    }

    const [token, setToken] = useState(getToken());
    const [user, setUser] = useState(getUser());

    const saveToken = (user, token) => {

        localStorage.setItem('token', JSON.stringify(token));
        localStorage.setItem('user', JSON.stringify(user));

        // Set token in the headers immediately after login, so that it will not give error on first time.
        ApiConfig.defaults.headers.common['Authorization'] = `Bearer ${token}`;
        setToken(token);
        setUser(user);
        navigate('/dashboard');
    }

    const logout = () => {
        localStorage.clear();
        navigate('/login');
    }

    const http = {

        login: async (email, password) => {
            try {
                const response = await ApiConfig.post('/login', {
                    email,
                    password,
                });
                return response.data;
            } catch (error) {
                throw error;
            }
        },

        register: async (formData) => {

            try {
                const response = await ApiConfig.post('/register', formData);
                return response.data;
            } catch (error) {
                throw error;
            }
        },

        me: async () => {

            try {
                const response = await ApiConfig.post('/me');
                return response.data;
            } catch (error) {
                throw error;
            }
        }
    };

    return {
        setToken: saveToken,
        http,
        user,
        token,
        getToken,
        getUser,
        logout
    }

}

export default AuthUser;