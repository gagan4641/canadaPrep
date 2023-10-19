import axios from 'axios';

const apiBaseURL = process.env.REACT_APP_API_BASE_URL;

const ApiConfig = axios.create({
  baseURL: apiBaseURL,
  headers: {
    'Content-Type': 'application/json'
  },
  mode: 'no-cors',
});

// Set token in the headers after login
const setTokenInHeader = (token) => {
  if (token) {
    ApiConfig.defaults.headers.common['Authorization'] = `Bearer ${token}`;
  } else {
    delete ApiConfig.defaults.headers.common['Authorization'];
  }
};
setTokenInHeader(JSON.parse(localStorage.getItem('token')));

export default ApiConfig;