<div id="create-wap" class="page hidden">
  <h1 class="text-4xl font-bold mb-6">Create New Work Access Permit</h1>
  <div id="workpermit-container"></div>
</div>

<script>
  document.addEventListener("DOMContentLoaded", () => {
    const page = document.getElementById("create-wap");
    if (page && !page.classList.contains("hidden")) {
      loadWapForm();
    }
  });

  // If you're navigating dynamically via showPage()
  function loadWapForm() {
    const container = document.getElementById("workpermit-container");
    if (container && container.innerHTML.trim() === "") {
      fetch('./create_wap.php',{
        headers: {
          'X-Requested-With': 'XMLHttpRequest'  // Ensure this is an AJAX request
        }
      })  // ✅ Relative to dashboard.php (which lives in same folder)
        .then(res => res.text())
        .then(html => container.innerHTML = html)
        .catch(err => console.error("Error loading WAP form:", err));
    }
  }

  // Optional: allow global access if needed from showPage
  window.loadWapForm = loadWapForm;
</script>
