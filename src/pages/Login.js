import { useState } from "react";
import AuthUser from "../api/auth/AuthUser";

function Login() {

    const [email, setEmail] = useState('');
    const [password, setPassword] = useState('');
    const {http, setToken} = AuthUser();

    const submitForm = async (e) => {

        e.preventDefault();
        try {
            const response = await http.login(email, password);

            setToken(response.user, response.access_token);
        } catch (error) {
            console.error('Login error:', error);
        }
    }

    return (
        <div>
            <div className="row justify-content-center pt-5">
                <div className="col-sm-6">
                    <h1>Login</h1>
                    <div className="card p-4">
                        <form onSubmit={submitForm}>
                            <div className="form-group">
                                <label htmlFor="email">Email address:</label>
                                <input value={email} onChange={e => setEmail(e.target.value)} type="email" className="form-control" placeholder="Enter email" id="email" />
                            </div>
                            <div className="form-group">
                                <label htmlFor="pwd">Password:</label>
                                <input value={password} onChange={e => setPassword(e.target.value)} type="password" className="form-control" placeholder="Enter password" id="pwd" />
                            </div>
                            <div className="form-group form-check">
                                <label className="form-check-label">
                                    <input className="form-check-input" type="checkbox" /> Remember me
                                </label>
                            </div><br/>
                            <button type="submit" className="btn btn-primary">Login</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    );
}

export default Login;
