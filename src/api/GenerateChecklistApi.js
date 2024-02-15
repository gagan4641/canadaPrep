import { useState } from 'react';
import ApiConfig from './config/ApiConfig';
import { useNavigate } from 'react-router-dom';

function GenerateChecklistApi() {

    const http = {
        generateChecklist: async (formData) => {

            try {
                const response = await ApiConfig.post('/generateChecklist', formData);
                return response.data;
            } catch (error) {
                throw error;
            }
        }
    };

    return {
        http
    }

}

export default GenerateChecklistApi;