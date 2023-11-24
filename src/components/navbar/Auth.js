import { NavLink } from "react-router-dom";
import { Route, Routes } from "react-router-dom";
import Home from "../../pages/Home";
import Dashboard from "../../pages/Dashboard";
import AuthUser from "../../api/auth/AuthUser";
import GenerateChecklist from "../../pages/GenerateChecklist";
import DocumentCheckist from "../../pages/DocumentCheckist";

function Auth() {

    const { token, logout } = AuthUser();
    const logoutUser = () => {
        if (token !== undefined) {
            logout();
        }
    }

    return (
        <div>
            <nav className="navbar navbar-expand-sm navbar-dark bg-dark">
                <ul className="navbar-nav">
                    <li className="nav-item">
                        <NavLink className="nav-link" to="/">Home</NavLink>
                    </li>
                    <li className="nav-item">
                        <NavLink className="nav-link" to="/generateChecklist">Generate Checklist</NavLink>
                    </li>
                    <li className="nav-item">
                        <NavLink className="nav-link" to="/dashboard">Dashboard</NavLink>
                    </li>
                    <li className="nav-item">
                        <span role="button" className="nav-link" onClick={logoutUser}>Logout</span>
                    </li>
                </ul>

            </nav>

            <Routes>
                <Route path="/" element={<Home />} />
                <Route path="/generateChecklist" element={<GenerateChecklist />} />
                <Route path="/dashboard" element={<Dashboard />} />
                <Route path="/documentCheckist" element={<DocumentCheckist />} />

                
            </Routes>
        </div>
    );
}

export default Auth;