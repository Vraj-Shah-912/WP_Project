function viewProfile() {
    const profilePhotoElement = document.getElementById("profile-photo");
    profilePhotoElement.innerHTML = `<img src="student_photo.jpg" alt="Student Photo">`;

    const profileDetails = {
      name: "John Doe",
      branch: "Computer Science",
      semester: "5th",
      enrollmentNumber: "ABC123456"
    };
  
    const profileDetailsElement = document.getElementById("profile-details");
    profileDetailsElement.innerHTML = `
      <p><strong>Name:</strong> ${profileDetails.name}</p>
      <p><strong>Branch:</strong> ${profileDetails.branch}</p>
      <p><strong>Semester:</strong> ${profileDetails.semester}</p>
      <p><strong>Enrollment Number:</strong> ${profileDetails.enrollmentNumber}</p>
    `;
  }
  
  function applyForCertificate(certificateType) {
    // Logic for applying for the selected certificate type
    alert(`Applying for ${certificateType}`);
  }
  
  function applyForNameCorrection() {
    // Logic for applying for name correction
    window.location.href = "http://localhost/WP_Project/Name_Correction/nameCorrection.html";
  }
  
  function applyForStudentTransfer() {
    // Logic for applying for student transfer
    alert("Applying for Student Transfer");
  }