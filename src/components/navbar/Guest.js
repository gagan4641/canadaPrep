import { NavLink } from "react-router-dom";
import { Route, Routes } from "react-router-dom";
import Home from "../../pages/Home";
import Login from "../../pages/Login";
import Register from "../../pages/Register";

function Guest() {
    return (
        <div>
            <nav className="navbar navbar-expand-sm navbar-dark bg-dark">
                <ul className="navbar-nav">
                    <li className="nav-item">
                        <NavLink className="nav-link" to="/">Home</NavLink>
                    </li>
                    <li className="nav-item">
                        <NavLink className="nav-link" to="/login">Login</NavLink>
                    </li>
                    <li className="nav-item">
                        <NavLink className="nav-link" to="/register">Register</NavLink>
                    </li>
                </ul>

            </nav>

            <Routes>
                <Route path="/" element={<Home />} />
                <Route path="/login" element={<Login />} />
                <Route path="/register" element={<Register />} />
            </Routes>
        </div>
    );
}

export default Guest;