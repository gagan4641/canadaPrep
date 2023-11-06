import { useContext, useEffect, useState } from "react";
import AuthUser from "../api/auth/AuthUser";
import { useNavigate } from "react-router-dom";
import { CountryContext } from "../context/CountryContext";
import useCategory from "../hooks/useCategory";
import useQualification from "../hooks/useQualification";

function GenerateChecklist() {

  const { categories, loading: categoryLoading } = useCategory();
  const { qualifications, loading: qualificationLoading } = useQualification();
  const navigate = useNavigate();
  const { http, user } = AuthUser();
  const { countries, loading: countryLoading } = useContext(CountryContext);
  const [formData, setFormData] = useState({
    name: user.name,
    email: user.email,
    phone: user.phone,
    country: user.country_id,
    age: '',
    qualifications: [],
    workExperience: [{ company: "", position: "", from: "", to:""}],
    pastRefusals: '',
    maritalStatus: false,
    children: '',
    crimeRecord: '',
    category: '',
    workExperience: [],
    workExperienceStatus: false
  });

  const [errors, setErrors] = useState({});

  const handleChange = (e) => {
    const { name, value, type, checked } = e.target;

    if (name == 'qualifications') {
      const isChecked = e.target.checked;
      const optionId = parseInt(value);
      setFormData((prevFormData) => ({
        ...prevFormData,
        [name]: isChecked
          ? [...prevFormData[name], optionId]
          : (prevFormData[name].filter((id) => id !== optionId)),
      }));

      // setFormData((prevFormData) => {
      //   const updatedFormData = { ...prevFormData };
      //   if (updatedFormData.hasOwnProperty(`completionYear-${optionId}`)) {
      //     delete updatedFormData[`completionYear-${optionId}`];
      //   }
      // });

    } else {
      setFormData((prevFormData) => ({ ...prevFormData, [name]: type == 'checkbox' ? checked : value }));
    }
  };

  const addWorkExperience = () => {
    setFormData((prevFormData) => ({
      ...prevFormData,
      workExperience: [...prevFormData.workExperience, { company: "", position: "", from: "", to:"" }],
    }));
  };

  const removeWorkExperience = (index) => {
    setFormData((prevFormData) => {
      const workExperience = [...prevFormData.workExperience];
      workExperience.splice(index, 1);

      return { ...prevFormData, workExperience };
    });
  };

  useEffect(() => {
    if (formData.workExperience.length == 0) {

      setFormData((prevFormData) => ({
        ...prevFormData,
        workExperienceStatus: false,
      }));
      addWorkExperience();
    }
  }, [formData.workExperience])



  const handleWorkExperienceChange = (e, index) => {
    const { name, value } = e.target;
    setFormData((prevFormData) => {
      const workExperience = [...prevFormData.workExperience];
      workExperience[index] = { ...workExperience[index], [name]: value };

      return { ...prevFormData, workExperience };
    });
  };

  const handleWorkExperienceStatusChange = (e) => {
    const { name, checked } = e.target;
    setFormData((prevFormData) => ({
      ...prevFormData,
      [name]: checked,
    }));
  };


  const submitForm = async (e) => {

    e.preventDefault();
    console.log(formData);
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
          <h1>Generate Documents Checklist</h1>
          <div className="card p-4">
            <form onSubmit={submitForm}>
              <div className="form-group">
                <label htmlFor="name">Name:</label>
                <input name="name" value={formData.name} onChange={handleChange} type="text" className="form-control" placeholder="Enter name" id="name" />
                {errors.name && <span className="text-danger">{errors.name}</span>}
              </div>
              <br />
              <div className="form-group">
                <label htmlFor="email">Email address:</label>
                <input value={formData.email} name="email" onChange={handleChange} type="email" className="form-control" placeholder="Enter email" id="email" />
                {errors.email && <span className="text-danger">{errors.email}</span>}
              </div>
              <br />
              <div className="form-group">
                <label htmlFor="phone">Phone Number:</label>
                <input value={formData.phone} name="phone" onChange={handleChange} type="text" className="form-control" placeholder="Enter Phone Number" id="phone" />
                {errors.phone && <span className="text-danger">{errors.phone}</span>}
              </div>
              <br />
              <div className="form-group">
                <label htmlFor="country">Select Country:</label>
                <select value={formData.country} name="country" onChange={handleChange} className="form-control" id="country">
                  <option value="">Select a country</option>
                  {countryLoading ? (
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
              <br />
              <div className="form-group">
                <label htmlFor="category">Select Category:</label>
                <select value={formData.category} name="category" onChange={handleChange} className="form-control" id="category">
                  <option value="">Select a category</option>
                  {categoryLoading ? (
                    <option value="" disabled>Loading...</option>
                  ) : (
                    categories.map((category) => (
                      <option key={category.id} value={category.id}>
                        {category.title}
                      </option>
                    ))
                  )}
                </select>
                {errors.category && <span className="text-danger">{errors.category}</span>}
              </div>
              <br />
              <div className="form-group">
                <label>Qualifications:</label>
                {qualificationLoading ? (
                  <p>Loading...</p>
                ) : (
                  qualifications.map((qualification) => (
                    <div key={qualification.id} className="form-check">
                      <input
                        type="checkbox"
                        id={`qualification-${qualification.id}`}
                        name="qualifications"
                        value={qualification.id}
                        checked={formData.qualifications.includes(qualification.id)}
                        onChange={handleChange}
                        className="form-check-input"
                      />
                      <label htmlFor={`qualification-${qualification.id}`} className="form-check-label">
                        {qualification.title}
                      </label>

                      {formData.qualifications.includes(qualification.id) && (
                        <div>
                          <input
                            type="text"
                            name={`completionYear${qualification.id}`}
                            value={formData[`completionYear${qualification.id}`] || ''}
                            onChange={handleChange}
                            placeholder="Completion Year"
                          />
                        </div>
                      )}
                    </div>
                  ))
                )}
                {errors.qualification && <span className="text-danger">{errors.qualification}</span>}
              </div>
              <br />
              <div className="form-group">
                <label>Do you have Work Experience?</label>
                <div className="form-check">
                  <input
                    type="checkbox"
                    id="workExperienceStatus"
                    name="workExperienceStatus"
                    onChange={handleWorkExperienceStatusChange}
                    className="form-check-input"
                    value={formData.workExperienceStatus}
                    checked={formData.workExperienceStatus}
                  />
                  <label htmlFor="workExperienceStatus" className="form-check-label">
                    If yes, select the checkbox
                  </label>
                </div>
                <br />
                {formData.workExperienceStatus && formData.workExperience.map((workExp, index) => (
                  <div key={index}>
                    <div className="form-group">
                      <label htmlFor={`company-${index}`}>Company:</label>
                      <input
                        name="company"
                        value={workExp.company}
                        onChange={(e) => handleWorkExperienceChange(e, index)}
                        type="text"
                        className="form-control"
                        placeholder="Enter company"
                        id={`company-${index}`}
                      />
                    </div>
                    <div className="form-group">
                      <label htmlFor={`position-${index}`}>Position:</label>
                      <input
                        name="position"
                        value={workExp.position}
                        onChange={(e) => handleWorkExperienceChange(e, index)}
                        type="text"
                        className="form-control"
                        placeholder="Enter position"
                        id={`position-${index}`}
                      />
                    </div>
                    <div className="form-group">
                      <label htmlFor={`from-${index}`}>From:</label>
                      <input
                        name="from"
                        value={workExp.from}
                        onChange={(e) => handleWorkExperienceChange(e, index)}
                        type="text"
                        className="form-control"
                        placeholder="Enter from"
                        id={`from-${index}`}
                      />
                    </div>

                    <div className="form-group">
                      <label htmlFor={`to-${index}`}>To:</label>
                      <input
                        name="to"
                        value={workExp.to}
                        onChange={(e) => handleWorkExperienceChange(e, index)}
                        type="text"
                        className="form-control"
                        placeholder="Enter to"
                        id={`to-${index}`}
                      />
                    </div>


                    <button
                      type="button"
                      className="btn btn-danger"
                      onClick={() => removeWorkExperience(index)}
                    >
                      Remove
                    </button>
                  </div>
                ))}
                {formData.workExperienceStatus && (
                  <button type="button" className="btn btn-success" onClick={addWorkExperience}>
                    Add More
                  </button>
                )}
              </div>
              <br />
              <div className="form-group">
                <label>Are you married?</label>
                <div className="form-check">
                  <input
                    type="checkbox"
                    id="maritalStatus"
                    name="maritalStatus"
                    onChange={handleChange}
                    className="form-check-input"
                    value={formData.maritalStatus}
                    checked={formData.maritalStatus}
                  />
                  <label htmlFor="maritalStatus" className="form-check-label">
                    If yes, select the checkbox
                  </label>
                </div>
              </div>
              <br />
              <div className="form-group">
                <label>Have you ever been involved in a court case or charged with a crime?</label>
                <div className="form-check">
                  <input
                    type="checkbox"
                    id="crimeRecord"
                    name="crimeRecord"
                    onChange={handleChange}
                    className="form-check-input"
                    value={formData.crimeRecord}
                    checked={formData.crimeRecord}
                  />
                  <label htmlFor="crimeRecord" className="form-check-label">
                    If yes, select the checkbox
                  </label>
                </div>
              </div>
              <br />
              <div className="form-group">
                <label htmlFor="age">Age:</label>
                <input name="age" value={formData.age} onChange={handleChange} type="text" className="form-control" placeholder="Enter age" id="age" />
                {errors.age && <span className="text-danger">{errors.age}</span>}
              </div>
              <br />
              <button type="submit" className="btn btn-primary">Register</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  );
}

export default GenerateChecklist;