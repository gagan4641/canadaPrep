import { useEffect } from "react";
import AuthUser from "../api/auth/AuthUser";


function Dashboard() {

    const { user, http } = AuthUser();

    // useEffect(() => {
    //     fetchUserDetail();
    // }, [])

    // const fetchUserDetail = async () => {
    //     const response = await http.me();
    //     console.log(response);
    // }

    return (
        <div>
            <h4>Name: </h4>
            <p>{user.name}</p>
            <h4>Email</h4>
            <p>{user.email}</p>
        </div>
    );
}

export default Dashboard;
