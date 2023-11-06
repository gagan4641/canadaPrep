import { useContext, useState } from "react";
import AuthUser from "../api/auth/AuthUser";
import { useNavigate } from "react-router-dom";
import { CountryContext } from "../context/CountryContext";

function Register() {
  const navigate = useNavigate();
  const { http } = AuthUser();
  const { countries, loading } = useContext(CountryContext);



  const [formData, setFormData] = useState({
    name: '',
    email: '',
    password: '',
    phone: '',
    country: '',
  });

  const [errors, setErrors] = useState({});

  const handleChange = (e) => {
    const { name, value } = e.target;
    setFormData({ ...formData, [name]: value });
  };

  const submitForm = async (e) => {

    e.preventDefault();
    try {

      await http.register(formData);
      setErrors({});
      navigate('/login');

    } catch (error) {

      if (error.response && error.response.data.errors) {
        setErrors(error.response.data.errors);
      } else {
        console.error('Registration Error:', error);
      }
    }
  }

  return (
    <div>
      <div className="row justify-content-center pt-5">
        <div className="col-sm-6">
          <h1>Register</h1>
          <div className="card p-4">
            <form onSubmit={submitForm}>
              <div className="form-group">
                <label htmlFor="name">Name:</label>
                <input name="name" value={formData.name} onChange={handleChange} type="text" className="form-control" placeholder="Enter name" id="name" />
                {errors.name && <span className="text-danger">{errors.name}</span>}
              </div>
              <div className="form-group">
                <label htmlFor="email">Email address:</label>
                <input value={formData.email} name="email" onChange={handleChange} type="email" className="form-control" placeholder="Enter email" id="email" />
                {errors.email && <span className="text-danger">{errors.email}</span>}
              </div>

              <div className="form-group">
                <label htmlFor="phone">Phone Number:</label>
                <input value={formData.phone} name="phone" onChange={handleChange} type="text" className="form-control" placeholder="Enter Phone Number" id="phone" />
                {errors.phone && <span className="text-danger">{errors.phone}</span>}
              </div>
              <div className="form-group">
                <label htmlFor="country">Select Country:</label>
                <select value={formData.country} name="country" onChange={handleChange} className="form-control" id="country">
                  <option value="">Select a country</option>
                  {loading ? (
                    <option value="" disabled>Loading...</option>
                  ) : (
                    countries.map((country) => (
                      <option key={country.id} value={country.id}>
                        {country.name}
                      </option>
                    ))
                  )}
                </select>
                {errors.country && <span className="text-danger">{errors.country}</span>}
              </div>
              <div className="form-group">
                <label htmlFor="pwd">Password:</label>
                <input value={formData.password} name="password" onChange={handleChange} type="password" className="form-control" placeholder="Enter password" id="pwd" />
                {errors.password && <span className="text-danger">{errors.password}</span>}
              </div><br />
              <button type="submit" className="btn btn-primary">Register</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  );
}

export default Register;
