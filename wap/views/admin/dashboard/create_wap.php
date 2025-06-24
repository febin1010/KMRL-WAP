<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../auth/login.php");
    exit();
}

if (empty($_SERVER['HTTP_X_REQUESTED_WITH']) || strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) !== 'xmlhttprequest') {
    echo "<h2>This form is meant to be loaded within the KMRL dashboard. Please return to the dashboard.</h2>";
    exit;
}
?>

<link rel="stylesheet" href="../../../styles/create_wap.css">
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kochi Metro - Work Access Permit</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" rel="stylesheet">
    <style>
        #toast-success, #toast-error {
            transition: all 0.3s ease;
        }
    </style>
</head>
<body>

<!-- Toasts -->
<div id="toast-success" class="fixed bottom-6 right-6 bg-green-600 text-white px-4 py-3 rounded-md shadow-lg hidden z-50">
    ✅ Work Permit Submitted Successfully! Redirecting...
</div>
<div id="toast-error" class="fixed bottom-6 right-6 bg-red-600 text-white px-4 py-3 rounded-md shadow-lg hidden z-50">
    ❌ Submission failed. Please try again.
</div>

<!-- Loading Spinner -->
<div id="spinner" class="fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center hidden z-50">
    <div class="border-t-4 border-blue-500 border-solid rounded-full animate-spin h-12 w-12"></div>
</div>

<div class="container">
    <div class="header">
        <div class="header-bg"></div>
        <div class="header-content">
            <img src="../../../assets/images/KMRL-logo.png" alt="Kochi Metro Logo" class="logo w-24 sm:w-32 md:w-36 lg:w-40" />
            <div class="header-title">
                <h1>KOCHI METRO RAIL LTD</h1>
                <h2>Work Access Permit</h2>
            </div>
        </div>
    </div>

    <!-- ✅ REMOVE action attribute -->
    <form class="form-container" id="wapForm" method="POST" enctype="multipart/form-data">
        <h3 class="section-title">PART-1: Request for Work in KMRL</h3>
        <p style="color: var(--text-light); font-size: 0.9rem">(To be submitted at least 24 hrs prior to work)</p>

            <div class="form-grid">
            <div class="form-group span-2">
                <label for="licensee">Name of Licensee</label>
                <input type="text" id="licensee" name="licensee" required>
            </div>

            <div class="form-group">
                <label for="loa">LOA NO.</label>
                <input type="text" id="loa" name="loa" required>
            </div>

            <div class="form-group">
                <label for="office_no">Office No.</label>
                <input type="tel" id="office_no" name="office_no" required>
            </div>

            <div class="form-group span-2">
                <label for="official">Name & Designation of Official</label>
                <input type="text" id="official" name="official" required>
            </div>

            <div class="form-group">
                <label for="official_mobile">Mobile Phone No.</label>
                <input type="tel" id="official_mobile" name="official_mobile" required>
            </div>

            <div class="form-group">
                <label for="scope">Scope of Business</label>
                <input type="text" id="scope" name="scope" required>
            </div>

            <div class="form-group">
                <label for="station">Proposed Station</label>
                <input type="text" id="station" name="station" required>
            </div>

            <div class="form-group">
                <label for="location">Proposed Location</label>
                <input type="text" id="location" name="location" required>
            </div>

            <div class="form-group span-3">
                <label for="description">Description of Civil Work</label>
                <textarea id="description" name="description" rows="4" required></textarea>
            </div>

            <div class="form-group span-2">
                <label for="duration">Proposed Date / No. of days</label>
                <input type="text" id="duration" name="duration" required>
            </div>

            <div class="form-group">
                <label for="tools">Details of tools</label>
                <input type="text" id="tools" name="tools" required>
            </div>

            <div class="form-group">
                <label for="competent_sup">Name of Competent Supervisor</label>
                <input type="text" id="competent_sup" name="competent_sup" required>
            </div>

            <div class="form-group">
                <label for="competent_eng">Name of Competent Engineer</label>
                <input type="text" id="competent_eng" name="competent_eng" required>
            </div>

            <div class="form-group">
                <label for="eng_mobile">Engineer Mobile No.</label>
                <input type="tel" id="eng_mobile" name="eng_mobile" required>
            </div>

            <div class="form-group">
                <label for="workers">No. of workers</label>
                <input type="number" id="workers" name="workers" required>
            </div>

            <div class="form-group span-2">
                <label for="attachments">Copy of IDs attached</label>
                <input type="file" id="attachments" name="attachments" multiple accept=".pdf,.jpg,.jpeg,.png" required>
            </div>
            </div>

            <div class="declaration-section">
                <h3 class="section-title">Declaration</h3>
                <p class="declaration-text">
                    I, on behalf of the above firm, hereby take the full responsibility of the proposed works and also the safety of our workers, supervisors and the people who could be affected due to works. Certified that the deputed workforce is qualified and competent for the assigned job with personal protection equipment (PPE to be arranged by the vendor). Read and accepted the "Instructions to the vendor" mentioned at Annexure-1.
                </p>
                
                <p class="declaration-text">
                    The request for work as above has been verified with the conditions of contract. May be permitted to take up works by the Authorized representative with Emp No. & Desg. with duly following the takeover work area & supervising process.
                </p>

                <div class="authorized-entry">
                <div class="form-group">
                    <label for="auth_name1">Name & Designation of Authorized Representative 1</label>
                    <input type="text" id="auth_name1" name="auth_name1" required placeholder="Name - Designation">
                </div>
                <div class="form-group">
                    <label for="auth_name2">Name & Designation of Authorized Representative 2</label>
                    <input type="text" id="auth_name2" name="auth_name2" required placeholder="Name - Designation">
                </div>
                </div>

                <div class="work-type-selection">
                    <span>As per the extant rule of:</span>
                    <label class="work-type-label">
                        <input type="checkbox" name="workMode" value="wap"> WAP
                    </label>
                    <label class="work-type-label">
                        <input type="checkbox" name="workMode" value="jobCard"> JOB CARD
                    </label>
                </div>
            </div>

            <div class="signature-area">
                <div class="signature-box">
                    <div class="signature-line"></div>
                    <label>Signature of KMRL contract manager</label>
                </div>
                <div class="signature-box">
                    <div class="signature-line"></div>
                    <label>NAME</label>
                </div>
                <div class="signature-box">
                    <div class="signature-line"></div>
                    <label>DEPARTMENT</label>
                </div>
            </div>

            <div class="form-footer">
                <div>
                    <h3>Kochi Metro Rail LTD</h3>
                    <p>O&M Division</p>
                </div>
                <button type="submit">Submit Application</button>
            </div>
        </form>
    </div>

<script>
(() => {
    const form = document.getElementById("wapForm");
    const spinner = document.getElementById("spinner");
    const toastSuccess = document.getElementById("toast-success");
    const toastError = document.getElementById("toast-error");

    if (!form) return;

    form.addEventListener("submit", function (e) {
        e.preventDefault();

        spinner.classList.remove("hidden");
        const formData = new FormData(form);

        fetch("../../../routes/router.php?action=submit_wap", {
            method: "POST",
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => response.text())
        .then(text => {
            spinner.classList.add("hidden");

            try {
                const data = JSON.parse(text);

                if (data.status === "success") {
                    form.reset();
                    toastSuccess.classList.remove("hidden");

                    setTimeout(() => {
                        toastSuccess.classList.add("hidden");

                        if (typeof showPage === "function") {
                            showPage("pending-wap");
                        } else if (data.redirect) {
                            window.location.href = data.redirect;
                        }

                    }, 2000);
                } else {
                    toastError.textContent = data.message || "❌ Something went wrong.";
                    toastError.classList.remove("hidden");
                    setTimeout(() => toastError.classList.add("hidden"), 3000);
                }

            } catch (err) {
                console.error("Invalid JSON from server:", text);
                toastError.classList.remove("hidden");
                setTimeout(() => toastError.classList.add("hidden"), 3000);
            }
        })
        .catch(err => {
            spinner.classList.add("hidden");
            console.error("Fetch error:", err);
            toastError.classList.remove("hidden");
            setTimeout(() => toastError.classList.add("hidden"), 3000);
        });
    });

    // Signature animation
    document.querySelectorAll('.signature-box').forEach(box => {
        box.addEventListener('click', () => {
            box.style.transform = 'scale(1.02)';
            setTimeout(() => {
                box.style.transform = 'translateY(-4px)';
            }, 200);
        });
    });

    // Validation
    const inputs = document.querySelectorAll('input, textarea, select');
    const excludedFields = ['scope_of_business', 'loa_no', 'office_no', 'details_of_tools'];

    inputs.forEach(input => {
        input.addEventListener('blur', (e) => {
            const formGroup = e.target.closest('.form-group');
            if (!formGroup) return;

            if (e.target.required && e.target.value.trim() === '' && !excludedFields.includes(e.target.name)) {
                formGroup.classList.add('invalid');
                formGroup.classList.remove('valid');

                if (!formGroup.querySelector('.validation-message')) {
                    const message = document.createElement('div');
                    message.className = 'validation-message';
                    message.textContent = 'This field is required';
                    formGroup.appendChild(message);
                }
            } else {
                formGroup.classList.remove('invalid');
                formGroup.classList.add('valid');
                const validationMessage = formGroup.querySelector('.validation-message');
                if (validationMessage) validationMessage.remove();
            }
        });

        input.addEventListener('focus', (e) => {
            const formGroup = e.target.closest('.form-group');
            if (formGroup) formGroup.classList.add('focused');
        });
    });
})();
</script>
</body>
</html>