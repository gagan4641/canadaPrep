import { useEffect } from "react";
import AuthUser from "../api/auth/AuthUser";


function DocumentCheckist() {

    const { user, http } = AuthUser();

    return (
        <div>
            <h1>Documents Checklist</h1>
            <h4>Name: </h4>
            <p>{user.name}</p>
            <h4>Email</h4>
            <p>{user.email}</p>
        </div>
    );
}

export default DocumentCheckist;
