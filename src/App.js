import "bootstrap/dist/css/bootstrap.min.css";
import './App.css';
import AuthUser from "./api/auth/AuthUser";
import Guest from "./components/navbar/Guest";
import Auth from "./components/navbar/Auth";

function App() {

  const { getToken } = AuthUser();
  if (!getToken()) {
    return <Guest />
  }else{
    return <Auth />
  }
}

export default App;
