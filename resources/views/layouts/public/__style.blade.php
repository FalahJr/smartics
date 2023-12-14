<link rel="shortcut icon" href="{{asset('assets/favicon.ico')}}" type="image/x-icon" />
<link rel="preconnect" href="https://fonts.googleapis.com" />
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
<link
  href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700;800&display=swap"
  rel="stylesheet"
/>
<link
rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
/>

<!-- Bootstrap CSS -->
<link
  rel="stylesheet"
  href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
  integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N"
  crossorigin="anonymous"
/>

<link rel="stylesheet" href="{{asset('assets/public/style.css')}}" />
<link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
<style>
  #showDropdown:hover {
  cursor: pointer;
}
img.avatar {
  width: 48px;
  height: 48px;
  border-radius: 48px;
}

.dropdown {
  cursor: pointer;
      position: relative;
      display: inline-block;
    }

.dropdown .dropdown-content {
      display: none;
      position: absolute;
      background-color: #ffffff;
      box-shadow: 0 8px 20px rgba(90, 90, 90, 0.1);
      z-index: 1;
      border-radius: 10px;
      text-align: left;
      padding: 10px 0px;
      width: 200px;
      right: 0px;

    }

    /* Style item dropdown */
    .dropdown .dropdown-content a {
      color: black;
      padding: 12px 30px;
      display: block;
      text-decoration: none;
    }

    /* Style item dropdown saat dihover */
    .dropdown .dropdown-content a:hover {
      background-color: #fab754;
    }

    /* Tampilkan dropdown content saat menu dihover */
    .dropdown:hover .dropdown-content {
      display: block;
    }
</style>