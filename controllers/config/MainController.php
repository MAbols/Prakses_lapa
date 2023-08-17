<?php
// controllers/MainController.php
class MainController
{
    public function home($f3)
    {
        $doctorId = $_SESSION['doctor_id']; // Assuming the doctor's ID is stored in the session after login
        
        // Fetch patients added by the logged-in doctor
        $db = $f3->get('DB');
        $patients = $db->exec('SELECT * FROM pacienti WHERE Arstejosa_arsta_id = ?', $doctorId);

        // Set the patient data to be used in the template
        $f3->set('patients', $patients);

        // Render the home page template
        $template = new Template;
        echo $template->render('views/navbar.html');
        echo $template->render('views/home.html');
    }
    public function showAddPatientForm($f3)
    {
        // If it's a GET request, simply render the "Add Patient" form
        $f3->set('pageTitle', 'Add Patient'); // Set page title for the template
        $template = new Template;
        //echo $template->render('views/navbar.html');
        echo $template->render('views/add_patient.html');
    }

    public function addPatient($f3)
    {
        if ($f3->VERB == 'POST') {
            // Process the form submission here
            $name = $f3->get('POST.name');
            $surname = $f3->get('POST.surname');
            $personalCode = $f3->get('POST.personal_code');
            $sickness1 = $f3->get('POST.sickness1');
            $sickness2 = $f3->get('POST.sickness2');
            $sickness3 = $f3->get('POST.sickness3');
            $sex = $f3->get('POST.sex');

            // Perform any validation or data processing if needed

            // Check if the patient with the same personal code already exists in the database
            $db = $f3->get('DB');
            $doctorId = $_SESSION['doctor_id'];
            $existingPatient = $db->exec('SELECT * FROM pacienti WHERE Personas_kods = ? AND Arstejosa_arsta_id = ?', [$personalCode,$doctorId]);
            if ($existingPatient) {
                // Patient with the same personal code already exists, handle the error (e.g., show an error message)
                // You can decide what to do in this case, depending on your requirements.
                // For example, you can redirect back to the form with an error message:
                echo "Šāds pacients jau eksistē, lūdzu dodieties uz pacientu rediģēšanas lapu.";
            } else {
                // Patient with the same personal code doesn't exist, insert the new patient into the database
                // $doctorId = $_SESSION['doctor_id'];
                $db->exec('INSERT INTO pacienti (Vards, Uzvards, Personas_kods, Slimiba_1, Slimiba_2, Slimiba_3, Dzimums,Arstejosa_arsta_id) VALUES (?, ?, ?, ?, ?, ?, ?,?)', array($name, $surname, $personalCode, $sickness1, $sickness2, $sickness3, $sex,$doctorId));

                // Redirect to the home page or a success page after adding the patient
                $f3->reroute('/');
            }
        } else {
            // If it's a GET request, simply render the "Add Patient" form
            $f3->set('pageTitle', 'Add Patient'); // Set page title for the template
            echo View::instance()->render('views/navbar.html');
            echo View::instance()->render('views/add_patient.html');
            
            //echo $_SESSION['doctor_id'];
        }
    }

    public function updatePatient($f3, $params)
    {
        $patientId = $params['id'];
        // Retrieve patient details from the database based on $patientId
        $db = $f3->get('DB');
        $patient = $db->exec('SELECT * FROM pacienti WHERE Pacienta_id = ?', $patientId);
        if ($patient) {
            // Render the update patient form
            $f3->set('patient', $patient[0]);
            $template = new Template;
            echo $template->render('views/update_patient.html');
        } else {
            // Handle the case where patient data couldn't be retrieved
            echo "Patient not found or error in database query.";
        }
    }

    public function processUpdatePatient($f3, $params)
    {
        $patientId = $params['id'];
        $db = $f3->get('DB');

        // Retrieve updated form data
        $name = $f3->get('POST.name');
        $surname = $f3->get('POST.surname');
        $personalCode = $f3->get('POST.personal_code');
        $sickness1 = $f3->get('POST.sickness1');
        $sickness2 = $f3->get('POST.sickness2');
        $sickness3 = $f3->get('POST.sickness3');
        $sex = $f3->get('POST.sex');

        // Perform any validation or data processing if needed

        // Update the patient's information in the database
        $db->exec(
            'UPDATE pacienti SET Vards = ?, Uzvards = ?, Personas_kods = ?, Slimiba_1 = ?, Slimiba_2 = ?, Slimiba_3 = ?, Dzimums = ? WHERE Pacienta_id = ?',
            array($name, $surname, $personalCode, $sickness1, $sickness2, $sickness3, $sex, $patientId)
        );

        // Redirect back to the home page after updating
        $f3->reroute('/');
    }

    public function deletePatient($f3, $params)
    {
        $patientId = $params['id'];
        // Delete the selected patient from the database based on $patientId
        $db = $f3->get('DB');
        $db->exec('DELETE FROM pacienti WHERE Pacienta_id = ?', $patientId);

        // Redirect back to the home page after deleting
        $f3->reroute('/');
    }
}
