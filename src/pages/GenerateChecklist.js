import { useContext, useEffect, useState } from "react";
import AuthUser from "../api/auth/AuthUser";
import GenerateChecklistApi from "../api/GenerateChecklistApi";
import { useNavigate } from "react-router-dom";
import { CountryContext } from "../context/CountryContext";
import useCategory from "../hooks/useCategory";
import useQualification from "../hooks/useQualification";
import useMaritalStatus from "../hooks/useMaritalStatus";

function GenerateChecklist() {

  const [errors, setErrors] = useState({});
  const [flashMessage, setFlashMessage] = useState(null);
  const { categories, loading: categoryLoading } = useCategory();
  const { qualifications, loading: qualificationLoading } = useQualification();
  const { maritalStatuses, loading: maritalStatusesLoading } = useMaritalStatus();
  const navigate = useNavigate();
  const { http } = GenerateChecklistApi();
  const { user } = AuthUser();
  const { countries, loading: countryLoading } = useContext(CountryContext);
  const [formData, setFormData] = useState({
    name: user.name,
    email: user.email,
    phone: user.phone,
    country: user.country_id,
    age: '',
    qualifications: [],
    workExperience: [],
    maritalStatus: [],
    crimeRecord: false,
    category: '',
    workExperienceStatus: false,
    dob: user.dob,
    children: false,
    pastRefusals: false,
  });

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

    } else {
      setFormData((prevFormData) => ({ ...prevFormData, [name]: type == 'checkbox' ? checked : value }));
    }
  };

  const addWorkExperience = () => {
    setFormData((prevFormData) => ({
      ...prevFormData,
      workExperience: [...prevFormData.workExperience, { company: "", position: "", from: "", to: "" }],
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

    // It will add/remove the work exp section based on the work exp status checkbox
    if (checked) {
      addWorkExperience();
    } else {
      setFormData((prevFormData) => ({
        ...prevFormData,
        workExperience: [],
      }));
    }
  };

  const submitForm = async (e) => {

    e.preventDefault();
    try {
      const response = await http.generateChecklist(formData);
      console.log(response);
      if (response.status === 'success') {
        setErrors({});
        navigate('/documentCheckist');
      } else {
        setErrors(response.customErrors);
      }

    } catch (error) {

      if (error.response && error.response.data.errors) {
        setErrors(error.response.data.errors);
        console.log(error.response.data.errors);

      } else {
        console.error('Generate Checklist Error:', error);
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
                <input value={formData.email} name="email" onChange={handleChange} type="text" className="form-control" placeholder="Enter email" id="email" />
                {errors.email && <span className="text-danger">{errors.email}</span>}
              </div>
              <br />
              <div className="form-group">
                <label htmlFor="dob">Date Of Birth:</label>
                <input name="dob" value={formData.dob} onChange={handleChange} type="date" className="form-control" placeholder="Enter dob" id="dob" />
                {errors.dob && <span className="text-danger">{errors.dob}</span>}
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
                {errors && errors.qualifications && <p className="text-danger">{errors.qualifications[0]}</p>}
                {formData.qualifications.length > 0 && !formData.qualifications.every(id => formData[`completionYear${id}`]) && (
                  <p className="text-danger">
                    Please provide a valid completion year for all selected qualifications.
                  </p>
                )}
                {errors && errors.completionYearError &&
                  errors.completionYearError.map((error, index) => (
                    <p key={index} className="text-danger">{error} </p>
                  ))
                }
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
                      {errors['workExperience.' + index + '.company'] && (
                        <span className="text-danger">{errors['workExperience.' + index + '.company'][0]}</span>
                      )}
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
                      {errors['workExperience.' + index + '.position'] && (
                        <span className="text-danger">{errors['workExperience.' + index + '.position'][0]}</span>
                      )}
                    </div>
                    <div className="form-group">
                      <label htmlFor={`from-${index}`}>From:</label>
                      <input
                        name="from"
                        value={workExp.from}
                        onChange={(e) => handleWorkExperienceChange(e, index)}
                        type="date"
                        className="form-control"
                        placeholder="Enter from"
                        id={`from-${index}`}
                      />
                      {errors['workExperience.' + index + '.from'] && (
                        <span className="text-danger">{errors['workExperience.' + index + '.from'][0]}</span>
                      )}
                    </div>
                    <div className="form-group">
                      <label htmlFor={`to-${index}`}>To:</label>
                      <input
                        name="to"
                        value={workExp.to}
                        onChange={(e) => handleWorkExperienceChange(e, index)}
                        type="date"
                        className="form-control"
                        placeholder="Enter to"
                        id={`to-${index}`}
                      />
                      {errors['workExperience.' + index + '.to'] && (
                        <span className="text-danger">{errors['workExperience.' + index + '.to'][0]}</span>
                      )}
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
                <label htmlFor="maritalStatus">Select Marital Status:</label>
                <select value={formData.maritalStatus} name="maritalStatus" onChange={handleChange} className="form-control" id="maritalStatus">
                  <option value="">Select marital status</option>
                  {maritalStatusesLoading ? (
                    <option value="" disabled>Loading...</option>
                  ) : (
                    maritalStatuses.map((maritalStatus) => (
                      <option key={maritalStatus.id} value={maritalStatus.id}>
                        {maritalStatus.title}
                      </option>
                    ))
                  )}
                </select>
                {errors.maritalStatus && <span className="text-danger">{errors.maritalStatus}</span>}
              </div>
              <br />


              <div className="form-group">
                <label>Do you have children?</label>
                <div className="form-check">
                <input
                  type="checkbox"
                  id="children"
                  name="children"
                  value={formData.children}
                  checked={formData.children}
                  onChange={handleChange}
                  className="form-check-input"
                />
                <label htmlFor="children" className="form-check-label">
                    If yes, select the checkbox
                  </label>
                {errors.children && <span className="text-danger">{errors.children}</span>}
              </div>
              </div>
              <br />
              <div className="form-group">
                <label>Do you have any past refusals?</label>
                <div className="form-check">
                <input
                  type="checkbox"
                  id="pastRefusals"
                  name="pastRefusals"
                  value={formData.pastRefusals}
                  checked={formData.pastRefusals}
                  onChange={handleChange}
                  className="form-check-input"
                />
                <label htmlFor="pastRefusals" className="form-check-label">
                    If yes, select the checkbox
                  </label>
                {errors.pastRefusals && <span className="text-danger">{errors.pastRefusals}</span>}
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
                  {errors.crimeRecord && <span className="text-danger">{errors.crimeRecord}</span>}
                </div>
              </div>
              <br />
              <button type="submit" className="btn btn-primary">Generate</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  );
}

export default GenerateChecklist;